<?php
require_once ROOT_PATH . '/includes/database.php';

function findUserConnect($email,$password){
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password
    = :password");
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    }
    return null;


}

function login(){
    $errors = [];
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';

        // Validation des champs
        if (empty($email)) {
            $errors['email'] = "L'adresse email est obligatoire";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format d'email invalide";
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est obligatoire";
        }

        if (empty($errors)) {
            $user = findUserConnect($email,$password);
            if ($user) {
                $_SESSION['user'] = $user;
    
                // Redirection selon le rôle
                switch ($user['role']) {
                    case 'rp':
                        header("Location: index.php?controller=rp");
                        break;
                    case 'prof':
                        header("Location: index.php?controller=prof");
                        break;
                    case 'student':
                        header("Location: index.php?controller=student");
                        break;
                    case 'attache':
                        header("Location: index.php?controller=attache");
                        break;
                    default:
                        header("Location: index.php");
                        break;
                }
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }
    }
    require_once("../views/auth/login.html.php");
}

function logout() {
    session_destroy();
    header("Location: ?controller=security&page=login");
    exit();
}

ob_start();


$page = $_REQUEST["page"] ?? "login"; 

switch ($page) {
    case 'login':
        login();
        break;
    case 'logout': 
        logout(); 
        break;
    default:
        echo "Page introuvable"; 
}

$content = ob_get_clean();
require_once("..//layout/layoutSecurity.php");

?>