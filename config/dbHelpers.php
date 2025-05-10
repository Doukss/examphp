<?php
// require_once ROOT_PATH . "/includes/db.php";

function connectDB()
{
    $host = 'localhost';
    $dbname = 'ecole221_gestion';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function prepareStatement(PDO $pdo, string $sql): PDOStatement
{
    $stmt = $pdo->prepare($sql);
    if (!$stmt) {
        throw new PDOException("Échec de la préparation de la requête");
    }
    return $stmt;
}

function determineParamType(mixed $value): int
{
    return match (true) {
        is_int($value) => PDO::PARAM_INT,
        is_bool($value) => PDO::PARAM_BOOL,
        is_null($value) => PDO::PARAM_NULL,
        default => PDO::PARAM_STR,
    };
}

function bindParams(PDOStatement $stmt, array $params): void
{
    $paramIndex = 1;
    foreach ($params as $value) {
        $paramType = determineParamType($value);
        $stmt->bindValue($paramIndex, $value, $paramType);
        $paramIndex++;
    }
}

function logSqlError(PDOException $e, string $sql): void
{
    die("Erreur SQL: " . $e->getMessage() . "\nRequête: " . $sql);
}

function executeQueryV2(string $sql, array $params = [], bool $returnLastInsertId = false): PDOStatement|int|false
{
    try {
        $pdo = connectDB();
        $stmt = prepareStatement($pdo, $sql);
        bindParams($stmt, $params);
        $stmt->execute();

        if ($returnLastInsertId) {
            return $pdo->lastInsertId();
        }

        return $stmt;
    } catch (PDOException $e) {
        logSqlError($e, $sql);
        return false;
    }
}

function fetchResult(string $sql, array $params = [], bool $all = true): array | false
{
    $stmt = executeQuery($sql, $params);
    if ($stmt) {
        if ($all) {
            return $stmt->fetchAll();
        }
        return $stmt->fetch();
    }
    return false;
}