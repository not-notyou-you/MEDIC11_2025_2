<?php
$storagePath = '/var/www/vhosts/medic.umn.ac.id/httpdocs/storage';

function chmod_r($path, $filePerm = 0644, $dirPerm = 0755) {
    if (!file_exists($path)) return;
    if (is_file($path)) {
        chmod($path, $filePerm);
    } elseif (is_dir($path)) {
        chmod($path, $dirPerm);
        $items = scandir($path);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            chmod_r($path . DIRECTORY_SEPARATOR . $item, $filePerm, $dirPerm);
        }
    }
}

chmod_r($storagePath);
echo "Permission storage sudah diatur.\n";
?>
