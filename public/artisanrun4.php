<?php
$phpPath = '/opt/plesk/php/8.2/bin/php';
$artisanPath = '/var/www/vhosts/medic.umn.ac.id/httpdocs/artisan';

// Cek apakah link sudah ada
if (!is_link(__DIR__ . '/public/storage')) {
    passthru("$phpPath $artisanPath storage:link");
} else {
    echo "Link public/storage sudah ada.\n";
}

// Jalankan migrate
passthru("$phpPath $artisanPath migrate --force");
