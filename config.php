<?php
header('Content-Type: application/json');

require_once 'db_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $config = loadConfigFromDatabase();
    echo json_encode($config);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = [
        'repo_owner' => $_POST['repo_owner'],
        'repo_name' => $_POST['repo_name'],
        'file_path' => $_POST['file_path'],
        'access_token' => $_POST['access_token']
    ];
    $result = saveConfigToDatabase($config);
    echo json_encode(['status' => $result ? 'success' : 'error']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>