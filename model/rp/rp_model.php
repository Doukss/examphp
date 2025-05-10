<?php

    function getElementCount(string $role) : int {
        global $pdo; // Assurez-vous que $pdo est bien défini 
        // Liste des rôles autorisés
        $rolesAutorises = ['rp', 'prof', 'student'];

        // Vérification du rôle
        if (!in_array($role, $rolesAutorises)) {
            throw new Exception("Rôle non autorisé !");
        }

        // Requête sécurisée avec un paramètre préparé
        $query = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE role = :role");
        $query->bindParam(':role', $role);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0; // Retourne 0 si aucun résultat
    }

    function findNombreElement(string $elements): int {
        global $pdo; // Utilisation de la connexion existante
    
        // Liste des tables autorisées
        $tablesAutorisees = ['classes', 'cours'];
    
        if (!in_array($elements, $tablesAutorisees)) {
            throw new Exception("Table non autorisée !");
        }
    
        // Requête sécurisée avec un paramètre préparé
        $sql = "SELECT COUNT(*) AS total FROM $elements WHERE etat = :etat";
        $stmt = $pdo->prepare($sql);
        $etat = 'actif'; 
        $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return intval($result['total'] ?? 0); // Retourne 0 si aucun résultat
    }
    // fonction pour recupérer tous les elements d'une table

   
    

    function getCoursAvecClasses() {
        global $pdo;
    
        $sql = "
            SELECT c.id_cours, m.libelle AS module, c.date, c.heure_debut, c.heure_fin, c.semestre, cl.id_classe,
                   GROUP_CONCAT(DISTINCT cl.libelle SEPARATOR ', ') AS classes,
                   COUNT(DISTINCT cl.id_classe) AS nombre_classes,
                   COUNT(DISTINCT i.etudiant_id) AS nombre_etudiants
            FROM cours c
            LEFT JOIN modules m ON c.module_id = m.id_module
            LEFT JOIN cours_classe cc ON c.id_cours = cc.cours_id
            LEFT JOIN classes cl ON cc.classe_id = cl.id_classe
            LEFT JOIN inscriptions i ON cl.id_classe = i.classe_id
            GROUP BY c.id_cours, m.libelle, c.date, c.heure_debut, c.heure_fin, c.semestre
            ORDER BY c.date, c.heure_debut";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getEtudiantsByClasseId($classeId) {
        global $pdo;
    
        // Requête SQL pour récupérer les étudiants d'une classe donnée
        $query = "
            SELECT u.id, u.prenom, u.nom, u.email, u.matricule
            FROM users u
            JOIN inscriptions i ON i.etudiant_id = u.id
            JOIN classes c ON c.id_classe = i.classe_id
            WHERE u.role = 'student' AND c.id_classe = :classeId
        ";
    
        // Préparer et exécuter la requête
        $stmt = $pdo->prepare($query);
        $stmt->execute([':classeId' => $classeId]);
    
        // Récupérer les résultats
        $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $etudiants;
    }
    
    
    function getProfesseurByMatricule($matricule) {
        global $pdo;
        $sql = "SELECT * FROM users WHERE matricule = :matricule";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif du professeur trouvé ou false si non trouvé
    }
    

    
    

    function insertCours($data) {
        // Ajout de la date actuelle formatée pour MySQL
        $data['created_at'] = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO cours 
                (module_id, professeur_id, date, semestre, 
                 heure_debut, heure_fin, created_at)
                VALUES
                (:module_id, :professeur_id, :date_cours, :semestre, 
                 :heure_debut, :heure_fin, :created_at)";
        
        return dbInsert($sql, $data);
    }
    
    function associateClasseCours($coursId, $classeId) {
        $sql = "INSERT INTO cours_classe (cours_id, classe_id) VALUES (?, ?)";
        dbExecute($sql, [$coursId, $classeId]);
    }

    // Récupérer un cours par son ID
function getCoursById($id) {
    global $pdo;
    $query = "SELECT * FROM cours WHERE id_cours = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mettre à jour un cours existant
function updateCours($id, $data) {
    global $pdo;
    $query = "UPDATE cours SET 
        module_id = :module_id, 
        professeur_id = :professeur_id, 
        date = :date,  -- Correction ici
        semestre = :semestre, 
        heure_debut = :heure_debut, 
        heure_fin = :heure_fin 
        WHERE id_cours = :id";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':id' => $id,
        ':module_id' => $data['module_id'],
        ':professeur_id' => $data['professeur_id'],
        ':date' => $data['date'],  // Correction ici
        ':semestre' => $data['semestre'],
        ':heure_debut' => $data['heure_debut'],
        ':heure_fin' => $data['heure_fin']
    ]);
}


// Mettre à jour les classes associées à un cours
function updateClasseCours($cours_id, $classes) {
    global $pdo;
    // Supprimer les anciennes associations
    $query = "DELETE FROM cours_classe WHERE cours_id = :cours_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':cours_id' => $cours_id]);

    // Ajouter les nouvelles classes
    foreach ($classes as $classeId) {
        associateClasseCours($cours_id, $classeId);
    }
}
function getClassesByCoursId($coursId) {
    global $pdo;
    $sql = "SELECT classe_id FROM cours_classe WHERE cours_id = :cours_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cours_id' => $coursId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
//recuperer un element grace à son id

function getElementById($table, $id, $primaryKey) {
    global $pdo; // Assurez-vous que la connexion PDO est bien établie

    $query = "SELECT * FROM $table WHERE $primaryKey = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif ou false si aucun résultat
}

function getUserByMatriculeAndRole($matricule, $role) {
    global $pdo; // Connexion à la base de données

    $query = "SELECT * FROM users WHERE matricule = :matricule AND role = :role";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats sous forme de tableau associatif

    return $result ?: []; // Retourne un tableau vide si aucun utilisateur n'est trouvé
}

// les fonctions pour les classes
function getEtudiantsByClasse($classeId) {
    global $pdo;

    // Requête SQL pour récupérer les étudiants d'une classe
    $query = "SELECT u.* 
              FROM inscriptions i
              JOIN users u ON i.etudiant_id = u.id
              WHERE i.classe_id = ? AND u.role = 'student' 
              ORDER BY u.nom ASC";

    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $classeId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourner les résultats sous forme de tableau associatif
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];  // Retourner un tableau vide en cas d'erreur
    }
}

function searchInTable($table, $column, $value) {
    global $pdo;

    // Requête SQL dynamique pour rechercher un élément
    $query = "SELECT * FROM $table WHERE $column LIKE :value";

    // Préparer la requête
    $stmt = $pdo->prepare($query);

    // Lier la valeur en utilisant LIKE pour permettre la recherche partielle
    $stmt->bindValue(':value', "%$value%", PDO::PARAM_STR);

    try {
        // Exécuter la requête
        $stmt->execute();
        
        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur, afficher l'erreur et retourner un tableau vide
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}







function updateElements($table, $data, $primaryKey, $id) {
    global $pdo;

    // Construction de la requête SQL dynamique
    $setParts = [];
    foreach ($data as $column => $value) {
        $setParts[] = "$column = :$column";
    }
    $setClause = implode(", ", $setParts);

    $query = "UPDATE $table SET $setClause WHERE $primaryKey = :id";

    $stmt = $pdo->prepare($query);

    // Association des valeurs
    foreach ($data as $column => $value) {
        $stmt->bindValue(":$column", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    // Exécution de la requête
    return $stmt->execute();
}

function deleteElement($table, $primaryKey, $id) {
    global $pdo;

    $query = "UPDATE $table SET etat = 'supprimé' WHERE $primaryKey = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    return $stmt->execute();
}
