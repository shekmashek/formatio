<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
class ImageController extends Controller
{
    public function resizeImage()

    {

        return view('layouts.resizeImage');

    }
    public function resizeImagePost(Request $request)

    {
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $image = $request->file('image');
    
        $image_name = time() . '.' . $image->getClientOriginalExtension();
    
        $destinationPath = public_path('/image_resize');
    
        $resize_image = Image::make($image->getRealPath());
    
        $resize_image->resize(256, 128, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);
    
        $destinationPath = public_path('/images');
    
        $image->move($destinationPath, $image_name);
  
        return back()
            ->with('success', 'Image Upload successful')
            ->with('imageName', $image_name);
    
    }
}

