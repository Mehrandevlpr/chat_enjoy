<?php

namespace App\utilities\uploader;
use App\exceptions\upload\uploadException;
use App\exceptions\upload\imageNotValidException;
use App\exceptions\upload\uploadSizeException;

class uploader{

    private $imageFileType;
    private $file;
    private $upload_status = FALSE; 
    private $newFilePath;
    private $hashProfile;
    private $mime_types = array(

        'gif' => 'image/gif',
        'jfif' => 'image/jpeg',
        'jfif' => 'image/pjpeg',
        'jfif-tbnl' => 'image/jpeg',
        'jpe' => 'image/jpeg',
        'jpe' => 'image/pjpeg',
        'jpeg' => 'image/jpeg',
        'jpeg' => 'image/pjpeg',
        'jpg' => 'image/jpeg',
        'jpg' => 'image/pjpeg'

    ); 

    

    public  function __construct($file_global,$subFolder=null){

        if(!$file_global['error'] === 4 && !isset($file_global['tmp_name'])){
          throw new uploadException();
        }

        $this->file             = $file_global;
        $this->imageFileType    = $this->getExtention();
        $this->newFilePath      = $this->baseName();
        

        $this->checkMimeType();
        $this->fileSize();
        $this->add();
        return $this;
    }

    public function baseName(){
       return STORAGE_PATH.$this->generatRandomName().'.'.$this->imageFileType;
    }

    public function getExtention(){

        return strtolower(pathinfo($this->file["name"],PATHINFO_EXTENSION));
        
    }

    public function add(){

        if (file_exists($this->newFilePath)) {
            echo "Sorry, file already exists.";
            $this->upload_status = FALSE;
        }
        $this->upload_status = true ;
    }

    public function save(){

        if ($this->upload_status === FALSE) {
          echo "Sorry, your file was not uploaded.";
          $this->removeProfile();
          return FALSE;
          // if everything is ok, try to upload file
        } 
         
        $upload = move_uploaded_file($this->file["tmp_name"], $this->newFilePath);

        if( $upload === FALSE){
            echo "Sorry, there was an error uploading your file.";
            unlink($upload);
        }
        echo "The file ". htmlspecialchars( basename($this->file["name"])). " has been uploaded.";
       return $filePaths = array(
           
            'profile'      => $this->newFilePath,
            'profileHash'  => urlencode($this->newFilePath)
       );
      
    }

    public function checkMimeType(){

        if(!in_array($this->imageFileType,array_keys($this->mime_types))){
            throw new imageNotValidException();
        }

    }

    public function generatRandomName(){
        return md5($this->file["name"])."-profile";
    }

    public function fileSize(){

        if ($this->file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            throw new uploadSizeException();
        }
    }

    public static function getHashProfile(){
        return self::$hashProfile;
    }

    public  function removeProfile(){
        if (file_exists($this->newFilePath)) 
             unlink($this->newFilePath);

    }


}