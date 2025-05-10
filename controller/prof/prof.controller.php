<?php
// session_start();

// require_once ROOT_PATH . "/model/commandeModel.php";
require_once ROOT_PATH . "/model/prof/prof_model.php";

$page = $_REQUEST["page"] ?? "prof";


function handleporatailProfPage() {
    $date_du_jours = getDateDuJourFormatLong();
    $nbCours = getNombreDeCoursDuJourActifs($_SESSION["user"]["id"]);
    $heuresAujourdHui = getNombreHeuresEnseignees($_SESSION["user"]["id"]);
    $nbresAbsence = getNombreAbsences($_SESSION["user"]["id"], "professeur");
    $aujourdhui = date('Y-m-d');
    $coursProf = getTousLesCoursParProf($_SESSION["user"]["id"],$aujourdhui);
    // var_dump($coursProf);
    // die();
    require_once ROOT_PATH . "/views/prof/portailProf.html.php";
}
ob_start();

switch ($page) {
    case 'prof':
        handleporatailProfPage();
        break;
    
    default:
        # code...
        break;
}

$content = ob_get_clean();
require_once ROOT_PATH . "/layout/layoutProf.php";