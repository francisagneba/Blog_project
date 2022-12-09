<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadFile extends AbstractController{

    //On va creer une methode qui va nous permettre de génerer des noms

    public function generate_name($length = 20){
        $code = "aze5rty2uio6plm9kjh1gfds2qnbv3cxw2ww888mlkjkjhgguioop9654kjjh";
        $result ="";

        while(strlen($result) <20){
            $result .= $code[rand(0, strlen($code)-1)];

        }
        return $result;

    }

    //On va creer une metode qui va sauvegarder le fichier
     public function saveFile($file){

        //On commence par recuperer l'extention du  fichier
        $extention = $file->guessExtension();

        //Aulieu de garder le nom original de l'image on va lui genere un nouveau nom
        //$filename = $file->getClientOriginalName();

        $filename = $this->generate_name(30).".".$extention;
        $file->move($this->getParameter('image_dir'), $filename);

        return '/_assets/images/articles/'.$filename;

     }

     public function updateFile($file, $old_file){
        $file_url = $this->saveFile($file);
        try {
            unlink($this->getParameter('static_dir').$old_file);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $file_url;
    }

}