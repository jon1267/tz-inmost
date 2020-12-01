<?php

namespace App\Services\Images;

use Illuminate\Support\Str;
use Image;

class Img
{
    public function getImg($request)
    {
        $imgPath = null;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension(); // ? strtolower()
                $filename = time() . '-' . Str::random(8) . '.' . $ext;
                //dd($image, $filename, $ext);

                $img = Image::make($image);
                //$img->fit(600,200)->save(public_path().'/'.'img/'.$filename);//резать очень индивидуально
                $img->save(public_path() . '/' . 'img/' . $filename);

                $imgPath = $filename;

            }
        }

        return $imgPath;
    }

    public function updateImg($request, $product)
    {
        $imgPath = $product->img;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            if ($image->isValid()) {
                $imgPath = $this->getImg($request);
            }
        }

        return $imgPath;
    }
}
