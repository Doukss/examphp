<?php
// session_start();

// require_once ROOT_PATH . "/model/commandeModel.php" ;
require_once ROOT_PATH . "/model/student/student_model.php";

$page = $_REQUEST["page"] ?? "student";


function handleStudentPage() {
    $absence = getNombreAbsences($_SESSION["user"]["id"], "student");
    $aujourdhui = date('Y-m-d');
    $nbrCoursEtudiant = count(getTousLesCoursParProf($_SESSION["user"]["id"],$aujourdhui));
    $coursEtudiant = getCoursEtudiantParDate($_SESSION["user"]["id"],$aujourdhui);
    $justifications = getJustificationsEtudiant($_SESSION["user"]["id"]);
    // dd($justifications);
    require_once ROOT_PATH . "/views/student/student.html.php";
}
function handleMescoursPage() {
    $date = date('Y-m-d');
    // dd($date);
    if (isset($_GET['date'])) {
        $date = $_GET['date'];

    }
    $coursEtudiant = getCoursEtudiantParDate($_SESSION["user"]["id"],$date);
    // dd($coursEtudiant);
    require_once ROOT_PATH . "/views/student/listeCoursEtudiant.html.php";
}
function handlemesAbsencesPage() {
    $annee = getAnneeEnCours();
    $nbreAbsence = nombreAbsencesBD($_SESSION["user"]["id"], $annee);
    $nbrAbsenceJustifier = nombreAbsencesBD($_SESSION["user"]["id"], $annee , 'justifie');
    $absenceHeure = getNombreAbsences($_SESSION["user"]["id"], "student");
    $nbreAbsenceAtente = nombreAbsencesBD($_SESSION["user"]["id"], $annee , 'en_attente');
    $absences = getAbsencesEtudiant($_SESSION["user"]["id"], $annee);
    // dd($absences);
    require_once ROOT_PATH . "/views/student/mesAbsences.html.php";
}
function handleJustificationPage() {
    $absence = getAbsence($_GET['id']);
    $id_absence = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $old = $_POST;

        // Champs requis
        $requiredFields = ['motif'];
        foreach ($requiredFields as $field) {
            if (empty(trim($_POST[$field]))) {
                $errors[$field] = "Ce champ est obligatoire";
            }
        }

        if (!empty($_POST['motif']) && strlen($_POST['motif']) > 500) {
            $errors['motif'] = "Vous avez dépassé le nombre de caractères autorisé";
        }

        // Gestion du fichier pièce jointe
        $piece_jointe = null;
        if (!empty($_FILES['piece_jointe']['name'])) {
            $uploadDir = 'uploads/';
            $fileName = uniqid() . '_' . basename($_FILES['piece_jointe']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $uploadFile)) {
                $piece_jointe = $uploadFile;
            }
        }

        if (empty($errors)) {
            try {
                $newJustification = [
                    'motif' => htmlspecialchars($_POST['motif']),
                    'piece_jointe' => $piece_jointe,
                    'absence_id' => $id_absence,
                    'statut' => 'en_cours',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                // Insertion de la justification
                insertElement("justifications", $newJustification);

                updateElement("absences", ['statut' => 'en_cours'], ['id' => $id_absence]);

                header('Location: index.php?controller=student&page=mesAbsences&success=1');
                exit;

            } catch (PDOException $e) {
                $errors['global'] = "Erreur d'enregistrement : " . $e->getMessage();
            } catch (Exception $e) {
                $errors['global'] = $e->getMessage();
            }
        }

        $_SESSION['form_errors'] = $errors;
        $_SESSION['old_input'] = $old;
        header("Location: index.php?controller=student&page=justification&id=" . urlencode($id_absence));
        exit();
    }

    require_once ROOT_PATH . "/views/student/justifier.html.php";
}
function handleProfilPage() {
    // dd($_SESSION['user']);
    $classe = getClasseEtudiantParAnnee($_SESSION["user"]["id"], getAnneeEnCours());
    // dd($classe);
    require_once ROOT_PATH . "/views/student/profil.html.php";
}
function handledetailJustificationPage() {
    // dd($_SESSION['user']);
    $absence = getAbsence($_GET['id']);
    $justification = getJustificationDetailsByAbsenceId($_GET['id']);
    // dd($justification);

    $classe = getClasseEtudiantParAnnee($_SESSION["user"]["id"], getAnneeEnCours());
    // dd($classe);
    require_once ROOT_PATH . "/views/student/detailJustification.html.php";
}


ob_start();

switch ($page) {
    case 'student':
        handleStudentPage();
        break;
    case 'mesCours':
        handleMescoursPage();
        break;
    case 'mesAbsences':
        handlemesAbsencesPage();
        break;
    case 'justification':
        handleJustificationPage();
        break;
    case 'detailJustification':
        handledetailJustificationPage();
        break;
    case 'profil':
        handleProfilPage();
        break;
    default:
        # code...
        break;
}

$content = ob_get_clean();
require_once ROOT_PATH . "/layout/layoutStudent.php";