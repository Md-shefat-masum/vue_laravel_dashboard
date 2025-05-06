<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function upload()
    {
        $validator = Validator::make(request()->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,svg,webp|max:1000',
        ]);

        if ($validator->fails()) {
            return entityResponse($validator->errors(), 422, 'error', 'Validation Error');
        }

        $path = null;

        try {
            $path =$this->resizeAndSaveImage(request());
        } catch (\Throwable $th) {

        }

        $file = request()->file('file');

        if(!$path){
            $path =  Storage::disk('public')->put('uploads/test', $file);
        }

        $media = new Media();
        $media->name = $file->getClientOriginalName();
        $media->extension = $file->getClientOriginalExtension();
        $media->type = $file->getClientMimeType();
        $media->size = $file->getSize();
        $media->path = $path;
        $media->save();

        return entityResponse($path);
    }

    public function delete()
    {
        unlink(public_path(request()->path));
        return entityResponse("deleted " . request()->path);
    }

    public function resizeAndSaveImage(\Illuminate\Http\Request $request)
    {
        $file = $request->file('file');
        $imagePath = $file->getPathname();
        $mime = $file->getMimeType();

        list($origWidth, $origHeight) = getimagesize($imagePath);

        $maxWidth = (int) request()->width ?? 800;
        $maxHeight = (int) request()->height ?? 600;

        // Calculate aspect ratio
        $ratio = $origWidth / $origHeight;
        if ($maxWidth / $maxHeight > $ratio) {
            $newWidth = (int) ($maxHeight * $ratio);
            $newHeight = $maxHeight;
        } else {
            $newHeight = (int) ($maxWidth / $ratio);
            $newWidth = $maxWidth;
        }

        // Create image resource
        switch ($mime) {
            case 'image/jpeg':
                $srcImage = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $srcImage = imagecreatefrompng($imagePath);
                break;
            case 'image/gif':
                $srcImage = imagecreatefromgif($imagePath);
                break;
            case 'image/webp':
                $srcImage = imagecreatefromwebp($imagePath);
                break;
            default:
                return false;
        }

        // Create resized image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve PNG transparency
        if ($mime === 'image/png') {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
        }

        imagecopyresampled(
            $resizedImage,
            $srcImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Save to temporary location
        $tmpPath = storage_path('app/tmp_' . uniqid() . '.' . $file->getClientOriginalExtension());
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resizedImage, $tmpPath, 85);
                break;
            case 'image/png':
                imagepng($resizedImage, $tmpPath);
                break;
            case 'image/webp':
                imagewebp($resizedImage, $tmpPath);
                break;
            case 'image/gif':
                imagegif($resizedImage, $tmpPath);
                break;
        }

        // Save to Laravel Storage (e.g., public disk)
        $storagePath = 'uploads/test/' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put($storagePath, file_get_contents($tmpPath));

        // Clean up
        unlink($tmpPath);
        imagedestroy($resizedImage);
        imagedestroy($srcImage);

        return $storagePath;
    }
}
