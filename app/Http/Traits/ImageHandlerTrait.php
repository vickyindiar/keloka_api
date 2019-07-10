<?php
namespace App\Http\Traits;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Image;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait ImageHandlerTrait {

    public function uploadOne(Request $request, $row = null){
     $file = $request->has('image') ?$request->file('image') : ( $request->has('photo') ?  $request->file('photo')  : null );
     try {
            if($file) {
                                // using image.intervention.io
                $newImage = Image::make($file)->resize(400, 400);
                $name        = str_slug($request->input('name')).'_'.time();
                $path        = '/upload/images/';
                $fullpath    = $path.$name.'.'.$file->getClientOriginalExtension();
                //$uploaded    = $resizedFile->storeAs($folder, $name.'.'.$file->getClientOriginalExtension(), 'public');

                if($row) { //replace image
                    $oldImage = array_key_exists('image', $row->attributesToArray()) ? $row->image : ( array_key_exists('photo', $row->attributesToArray()) ?  $row->photo  : null );
                    if(Storage::disk('public')->exists($oldImage)){
                            Storage::disk('public')->delete($oldImage);
                    }
                }
                $newImage->save(public_path() . $fullpath);
                return $fullpath;
            }
            else {
                return null;
            }
        } catch (Exception $e) {
           return false;
        }
    }




}
