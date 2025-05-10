<?php
// session_start();

// require_once ROOT_PATH . "/model/commandeModel.php";
require_once ROOT_PATH . "/model/rp/rp_model.php";

$page = $_REQUEST["page"] ?? "dashboard";
function handledashboardPage(){
    $totalClasses = findNombreElement("classes");
    $totalProfs = getElementCount("prof");
    $totalCours = findNombreElement("cours");
    $totalEtudiants = getElementCount("student");
    require_once ROOT_PATH . "/views/rp/dashboard.html.php";

}

function handleCoursPage(){
    $cours = getCoursAvecClasses() ;
    // var_dump($cours);
    // die();
    require_once ROOT_PATH . "/views/rp/cours.html.php";

}
function handleajoutCoursPage(){
    $modules = getAllElements("modules");
    $classes = getAllElements("classes");
    $profs = getProfs("prof");
    $errors = [];
    
    // Vérifier si c'est une modification
    $isEdit = isset($_GET['id_cours']);
    $cours = null;

    if ($isEdit) {
        $id_cours = $_GET['id_cours'];
        $cours = getCoursById($id_cours); // Fonction pour récupérer un cours par ID
         // Pré-remplissage des champs en cas de modification
        $module = $cours['module_id'] ?? $_POST['module'] ?? '';
        $professeur = $cours['professeur_id'] ?? $_POST['professeur'] ?? '';
        // var_dump($professeur);
        // die();
        $date = $cours['date'] ?? $_POST['date'] ?? '';
        $semestre = $cours['semestre'] ?? $_POST['semestre'] ?? '';
        $heure_debut = $cours['heure_debut'] ?? $_POST['heure_debut'] ?? '';
        $heure_fin = $cours['heure_fin'] ?? $_POST['heure_fin'] ?? '';
        $classes_selected = $cours ? getClassesByCoursId($id_cours) : ($_POST['classes'] ?? []);
        // var_dump($classes_selected);
        // die();

        if (!$cours) {
            $_SESSION['error'] = "Cours introuvable.";
            header('Location: index.php?page=cours&controller=rp');
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des valeurs
        $module = $_POST['module'] ?? '';
        $professeur = $_POST['professeur'] ?? '';
        $date = $_POST['date'] ?? '';
        $semestre = $_POST['semestre'] ?? '';
        $heure_debut = $_POST['heure_debut'] ?? '';
        $heure_fin = $_POST['heure_fin'] ?? '';
        $classes_selected = $_POST['classes'] ?? [];

        // Validation
        if (empty($module)) $errors['module'] = "Veuillez sélectionner un module.";
        if (empty($professeur)) $errors['professeur'] = "Veuillez sélectionner un professeur.";
        if (empty($date)) $errors['date'] = "Veuillez choisir une date.";
        elseif (strtotime($date) <= strtotime(date('Y-m-d'))) $errors['date'] = "La date doit être ultérieure à aujourd'hui.";
        if (empty($semestre)) $errors['semestre'] = "Veuillez sélectionner un semestre.";
        if (empty($heure_debut)) $errors['heure_debut'] = "Veuillez renseigner l'heure de début.";
        if (empty($heure_fin)) $errors['heure_fin'] = "Veuillez renseigner l'heure de fin.";
        if (!empty($heure_debut) && !empty($heure_fin) && strtotime($heure_debut) >= strtotime($heure_fin)) {
            $errors['heure_debut'] = "L'heure de début doit être inférieure à l'heure de fin.";
        }
        if (empty($classes_selected)) $errors['classes'] = "Veuillez sélectionner au moins une classe.";

        if (empty($errors)) {
            if ($isEdit) {
                // 🔄 Mise à jour d'un cours existant
                updateCours($id_cours, [
                    'module_id' => $module,
                    'professeur_id' => $professeur,
                    'date' => $date,
                    'semestre' => $semestre,
                    'heure_debut' => $heure_debut,
                    'heure_fin' => $heure_fin,
                ]);

                // 🔄 Mise à jour des classes associées
                updateClasseCours($id_cours, $classes_selected);

                $_SESSION['success'] = "Cours modifié avec succès !";
            } else {
                // ➕ Ajout d'un nouveau cours
                $coursId = insertCours([
                    'module_id' => $module,
                    'professeur_id' => $professeur,
                    'date_cours' => $date,
                    'semestre' => $semestre,
                    'heure_debut' => $heure_debut,
                    'heure_fin' => $heure_fin,
                ]);

                if ($coursId) {
                    foreach ($classes_selected as $classeId) {
                        associateClasseCours($coursId, $classeId);
                    }
                }

                $_SESSION['success'] = "Cours ajouté avec succès !";
            }

            // Redirection
            header('Location: index.php?page=cours&controller=rp');
            exit();
        }
    }

    require_once ROOT_PATH . "/views/rp/ajoutCours.html.php";
}

function handlelisteEtudiantPage(){
    // Configuration de la pagination
    $studentsPerPage = 9;
    $currentPage = isset($_GET['pageActuel']) ? (int)$_GET['pageActuel'] : 1;
    $currentPage = max($currentPage, 1); // Empêcher les numéros de page négatifs
    $classeId = $_GET['id_classe'];    
    $etudiants = getEtudiantsByClasseId($classeId);
    $classe = getElementById("classes", $classeId, "id_classe");
    if (isset($_GET['matricule'])) {
        $etudiants = getUserByMatriculeAndRole($_GET['matricule'], "student");
    }
    $totalStudents = count($etudiants);
     // Calcul du nombre de pages
     $totalPages = ceil($totalStudents / $studentsPerPage);
     $totalPages = max($totalPages, 1); // Au moins 1 page
   
    // var_dump($etudiants);
    // die();
    require_once ROOT_PATH . "/views/rp/listeEtudiant.html.php";
}
function handleClassePage(){
    $classes = getAllElements("classes");
    // $classes = [];
    $annee_en_cours = "2024-2025";
    if (isset($_GET['searchClasse'])) {
        $classes = searchInTable('classes', 'libelle', $_GET['searchClasse']);
    }
    if (isset($_GET['id_classe_delete'])) {
        deleteElement("classes", "id_classe", $_GET['id_classe_delete']);
        $_SESSION['success'] = "Classe supprimée avec succès.";
        header('Location: index.php?controller=rp&page=classe');
        exit();
    }
    // var_dump($classes);
    // die();
    require_once ROOT_PATH . "/views/rp/listeClasse.html.php";
}

function handleajoutClassePage(){
    $classes = getAllElements("classes");
    $errors = [];

    // Vérifier si c'est une modification
    $isEdit = isset($_GET['id_classe']);
    $classe = null;

    if ($isEdit) {
        $id_classe = $_GET['id_classe'];
        $classe = getElementById("classes", $id_classe, "id_classe");

        if (!$classe) {
            $_SESSION['error'] = "Classe introuvable.";
            header('Location: index.php?controller=rp&page=classe');
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $libelle = trim($_POST['libelle']);
        $niveau = trim($_POST['niveau']);
        $filliere = trim($_POST['filliere']);
        $created_at = date('Y-m-d H:i:s');

        // Validation
        if (empty($libelle)) $errors['libelle'] = "Veuillez entrer un libellé.";
        if (empty($niveau)) $errors['niveau'] = "Veuillez sélectionner un niveau.";
        if (empty($filliere)) $errors['filliere'] = "Veuillez sélectionner une filière.";

        if (empty($errors)) {
            // Données à enregistrer
            $classeData = [
                "libelle" => $libelle,
                "niveau" => $niveau,
                "filiere" => $filliere
            ];

            if ($isEdit) {
                // Mise à jour de la classe existante
                updateElement("classes", $classeData, "id_classe", $id_classe);
                $_SESSION['success'] = "Classe mise à jour avec succès.";
            } else {
                // Ajout d'une nouvelle classe
                $classeData["created_at"] = $created_at;
                insertElement("classes", $classeData);
                $_SESSION['success'] = "Classe ajoutée avec succès.";
            }

            header("Location: index.php?controller=rp&page=classe");
            exit;
        }
    }

    require_once ROOT_PATH . "/views/rp/ajoutClasse.html.php";
}

function handleProfPage(){
    $profs = getUser("prof");
    if (isset($_GET['serach_prof'])) {
        $profs = searchInTable('users', 'matricule', $_GET['serach_prof']);
    }
    if (isset($_GET['id_prof_delete'])) {
        deleteElement("users", "id", $_GET['id_prof_delete']);
        $_SESSION['success'] = "Classe supprimée avec succès.";
        header('Location: index.php?controller=rp&page=prof');
        exit();
    }
    require_once ROOT_PATH . "/views/rp/listeProf.html.php";
}

function handleajoutProfPage() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $old = $_POST;

        // Champs requis
        $requiredFields = ['prenom', 'nom', 'email', 'specialite', 'matricule', 'grade', 'adresse', 'password'];
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

        if (!empty($_POST['password'])) {
            if (strlen($_POST['password']) < 2) {
                $errors['password'] = "Minimum 8 caractères";
            }
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $errors['password_confirm'] = "Les mots de passe ne correspondent pas";
            }
        }

        if (empty($errors)) {
            try {
                // Préparation des données pour insertion
                $professorData = [
                    'prenom' => $_POST['prenom'],
                    'nom' => $_POST['nom'],
                    'email' => $_POST['email'],
                    'specialite' => $_POST['specialite'],
                    'matricule' => $_POST['matricule'],
                    'grade' => $_POST['grade'],
                    'adresse' => $_POST['adresse'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role' => 'prof', // Ajout du rôle
                    'etat' => 'actif', // Optionnel : si vous utilisez le champ etat
                    'created_at' => date('Y-m-d H:i:s') // Optionnel : si vous suivez la date d'enregistrement
                ];
                

                // Utilisation de votre fonction générique
                insertElement("users", $professorData);

                header('Location: index.php?controller=rp&page=prof&success=1');
                exit;
                
            } catch (PDOException $e) {
                $errors['global'] = "Erreur d'enregistrement : " . $e->getMessage();
            }
        }

        $_SESSION['form_errors'] = $errors;
        $_SESSION['old_input'] = $old;
        header("Location: index.php?controller=rp&page=ajoutProf");
        exit;
    }

    require_once ROOT_PATH . "/views/rp/ajoutProf.html.php";
}
ob_start();

switch ($page) {
    case 'dashboard':
        handledashboardPage();
        break;
    case 'cours':
        handleCoursPage();
        break;
    case 'ajoutCours':
        handleajoutCoursPage();
        break;
    case 'listeEtudiant':
         handlelisteEtudiantPage();
        break;
    case 'classe':
        handleClassePage();
        break;
    case 'ajoutClasse':
        handleajoutClassePage();
        break;
    case 'prof':
        handleProfPage();
        break;
    case 'ajoutProf':
        handleajoutProfPage();
        break;
    default:
        # code...
        break;
}

$content = ob_get_clean();
require_once ROOT_PATH . "/layout/layoutBase.php";