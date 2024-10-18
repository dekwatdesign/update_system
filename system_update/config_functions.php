<?php
function loadConfig() {
    $configFile = 'config.json';
    if (file_exists($configFile)) {
        $config = json_decode(file_get_contents($configFile), true);
        return $config ? $config : [];
    }
    return [];
}

function saveConfig($config) {
    $configFile = 'config.json';
    return file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));
}
?>