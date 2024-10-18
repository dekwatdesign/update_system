<?php
session_start();
header('Content-Type: application/json');

require_once 'config_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = loadConfig();

    $api_url = "https://api.github.com/repos/{$config['repo_owner']}/{$config['repo_name']}/commits";

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: PHP Script',
        "Authorization: token {$config['access_token']}",
        'Accept: application/vnd.github.v3+json'
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        $commits = json_decode($response, true);
        if (!empty($commits)) {
            $latest_commit_sha = $commits[0]['sha'];
            
            // Simulate update process
            for ($i = 0; $i <= 100; $i += 10) {
                $_SESSION['progress'] = $i;
                session_write_close();
                usleep(500000);
            }

            // Update local commit file
            file_put_contents('last_commit.txt', $latest_commit_sha);
            echo json_encode(['status' => 'success', 'message' => 'Repository updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No commits found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Unable to fetch commit information from GitHub.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>