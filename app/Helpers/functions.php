<?php

use Illuminate\Support\Facades\File;
use GuzzleHttp\Psr7\UploadedFile;

/**
 * uploads file to the server
 *
 * @param UploadFile|File $file file to be uploaded
 * @param string $path path to move file to and delete $oldFile from
 * @param string|null $oldFile File to delete on update
 * @return string
 */
function uploadFile($file, $path, $oldFile = null)
{

    if (is_null($file)) {
        return config('constants.default_image');
    }
    $filename = str_replace(' ', '-', now()) . '.' . $file->extension();
    $newfile = $file->move($path, $filename);
    if ($oldFile) {
        deleteFile($oldFile, $path);
    }
    if ($newfile) {
        return $filename;
    }
    return config('constants.default_image');
}

/**
 * Deletes a file from the server
 * @param string $file The file to be deleted
 * @param string $path The path to delete @param $file
 */
function deleteFile($file, $path)
{
    if ($file == config('constants.default_image')) {
        return;
    }
    $newfile = $path . '/' . $file;
    if (file_exists($newfile)) {
        unlink($newfile);
    }
}

function getStatus($status)
{
    return ($status == 'on') ? 1 : 0;
}

function format_currency($param)
{
    return number_format($param);
}

function generateRefNo()
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 12; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
