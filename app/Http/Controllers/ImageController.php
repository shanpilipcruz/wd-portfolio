<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadPhoto(Request $request){
        $image = $request->get('profile_img');

        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';

        $path = public_path('images/profile_images/'.$image_name);

        file_put_contents($path , $image);
        /*return response()->json(['status'=>true]);*/
        return $image_name;
    }
}
