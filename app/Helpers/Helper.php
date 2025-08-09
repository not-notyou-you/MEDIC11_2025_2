<?php

use Illuminate\Support\Facades\Storage;

function isLandscape($path)
{
    $fullPath = storage_path('app/public/' . str_replace('storage/', '', $path));
    list($width, $height) = getimagesize($fullPath);
    return $width > $height;
}
