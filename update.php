<?php
session_start();
header('Content-Type: application/json');

require_once 'db_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = loadConfigFromDatabase();

    $api_url = "https://api.github.com/repos/{$config['repo_owner']}/{$config['repo_name']}/contents/{$config['file_path']}";

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: PHP Script',
        "Authorization: token {$config['access_token']}",
        'Accept: application/vnd.github.v3+json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['content'])) {
        $content = base64_decode($data['content']);
        
        for ($i = 0; $i <= 100; $i += 10) {
            $_SESSION['progress'] = $i;
            session_write_close();
            usleep(500000);
        }

        file_put_contents('dynamic_content.html', $content);
        echo json_encode(['status' => 'success', 'message' => 'Website updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Unable to fetch content from GitHub.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>