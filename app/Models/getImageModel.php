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
    //fonction qui crée un sous - dossier et enregistre un fichier dans drive / de la forme parent/facture/bc/nom_cfp/sous_dossier_a_creer
    public function create_sub_directory($sub_folder1,$sub_folder2,$cfp_folder,$projet_folder,$namefile,$contentfile){
        $contents = collect(Storage::cloud()->listContents('/', false));
        //parcourir sous dossier:facture par exemple
        foreach ($contents as $key => $value) {
            if($value['name'] == $sub_folder1)
                $root = $value['path'];
        }

        $dir = '/'.$root;
        $root1='';
        $root2='';
        $root3='';
        $root4='';

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        foreach ($sub_directory as $key => $value) {
            if($value['name'] == $sub_folder2)
                $root2 = $value['path'];
        }

        $dir2 = $dir.'/'.$root2;

        $recursive = true; // Get subdirectories also?
        $sub_directory2 = collect(Storage::cloud()->listContents($dir2, $recursive));

        //on teste si le dossier du CFP existe déjà
        $existe = $sub_directory2->where('type', '=', 'dir')
        ->where('filename', '=', $cfp_folder)
        ->first();

        if ($existe == null) {
            Storage::cloud()->makeDirectory($dir2.'/'.$cfp_folder);
        }

        foreach ($sub_directory2 as $key => $value) {
            if($value['name'] == $cfp_folder)
                $root3= $value['path'];
        }
        $dir3 = $dir2.'/'.$root3;
        $recursive = true; // Get subdirectories also?

        $sub_directory3 = collect(Storage::cloud()->listContents($dir3, $recursive));
        //on teste si le dossier projet du CFP existe déjà
        $existeProjet = $sub_directory3->where('type', '=', 'dir')
        ->where('filename', '=', $projet_folder)
        ->first();
        if (!$existeProjet) {
             // Create sub dir pour projet
            Storage::cloud()->makeDirectory($dir3.'/'.$projet_folder);
        }
        foreach ($sub_directory2 as $key => $value) {
            if($value['name'] == $projet_folder)
                $root4= $value['path'];
        }

        $dir4 = $dir3.'/'.$root4;
        $recursive = true; // Get subdirectories also?
        $sub_directory4  = collect(Storage::cloud()->listContents($dir4, $recursive));
        //enregistrer les factures de session dans le dossier projet correspondant
        Storage::cloud()->put($dir4.'/'.$namefile, $contentfile);
    }
    //creation dossier
    public function create_folder($folder_name){
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        $existe = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder_name)
            ->first(); // There could be duplicate directory names!

        if ( ! $existe) {
            Storage::cloud()->makeDirectory($folder_name);
        }

    }
    //recuperation dossier parent
    public function get_folder($folder_name){
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $existe = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder_name)
            ->first();
        return $existe['name'];
    }
     //recuperation dossier parent
     public function get_sub_folder($folder_parent){
        // Get root directory contents...
        $contents = collect(Storage::cloud()->listContents('/', false));

        // Find the folder you are looking for...
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder_parent)
            ->first(); // There could be duplicate directory names!

        // Get the files inside the folder...
        $files = collect(Storage::cloud()->listContents($dir['path'], false))
            ->where('type', '=', 'dir');

        return $files;
    }

    //creer sous dossier
    public function create_sub_folder($folder_parent,$sub_folder){
        $contents = collect(Storage::cloud()->listContents('/', false));
        //parcourir sous dossier:facture par exemple
       $root=null;
        foreach ($contents as $key => $value) {
            if($value['name'] == $folder_parent)
                 $root = $value['path'];
        }

        $dir = '/'.$root;

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        //on teste si le sous dossier exiiste déjà
        $existe = $sub_directory->where('type', '=', 'dir')
        ->where('filename', '=', $sub_folder)
        ->first();
        if ($existe == null) {
            Storage::cloud()->makeDirectory($dir.'/'.$sub_folder);
        }
    }
    //enregistrer document
    public function store_document($folder_parent,$sub_folder,$document_name,$documents){
        //liste des contenues dans drive
        $contents = collect(Storage::cloud()->listContents('/', false));
         //parcourir sous dossier:facture par exemple
        foreach ($contents as $key => $value) {
            if($value['name'] == $folder_parent)
                 $root = $value['path'];
        }
        $dir = '/'.$root;

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        foreach ($sub_directory as $key => $value) {
            if($value['name'] == $sub_folder)
                 $root1 = $value['path'];
        }
        $dir2 = '/'.$root1;

        Storage::cloud()->put($dir2.'/'.$document_name, $documents);
    }

    //liste des fichiers dans le sous-dossier
    public function file_list($folder_parent,$sub_folder){
         //liste des contenues dans drive
         $contents = collect(Storage::cloud()->listContents('/', false));
         //parcourir sous dossier:facture par exemple
        foreach ($contents as $key => $value) {
            if($value['name'] == $folder_parent)
                 $root = $value['path'];
        }
        $dir = '/'.$root;

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        foreach ($sub_directory as $key => $value) {
            if($value['name'] == $sub_folder)
                 $root1 = $value['path'];
        }
        $dir2 = '/'.$root1;

                // Get the files inside the folder...
        $files = collect(Storage::cloud()->listContents($dir2, false))
            ->where('type', '=', 'file');
        // return Storage::cloud()->get($files['path']);
        return $files;
        // return $files->mapWithKeys(function($file) {
        //     $filename = $file['filename'].'.'.$file['extension'];
        //     $path = $file['path'];

        //     // Use the path to download each file via a generated link..
        //     $download =  Storage::cloud()->get($file['path']);

        //     return [$filename => $path];
        // });

    }
    //download file
    public function download_file($folder_parent,$sub_folder,$filename,$extension){

    //     //liste des contenues dans drive
        $contents = collect(Storage::cloud()->listContents('/', false));
        //parcourir sous dossier:facture par exemple
       foreach ($contents as $key => $value) {
           if($value['name'] == $folder_parent)
                $root = $value['path'];
       }
       $dir = '/'.$root;
       $recursive = true; // Get subdirectories also?
       $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
       foreach ($sub_directory as $key => $value) {
           if($value['name'] == $sub_folder)
                $root1 = $value['path'];
       }
       $dir2 = '/'.$root1;

               // Get the files inside the folder...
       $files = collect(Storage::cloud()->listContents($dir2, false))
           ->where('type', '=', 'file')
           ->where('filename', '=', $filename)

           ->first();

        $rawData = Storage::cloud()->get($files['path']);

        return response($rawData, 200)
               ->header('ContentType', $files['mimetype'])
               ->header('Content-Disposition', 'attachment; filename="'.$filename.'.'.$extension.'"');

    //    return $files->mapWithKeys(function($file) {
    //        $filename = $file['filename'].'.'.$file['extension'];
    //        $path = $file['path'];

    //        // Use the path to download each file via a generated link..
    //        Storage::cloud()->get($file['path']);

    //        return [$filename => $path];
    //    });

   }
   //suppression d'un fichier dans google drive
    public function delete_file($folder_parent,$sub_folder,$filename){
        //liste des contenues dans drive
        $contents = collect(Storage::cloud()->listContents('/', false));
        //parcourir sous dossier:facture par exemple
        foreach ($contents as $key => $value) {
            if($value['name'] == $folder_parent)
                $root = $value['path'];
        }
        $dir = '/'.$root;

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        foreach ($sub_directory as $key => $value) {
            if($value['name'] == $sub_folder)
                $root1 = $value['path'];
        }
        $dir2 = '/'.$root1;
        // Get the files inside the folder...
        $files = collect(Storage::cloud()->listContents($dir2, false))
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
        Storage::cloud()->delete($files['path']);
        return 'File was deleted from Google Drive';
    }
    //suppression d'un dossier dans google drive
    public function delete_folder($folder_parent,$sub_folder){
        $contents = collect(Storage::cloud()->listContents('/', false));
        //parcourir sous dossier:facture par exemple
        foreach ($contents as $key => $value) {
            if($value['name'] == $folder_parent)
                 $root = $value['path'];
        }

        $dir = '/'.$root;

        $recursive = true; // Get subdirectories also?
        $sub_directory = collect(Storage::cloud()->listContents($dir, $recursive));
        //on teste si le sous dossier exiiste déjà
        $directory = $sub_directory->where('type', '=', 'dir')
        ->where('filename', '=', $sub_folder)
        ->first();

        Storage::cloud()->deleteDirectory($directory['path']);
    }
}