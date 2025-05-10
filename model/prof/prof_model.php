<?php

function getDateDuJourFormatLong() {
    $mois = [
        '01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
        '04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
        '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
    ];

    $jour = date('d');
    $moisNum = date('m');
    $annee = date('Y');

    return $jour . ' ' . $mois[$moisNum] . ' ' . $annee;
}

function getNombreDeCoursDuJourActifs($idProf) {
    global $pdo; // Utilisation de la connexion existante
    $dateAujourdhui = date('Y-m-d');

    $sql = "SELECT COUNT(*) FROM cours 
            WHERE professeur_id = :id_prof 
            AND date = :date_cours 
            AND etat = 'actif'";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_prof' => $idProf,
        'date_cours' => $dateAujourdhui
    ]);
    
    return $stmt->fetchColumn();
}



function getNombreHeuresEnseignees($idProf) {
    global $pdo; // Utilisation de la connexion existante

    $dateAujourdhui = date('Y-m-d');

    $sql = "SELECT heure_debut, heure_fin FROM cours 
            WHERE professeur_id = :id_prof 
            AND etat = 'actif'
            AND date = :date_cours";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_prof' => $idProf,
        'date_cours' => $dateAujourdhui
    ]);

    $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalHeures = 0;

    foreach ($cours as $c) {
        $debut = new DateTime($c['heure_debut']);
        $fin = new DateTime($c['heure_fin']);
        $interval = $debut->diff($fin);
        $totalHeures += $interval->h + ($interval->i / 60);
    }

    return round($totalHeures, 2); // Exemple : 3.5 heures
}






