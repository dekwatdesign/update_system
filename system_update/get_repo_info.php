<?php
header('Content-Type: application/json');

require_once 'config_functions.php';

$config = loadConfig();

$api_url = "https://api.github.com/repos/{$config['repo_owner']}/{$config['repo_name']}";

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
    $repo_info = json_decode($response, true);
    echo json_encode(['status' => 'success', 'data' => $repo_info]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unable to fetch repository information.']);
}
?>