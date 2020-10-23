<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ResizeController extends Controller
{
    public function index()
    {
    return view('resize');
    }
    function resize_image(Request $request)
    {
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpeg,png|max:2048'
        ]);

        $image = $request->file('image');

        $image_name = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');

        $resize_image = Image::make($image->getRealPath());

        $resize_image->resize(300, 300, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);

        $destinationPath = public_path('/images');

        $image->move($destinationPath, $image_name);

        return back()
            ->with('success', 'Image Upload successful')
            ->with('imageName', $image_name);

    }
}
