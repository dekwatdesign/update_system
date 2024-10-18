<?php
header('Content-Type: application/json');

require_once 'config_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $config = loadConfig();
    echo json_encode($config);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = [
        'repo_owner' => $_POST['repo_owner'],
        'repo_name' => $_POST['repo_name'],
        'access_token' => $_POST['access_token']
    ];
    $result = saveConfig($config);
    echo json_encode(['status' => $result ? 'success' : 'error']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>