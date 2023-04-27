<?php


class xml{
    public function xml(){
        $obj = simplexml_load_file('https://www.digikala.com/sitemap.xml');

        if($obj == false){
        echo "Error ...";
        foreach(libxml_get_errors() as $error) {
           echo $error->message;
        }
        exit();
        }

        $json = json_encode($obj);
        $array_xml = json_decode($json,true);
        
        $gzip =  file_get_contents($array_xml['sitemap'][0]['loc']);


        $gzipXml = gzdecode($gzip);
        $gzipXml = simplexml_load_string($gzipXml); 
        
        $jsonXml = json_encode($gzipXml);
        $obj_xml = json_decode($jsonXml,true);
        var_dump($obj_xml['url'][0]['loc']);


  }

}