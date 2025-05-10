<?php
function dbInsert($sql, $params) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $pdo->lastInsertId();
}

function dbExecute($sql, $params = []) {
    global $pdo;
    return $pdo->prepare($sql)->execute($params);
}

function dbSelect($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAnneeEnCours() {
    return date('Y'); // ou récupère depuis la base si c'est stocké quelque part
}


function dbValue($sql, $params = []) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}
function dd($element){
    echo "<pre>";
    print_r($element);
    echo "</pre>";
    exit;

}

function insertElement($table, $data) {
    global $pdo;
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));
    $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    try {
        $pdo->prepare($query)->execute($data);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;
    }
}




function getUser($role) {
    return dbSelect("SELECT * FROM users WHERE role = :role AND etat = 'actif'", [':role' => $role]);
}

function getNombreAbsences($id, $type, $etat = 'actif', $date = null, $dateDebut = null, $dateFin = null) {
    $idColumn = ($type == 'professeur') ? 'professeur_id' : 'etudiant_id';
    $sql = "SELECT COUNT(*) FROM absences WHERE $idColumn = :id AND etat = :etat";
    $params = ['id' => $id, 'etat' => $etat];
    if ($date) {
        $sql .= " AND DATE(date_absence) = :date";
        $params['date'] = $date;
    }
    if ($dateDebut && $dateFin) {
        $sql .= " AND DATE(date_absence) BETWEEN :date_debut AND :date_fin";
        $params['date_debut'] = $dateDebut;
        $params['date_fin'] = $dateFin;
    }
    return dbValue($sql, $params);
}

function getAllElements($table, $id = null, $idColumn = 'id') {
    $tablesAutorisees = ['cours', 'classes', 'modules', 'absences'];
    if (!in_array($table, $tablesAutorisees)) throw new Exception("Table non autorisée!");
    
    $sql = "SELECT * FROM $table WHERE etat = 'actif'";
    $params = [];

    if ($id) {
        $sql .= " AND $idColumn = :id";
        $params['id'] = $id;
    }

    return dbSelect($sql, $params);
}


function getTousLesCoursParProf($idProf, $date = null) {
    $sql = "SELECT c.*, m.libelle AS libelle_module, GROUP_CONCAT(cl.libelle) AS classes
            FROM cours c
            LEFT JOIN modules m ON c.module_id = m.id_module
            LEFT JOIN cours_classe cc ON c.id_cours = cc.cours_id
            LEFT JOIN classes cl ON cc.classe_id = cl.id_classe
            WHERE c.professeur_id = :id_prof AND c.etat = 'actif'";
    $params = ['id_prof' => $idProf];
    if ($date) {
        $sql .= " AND c.date = :date";
        $params['date'] = $date;
    }
    $sql .= " GROUP BY c.id_cours";
    return dbSelect($sql, $params);
}

function getNombreEtudiantsParClasse($idClasse, $annee) {
    $sql = "SELECT COUNT(*) FROM inscriptions WHERE classe_id = :id_classe AND annee = :annee AND etat = 'actif'";
    return dbValue($sql, ['id_classe' => $idClasse, 'annee' => $annee]);
}

function checkMatriculeExists($matricule) {
    $count = dbValue("SELECT COUNT(*) FROM users WHERE matricule = :matricule", [':matricule' => $matricule]);
    return $count > 0;
}

function getEtudiantByMatricule($matricule) {
    global $pdo;
    $sql = "SELECT * FROM users WHERE matricule = :matricule AND role = 'student' LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['matricule' => $matricule]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne null si pas trouvé
}

function nombreAbsencesBD($idEtudiant, $annee, $statut = null) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM absences 
            WHERE etudiant_id = :id 
            AND YEAR(date) = :annee";

    if ($statut !== null) {
        $sql .= " AND statut = :statut";
    }

    $stmt = $pdo->prepare($sql);

    // Bind des paramètres
    $stmt->bindValue(':id', $idEtudiant);
    $stmt->bindValue(':annee', $annee);
    if ($statut !== null) {
        $stmt->bindValue(':statut', $statut);
    }

    $stmt->execute();
    return $stmt->fetchColumn();
}

function updateElement($table, $data, $conditions) {
    global $pdo;

    // Construction des champs SET
    $fields = [];
    foreach ($data as $key => $value) {
        $fields[] = "$key = :$key";
    }
    $setClause = implode(", ", $fields);

    // Construction des conditions WHERE
    $where = [];
    foreach ($conditions as $key => $value) {
        $where[] = "$key = :cond_$key";
    }
    $whereClause = implode(" AND ", $where);

    $sql = "UPDATE $table SET $setClause WHERE $whereClause";

    $stmt = $pdo->prepare($sql);

    // Liaison des valeurs SET
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Liaison des valeurs WHERE (en préfixant cond_)
    foreach ($conditions as $key => $value) {
        $stmt->bindValue(":cond_$key", $value);
    }

    return $stmt->execute();
}

function renderPaginationLinks($currentPage, $pages, $baseUrl = '?page=') {
    $html = '<div class="flex gap-1">';

    if($currentPage > 1) {
        $html .= '<a href="'.$baseUrl.($currentPage-1).'" class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg transition-colors">←</a>';
    }

    for($i = 1; $i <= $pages; $i++) {
        $activeClass = $i === $currentPage ? 'bg-purple-400/10 text-purple-400' : 'bg-slate-800/50 hover:bg-slate-700/30';
        $html .= '<a href="'.$baseUrl.$i.'" class="size-9 flex items-center justify-center '.$activeClass.' rounded-lg">'.$i.'</a>';
    }

    if($currentPage < $pages) {
        $html .= '<a href="'.$baseUrl.($currentPage+1).'" class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg transition-colors">→</a>';
    }

    $html .= '</div>';
    return $html;
}



// function getEtudiantIdByMatricule($matricule) {
//     global $pdo;
//     $sql = "SELECT id FROM users WHERE matricule = :matricule AND role = 'student' LIMIT 1";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute(['matricule' => $matricule]);
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);
//     return $result ? $result['id'] : null;
// }


?>
