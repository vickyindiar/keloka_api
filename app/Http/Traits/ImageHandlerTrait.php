<?php
namespace App\Http\Traits;

use Image;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\Storage;


trait ImageHandlerTrait {


    public function deleteOne($row): void{
        if($row) { //replace image
            $oldImage = array_key_exists('image', $row->attributesToArray()) ? $row->image : ( array_key_exists('photo', $row->attributesToArray()) ?  $row->photo  : null );
            if(Storage::disk('public')->exists($oldImage)){
                    Storage::disk('public')->delete($oldImage);
            }
        }
    }

    public function uploadOne(Request $request, $row = null){
     $file = $request->has('image') ?$request->file('image') : ( $request->has('photo') ?  $request->file('photo')  : null );
     try {
            if($file) {
                                // using image.intervention.io
                $newImage    = Image::make($file)->resize(400, 400);
                $name        = str_slug($request->input('name')).'_'.time();
                $path        = '/upload/images/';
                $fullpath    = $path.$name.'.'.$file->getClientOriginalExtension();
                //$uploaded    = $resizedFile->storeAs($folder, $name.'.'.$file->getClientOriginalExtension(), 'public');

                $this->deleteOne($row);
                $newImage->save(public_path() . $fullpath);
                return $fullpath;
            }
            else {
                return null;
            }
        } catch (Exception $e) {
           return response()->json($e->getMessage(), 400);
           //  return response()->json(['msg' => 'failed upload image'], 400);
        }
    }

}
