<?php
namespace App\Http\Traits;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Image;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

trait ImageHandlerTrait {

    public function uploadOne(Request $request, $row){
     $file = $request->has('image') ?$request->file('image') : ( $request->has('photo') ?  $request->file('photo')  : null );
     try {
            if($file) {
                                // using image.intervention.io
                $resizedFile = Image::make($file)->resize(400, 400);
                $name        = str_slug($request->input('name')).'_'.time();
                $path        = '/upload/images/';
                $fullpath    = $path.$name.'.'.$file->getClientOriginalExtension();
                //$uploaded    = $resizedFile->storeAs($folder, $name.'.'.$file->getClientOriginalExtension(), 'public');

                if($row) {
                    $pathFile = array_key_exists('image', $row->attributesToArray()) ? $row->image : ( array_key_exists('photo', $row->attributesToArray()) ?  $row->photo  : null );
                    $arr = explode('\\', $pathFile);
                    // TODO

                }


                $resizedFile->save(public_path() . $fullpath);



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
