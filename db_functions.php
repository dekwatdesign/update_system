<?php
function getDatabaseConnection() {
    $host = 'localhost';
    $db   = 'updatesystem';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function loadConfigFromDatabase() {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query('SELECT * FROM github_updater_config ORDER BY id DESC LIMIT 1');
    return $stmt->fetch();
}

function saveConfigToDatabase($config) {
    $pdo = getDatabaseConnection();
    $sql = "INSERT INTO github_updater_config (repo_owner, repo_name, file_path, access_token) 
            VALUES (:repo_owner, :repo_name, :file_path, :access_token)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($config);
}
?>