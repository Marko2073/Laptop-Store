<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;


class OsnovniController extends Controller
{
    function cutImage(ImageRequest $request, $profile = false)
    {
        $file = $request->file('path');
        $tmpPath = $file->getPathname();
        $name = $file->getClientOriginalName();
        $type = $file->getMimeType();
        list($width, $height) = getimagesize($tmpPath);

        $newWidth = $profile ? 150 : 896;
        $newHeight = $profile ? 150 : 672;

        if ($type == "image/jpeg") {
            $originalImage = imagecreatefromjpeg($tmpPath);
        } elseif ($type == "image/png") {
            $originalImage = imagecreatefrompng($tmpPath);
        }
        $imagePath = public_path("assets/img/products/") . $name;
        $resizeImagePath = public_path("assets/img/products-resize/") . $name;

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        move_uploaded_file($tmpPath, $imagePath);
        if ($type == 'image/jpeg') imagejpeg($resizedImage, $resizeImagePath);
        if ($type == 'image/png') imagepng($resizedImage, $resizeImagePath);




    }
}
