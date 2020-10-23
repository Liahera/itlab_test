<?php


namespace App\Http\Services;


use Intervention\Image\Facades\Image;

class ImgService
{
    public function saveResizeImage($image)
    {
        $image_name = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');

        $resize_image = Image::make($image->getRealPath());

        $resize_image->resize(300, 300, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);

        $destinationPath = public_path('/images');

        $image->move($destinationPath, $image_name);

        return $image_name;
    }
}
