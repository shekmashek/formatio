<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class getImageModel extends Model
{
    //fonction récupération photos depuis google drive
    public function get_image($path,$folder){
        //liste des contenues dans drive
           $contents = collect(Storage::cloud()->listContents('/', false));
           //recuperer dossier "entreprise
            $dir = $contents->where('type', '=', 'dir')
           ->where('filename', '=', $folder)
           ->first();

           $files = collect(Storage::cloud()->listContents($dir['path'], false))
           ->where('type', '=', 'file')
           ->where('filename', '=', pathinfo($path, PATHINFO_FILENAME))
           ->where('extension', '=', pathinfo($path, PATHINFO_EXTENSION))
           ->first();
           $rawData = Storage::cloud()->get($files['path']);
           return response($rawData)->header('Content-Type','image.png');
    }

    //fonction enregistrement photos vers google drive
    public function store_image($folder,$nom_image,$photos){
        //liste des contenues dans drive
        $contents = collect(Storage::cloud()->listContents('/', false));
        //recuperer dossier "entreprise
        $dir = $contents->where('type', '=', 'dir')
        ->where('filename', '=', $folder)
        ->first();
        Storage::cloud()->put($dir['path'].'/'.$nom_image, $photos);
    }
    //fonction qui crée un sous - dossier dans drive
    public function create_sub_directory($folder,$sub_folder){
        $contents = collect(Storage::cloud()->listContents('/', false));
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder)
            ->first(); // There could be duplicate directory names!
        if ( ! $dir) {
            return 'Directory does not exist!';
        }
        // Create sub dir
        Storage::cloud()->makeDirectory($dir['path'].'/'.$sub_folder);
    }
}
