<?php
// session_start();

// require_once ROOT_PATH . "/model/commandeModel.php";
require_once ROOT_PATH . "/model/attache/attache_model.php";

$page = $_REQUEST["page"] ?? "attache";


function handleAttachePage() {
    $students = getUser("student");
    $classes = getAllElements("classes");
    $anneeScolaire = date('Y') . '-' . (date('Y') + 1); // Exemple : "2025-2026";
    require_once ROOT_PATH . "/views/attache/attache.html.php";
}
function handlelisteEtudiantPage(){
    $students = getUser("student");
    $annee = date('Y');
    if (isset($_GET['id_classe'])) {
        $students = getEtudiantsParClasse($_GET['id_classe'] , $annee);
        $classe = getAllElements("classes", $_GET['id_classe'] , "id_classe");
        require_once ROOT_PATH . "/views/attache/listeEtudiant.html.php";
        // var_dump($classe);
        // die();
    }else {
        require_once ROOT_PATH . "/views/attache/notFoundClasse.html.php";
    }
    

}
function handlelisteAbsencetPage(){
    $absences = getAbsencesParDateEtClasse();
    
    $totalAbsences= getNombreAbsencesActivesParJourEtEtat();
    $justifiedAbsences = getNombreAbsencesActivesParJourEtEtat('justified');
    $pendingAbsences = getNombreAbsencesActivesParJourEtEtat('en_attente');
    if (isset($_GET['filtre'])) {
        $students = getTopAbsentStudentsCurrentYear();
        // dd($students);
        require_once ROOT_PATH . "/views/attache/top5.html.php";
    }else {
        require_once ROOT_PATH . "/views/attache/liste_absence.html.php";

    }
    
}
function handleajoutEtudiantPage(){
    $classes = getAllElements("classes");
    $id_classe = $_REQUEST['id_classe'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $old = $_POST;
        $classe_id = $_POST["id_classe"];

        // Champs requis
        $requiredFields = ['prenom', 'nom', 'email', 'matricule', 'adresse', 'password'];
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field]))) {
                $errors[$field] = "Ce champ est obligatoire";
            }
        }

        // Validation spécifique
        if (!empty($_POST['matricule']) && checkMatriculeExists($_POST['matricule'])) {
            $errors['matricule'] = "Ce matricule existe déjà";
        }

        if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format d'email invalide";
        }

        if (!empty($_POST['password']) && strlen($_POST['password']) < 2) {
            $errors['password'] = "Minimum 8 caractères";
        }

        if (empty($errors)) {
            try {
                // Préparation des données pour insertion
                $studentData = [
                    'prenom' => $_POST['prenom'],
                    'nom' => $_POST['nom'],
                    'email' => $_POST['email'],
                    'matricule' => $_POST['matricule'],
                    'adresse' => $_POST['adresse'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role' => 'student',
                    'etat' => 'actif',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                // Insertion de l’étudiant
                $id = insertElement("users", $studentData);
                
                // var_dump($etudiant['id']);
                // die();

                // Préparation de l’inscription
                $annee = date('Y');
                $nouvelleInscription = [
                    'classe_id' => (int)$classe_id,
                    'etudiant_id' => (int)$id,
                    'date_inscription' => date('Y-m-d'),
                    'annee' => $annee
                ];
                //  var_dump($nouvelleInscription);
                // die();
                // Insertion de l’inscription
                insertElement("inscriptions", $nouvelleInscription);

                // Redirection
                header('Location: index.php?controller=attache&page=listeEtudiant&success=1');
                exit;

            } catch (PDOException $e) {
                $errors['global'] = "Erreur d'enregistrement : " . $e->getMessage();
            } catch (Exception $e) {
                $errors['global'] = $e->getMessage();
            }
        }

        $_SESSION['form_errors'] = $errors;
        $_SESSION['old_input'] = $old;
        header("Location: index.php?controller=attache&page=ajoutEtudiant");
        exit;
    }

    require_once ROOT_PATH . "/views/attache/ajoutEtudiant.html.php";
}
function handlejustificationPage(){
    $annee = getAnneeEnCours();
    $justifications = getJustificationsByAnnee($annee);
    if (isset($_GET['id_justif_refuser'])) {
        $id_absence = getAbsenceIdByJustification($_GET['id_justif_refuser']);
        // dd($id_absence);
        updateElement("justifications", ['statut' => 'refuse'], ['id' => $_GET['id_justif_refuser']]);
        $aujourdhui = date('Y-m-d');
        updateElement("justifications", ['date_traitement' => $aujourdhui], ['id' => $_GET['id_justif_refuser']]);
        updateElement("absences", ['statut' => 'non_justifier'], ['id' => $id_absence]);
       
        // updateElement("absences", ['statut' => 'non_justifier'], ['id' => $_GET['id_justif_refuser']]);
    }elseif (isset($_GET['id_justif_accepte'])) {
        $id_absence = getAbsenceIdByJustification($_GET['id_justif_accepte']);
        updateElement("justifications", ['statut' => 'accepte'], ['id' => $_GET['id_justif_accepte']]);
        updateElement("justifications", ['date_traitement' => $aujourdhui], ['id' => $_GET['id_justif_accepte']]);
        updateElement("absences", ['statut' => 'justifier'], ['id' => $id_absence]);
    }
    // dd($justifications);
    require_once ROOT_PATH . "/views/attache/justification.html.php";

    
}

ob_start();

switch ($page) {
    case 'attache':
        handleAttachePage();
        break;
    case 'listeEtudiant':
        handlelisteEtudiantPage();
        break; 
    case 'listeAbsence':
         handlelisteAbsencetPage();
        break; 
    case 'ajoutEtudiant':
        handleajoutEtudiantPage();
        break;  
    case 'justification':
        handlejustificationPage();
        break;   
    default:
        # code...
        break;
}

$content = ob_get_clean();
require_once ROOT_PATH . "/layout/layoutAttache.php";