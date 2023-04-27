<?php

namespace App\utilities\sanitizer;

class sanitizer{

    private $sanitize_filters = array(
        'EMAIL'              => '',
        'ENCODED'            => '',
        'ADD_SLASHES'        => '',
        'NUMBER_FLOAT'       => '',
        'NUMBER_INT'         => '',
        'SPECIAL_CHARS'      => '',
        'FULL_SPECIAL_CHARS' => '',
        'URL'                => '',
        'SPECIAL_CHARS'      => '',
        'RAW'                => ''
    );
    private $validate_filters = array(
        'BOOLEAN'            => '',
        'DOMAIN'             => '',
        'FLOAT'              => '',
        'IP'                 => '',
        'INT'                => '',
        'REGEXP'             => '',
        'URL'                => ''
    );

    public static function validate_register($data,$filters=[],$flag=''){
        if(filter_has_var(INPUT_POST,'submit')){
            $result=array();
            foreach($filters as $key => $value){

                if(filter_has_var(INPUT_POST,$value) && empty($data[$value]))
                    return false;
                    
            }
        }
    }

    public static function sanitize($data,$filters,$flag=''){
        
    }
}