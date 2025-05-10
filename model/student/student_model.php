<?php



function getCoursEtudiantParDate($etudiant_id, $date) {
    global $pdo;
    $db = $pdo;

    // Récupérer la classe de l'étudiant pour l'année en cours
    $sqlClasse = "SELECT classe_id FROM inscriptions 
                  WHERE etudiant_id = :etudiant_id 
                  AND annee = :annee 
                  ORDER BY date_inscription DESC LIMIT 1";
    $stmt = $db->prepare($sqlClasse);
    $stmt->execute([
        'etudiant_id' => $etudiant_id,
        'annee' => getAnneeEnCours()
    ]);
    $classe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$classe) {
        return []; // Pas inscrit cette année
    }

    // Récupérer les cours pour cette classe à la date donnée
    $sqlCours = "SELECT c.*, u.nom AS professeur_nom, u.prenom AS professeur_prenom, m.libelle AS module_libelle
                 FROM cours c
                 INNER JOIN cours_classe cc ON c.id_cours = cc.cours_id
                 INNER JOIN users u ON c.professeur_id = u.id
                 INNER JOIN modules m ON c.module_id = m.id_module
                 WHERE cc.classe_id = :classe_id
                 AND c.date = :date_cours
                 AND c.etat = 'actif'";
    
    $stmtCours = $db->prepare($sqlCours);
    $stmtCours->execute([
        'classe_id' => $classe['classe_id'],
        'date_cours' => $date
    ]);

    return $stmtCours->fetchAll(PDO::FETCH_ASSOC);
}

function getJustificationsEtudiant($etudiant_id) {
    global $pdo;
    $db = $pdo;

    $sql = "SELECT 
                j.id AS justification_id,
                j.motif,
                j.statut AS statut_justification,
                j.date_traitement,
                a.id AS absence_id,
                a.date AS date_absence,
                a.statut AS statut_absence,
                a.cours_id,
                a.professeur_id
            FROM justifications j
            INNER JOIN absences a ON j.absence_id = a.id
            WHERE a.etudiant_id = :etudiant_id
            AND a.etat = 'actif'
            ORDER BY a.date DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute(['etudiant_id' => $etudiant_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClasseEtudiantParAnnee($etudiantId, $annee) {
    global $pdo;

    $sql = "SELECT c.* 
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id_classe
            WHERE i.etudiant_id = :etudiant_id 
              AND i.annee = :annee
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'etudiant_id' => $etudiantId,
        'annee'       => $annee
    ]);

    $classe = $stmt->fetch(PDO::FETCH_ASSOC);
    return $classe ? $classe : null;
}

function getAbsencesEtudiant($idEtudiant, $annee, $statut = null) {
    global $pdo;

    // Requête avec jointure pour récupérer le nom du module et les heures
    $sql = "SELECT a.*, c.module_id, m.libelle, c.heure_debut, c.heure_fin
            FROM absences a
            INNER JOIN cours c ON a.cours_id = c.id_cours
            INNER JOIN modules m ON c.module_id = m.id_module
            WHERE a.etudiant_id = :id_etudiant
            AND YEAR(a.date) = :annee";

    // Ajout du filtre statut si précisé
    if ($statut !== null) {
        $sql .= " AND a.statut = :statut";
    }

    $stmt = $pdo->prepare($sql);

    // Bind des valeurs
    $stmt->bindValue(':id_etudiant', $idEtudiant, PDO::PARAM_INT);
    $stmt->bindValue(':annee', $annee, PDO::PARAM_INT);
    if ($statut !== null) {
        $stmt->bindValue(':statut', $statut, PDO::PARAM_STR);
    }

    $stmt->execute();
    $absences = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcul de la durée pour chaque absence
    foreach ($absences as &$absence) {
        $heureDebut = new DateTime($absence['heure_debut']);
        $heureFin = new DateTime($absence['heure_fin']);
        $interval = $heureDebut->diff($heureFin);
        $absence['duree'] = $interval->h + ($interval->i / 60); // durée en heures décimales
    }

    return $absences;
}

function getAbsence($idAbsence) {
    global $pdo;

    // Requête pour récupérer l'absence et ses infos liées
    $sql = "SELECT a.*, c.module_id, m.libelle, c.heure_debut, c.heure_fin
            FROM absences a
            INNER JOIN cours c ON a.cours_id = c.id_cours
            INNER JOIN modules m ON c.module_id = m.id_module
            WHERE a.id = :id_absence";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_absence', $idAbsence, PDO::PARAM_INT);
    $stmt->execute();
    $absence = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si on trouve l'absence, on calcule la durée
    if ($absence) {
        $heureDebut = new DateTime($absence['heure_debut']);
        $heureFin = new DateTime($absence['heure_fin']);
        $interval = $heureDebut->diff($heureFin);
        $absence['duree'] = $interval->h + ($interval->i / 60); // en heures décimales
    }

    return $absence;
}

function getJustificationDetailsByAbsenceId($absence_id) {
    global $pdo;

    $sql = "SELECT 
                j.id AS justification_id,
                j.motif,
                j.piece_jointe,
                j.statut,
                j.created_at,
                a.date,
                m.libelle AS module
            FROM justifications j
            JOIN absences a ON j.absence_id = a.id
            JOIN cours c ON a.cours_id = c.id_cours
            JOIN modules m ON c.module_id = m.id_module
            WHERE j.absence_id = :absence_id
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['absence_id' => $absence_id]);

    return $stmt->fetch();
}

