<?php
function executeQuery($sql, $params = [], $fetchAll = false, $fetchColumn = false) {
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    if ($fetchColumn) return $stmt->fetchColumn();
    return $fetchAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTotalHeuresAbsenceParClasse($idClasse) {
    $sql = "SELECT SUM(TIMESTAMPDIFF(MINUTE, c.heure_debut, c.heure_fin) / 60) AS total_heures
            FROM absence a
            INNER JOIN cours c ON a.cours_id = c.id_cours
            INNER JOIN cours_classe cc ON c.id_cours = cc.id_cours
            WHERE cc.id_classe = :id_classe AND a.etat = 'absent'";

    $result = executeQuery($sql, ['id_classe' => $idClasse]);
    return $result['total_heures'] ?? 0;
}

function getNombreCoursParClasse($idClasse) {
    $sql = "SELECT COUNT(*) 
            FROM cours_classe cc
            INNER JOIN cours c ON cc.cours_id = c.id_cours
            WHERE cc.classe_id = :id_classe AND c.etat = 'actif'";

    return executeQuery($sql, ['id_classe' => $idClasse], false, true);
}

function getEtudiantsParClasse($idClasse, $annee = null) {
    $annee = $annee ?? date('Y');
    $sql = "SELECT u.* 
            FROM inscriptions i
            INNER JOIN users u ON i.etudiant_id = u.id
            WHERE i.classe_id = :id_classe AND i.annee = :annee 
            AND i.etat = 'actif' AND u.role = 'student'";

    return executeQuery($sql, ['id_classe' => $idClasse, 'annee' => $annee], true);
}

function getAbsencesParDateEtClasse($date = null, $idClasse = null) {
    $date = $date ?? date('Y-m-d');
    $sql = "SELECT a.*, u.nom AS etudiant_nom, u.prenom AS etudiant_prenom, 
                   c.heure_debut, c.heure_fin, m.libelle AS module, cl.libelle AS classe,
                   p.nom AS professeur_nom, p.prenom AS professeur_prenom,
                   TIMESTAMPDIFF(MINUTE, c.heure_debut, c.heure_fin) / 60 AS heures_absence
            FROM absences a
            JOIN users u ON a.etudiant_id = u.id
            JOIN cours c ON a.cours_id = c.id_cours
            JOIN cours_classe cc ON cc.cours_id = c.id_cours
            JOIN classes cl ON cc.classe_id = cl.id_classe
            LEFT JOIN modules m ON c.module_id = m.id_module
            JOIN users p ON c.professeur_id = p.id
            JOIN inscriptions i ON i.etudiant_id = u.id
            WHERE a.date = :date AND i.etat = 'actif'";

    $params = ['date' => $date];
    if ($idClasse) {
        $sql .= " AND cl.id_classe = :id_classe";
        $params['id_classe'] = $idClasse;
    }

    return executeQuery($sql, $params, true);
}

function getNombreAbsencesActivesParJourEtEtat($etat = null, $date = null, $idClasse = null) {
    $date = $date ?? date('Y-m-d');
    $sql = "SELECT COUNT(*) 
            FROM absences a
            JOIN users u ON a.etudiant_id = u.id
            JOIN inscriptions i ON u.id = i.etudiant_id
            WHERE a.date = :date AND i.etat = 'actif' AND a.etat = 'actif'";

    $params = ['date' => $date];
    if ($etat) {
        $sql .= " AND a.etat = :etat";
        $params['etat'] = $etat;
    }
    if ($idClasse) {
        $sql .= " AND i.classe_id = :classe_id";
        $params['classe_id'] = $idClasse;
    }

    return executeQuery($sql, $params, false, true);
}

function getTopAbsentStudentsCurrentYear($idClasse = null, $limit = 5) {
    $annee = date('Y');
    $sql = "SELECT u.id AS id_etudiant, u.nom, u.prenom, cl.libelle AS classe_nom, 
                   COUNT(a.id) AS total_absences, 
                   SUM(TIMESTAMPDIFF(MINUTE, c.heure_debut, c.heure_fin)) / 60 AS heures_absence
            FROM absences a
            JOIN users u ON a.etudiant_id = u.id
            JOIN cours c ON a.cours_id = c.id_cours
            JOIN cours_classe cc ON cc.cours_id = c.id_cours
            JOIN classes cl ON cc.classe_id = cl.id_classe
            JOIN inscriptions i ON i.etudiant_id = u.id
            WHERE u.role = 'student' AND i.etat = 'actif'
            AND a.date BETWEEN :date_debut AND :date_fin";

    $params = [
        'date_debut' => "$annee-01-01",
        'date_fin'   => "$annee-12-31"
    ];

    if ($idClasse) {
        $sql .= " AND cl.id_classe = :id_classe";
        $params['id_classe'] = $idClasse;
    }

    $sql .= " GROUP BY u.id, u.nom, u.prenom, cl.libelle
              ORDER BY total_absences DESC
              LIMIT :limit";

    global $pdo;
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue(":$key", $val);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJustificationsByAnnee($annee) {
    $sql = "SELECT 
                j.id AS justification_id,
                j.motif,
                j.piece_jointe,
                j.statut,
                j.created_at,
                a.date,
                CONCAT(e.prenom, ' ', e.nom) AS etudiant,
                m.libelle AS module,
                cl.libelle AS classe
            FROM justifications j
            JOIN absences a ON j.absence_id = a.id
            JOIN users e ON a.etudiant_id = e.id
            JOIN cours c ON a.cours_id = c.id_cours
            JOIN modules m ON c.module_id = m.id_module
            JOIN inscriptions i ON i.etudiant_id = e.id AND i.annee = :annee
            JOIN classes cl ON i.classe_id = cl.id_classe
            WHERE YEAR(a.date) = :annee
            ORDER BY a.date DESC";

    $params = ['annee' => $annee];
    return dbSelect($sql, $params);
}

function getAbsenceIdByJustification($justificationId) {
    global $pdo;
    $sql = "SELECT absence_id FROM justifications WHERE id = :justificationId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':justificationId', $justificationId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();

    return $result ? $result['absence_id'] : null;
}





// function inscrireNouvelEtudiant(array $data): int|false
// {
//     $userId = executeQuery(
//         in,
//         true
//     );

//     if (!$userId) return false;

//     // 2. Création de l'étudiant
//     $etudiantId = executeQuery(
//         "INSERT INTO etudiants (id_utilisateur, matricule, date_inscription, id_classe)
//          VALUES (?, ?, CURDATE(), ?)",
//         [$userId, $data['matricule'], $data['id_classe']],
//         true
//     );

//     if (!$etudiantId) return false;

//     // 3. Création de l'inscription
//     $inscriptionId = executeQuery(
//         "INSERT INTO inscriptions (id_etudiant, id_classe, annee_scolaire, date_inscription, statut, est_reinscription)
//          VALUES (?, ?, ?, CURDATE(), 'validée', 0)",
//         [$etudiantId, $data['id_classe'], $data['annee_scolaire']],
//         true
//     );

//     return $inscriptionId ? $etudiantId : false;
// }