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

function storeSettings()
{
    if (!\Schema::hasTable('store_settings')) {
        return false;
    }

    $settings  =  \DB::table('store_settings')->where('id', 1)->get()->first();
    return collect($settings)->all();
}

function getStatus($status)
{
    return ($status == 'on') ? 1 : 0;
}

function format_currency($param, $symbol = false)
{
    $cur = '';
    if ($symbol == true) {
        $settings = storeSettings();
        $cur = $settings['currency_sym'];
    }
    return $cur . number_format($param);
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

function defaultUnit($product,$id = false)
{
    if($product->units()->where('default',1)->get()->count()){
        $unit = $product->units()->where('default',1)->first();
    }
    else{
        $unit = $product->units()->first();
    }
    return $id ? $unit->id : $unit;
}

function productPrice($product, $type='retail')
{
    // if($type = 'retail')
}
