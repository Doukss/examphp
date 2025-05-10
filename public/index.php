<?php
session_start();
define("WEBROOT", "http://malick.mbodji.ecole221.sn:8000/?");
define("ROOT_PATH", dirname(__DIR__)); // Définir le chemin racine du projet
require_once ROOT_PATH . '/includes/database.php';
require_once ROOT_PATH . '/config/helpers.php';
require_once ROOT_PATH . '/config/dbHelpers.php';



// Liste des contrôleurs disponibles
$controllers = [
    "security" => "auth/login.controller.php",// Contrôleur pour la connexion/déconnexion
    "rp"   => "rp.controller.php",
    "prof"   => "prof/prof.controller.php",
    "attache"   => "attache/attache.controller.php",
    "student"   => "student/student.controller.php",
];
// Vérifier si un utilisateur est connecté
if (!isset($_SESSION['user']) && $_GET['controller'] !== 'security') {
    header("Location: " . WEBROOT . "?controller=security&page=login");
    exit;
}

if (isset($_SESSION["user"]) && ($_REQUEST["controller"] == "security" || $_REQUEST["controller"] == "")){
    header("Location: " . WEBROOT . "?controller=rp");
}

// Récupérer le contrôleur demandé, ou utiliser "security" par défaut
$controller = $_GET["controller"] ?? "security";

// Vérifier si le contrôleur existe dans la liste, sinon charger le contrôleur par défaut
$controllerFile = $controllers[$controller] ?? $controllers["security"]; 

// Charger le fichier du contrôleur
require_once ROOT_PATH . "/controller/" . $controllerFile;
?>
