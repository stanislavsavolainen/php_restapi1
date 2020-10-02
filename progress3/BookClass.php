<?php

    class BookClass {


        private $data = array();

        
        //isbn number
        public $bib_key;
        public $preview;
        public $thumbnail_url;
        public $preview_url;
        public $info_url;
        /*
        function setBibKey($param_bib_key){
           $this->$bib_key = $param_bib_key;
       }

        function getBibKey(){
            return $this->$bib_key;   
        }

        function setPreview($param_preview){
            $this-> $preview = $param_preview;
        }

        function getPreview(){
            return $this->$preview;
        }
        
        function setThumbnailUrl($param_thumbnail_url){
            $this->$thumbnail_url = $param_thumbnail_url;
        }

        function getThumbnailUrl(){
            return $this->$thumbnail_url;
        }
        
        function setPreviewUrl( $param_preview_url ){
            $this->$preview = $param_preview_url;
        }

        function getPreviewUrl(){
            return $this->$preview_url;
        }
        
        function setInfoUrl( $param_info_url ){
            $this->$info_url = $param_info_url;
        }

        function getInfoUrl(){
            return $this->$info_url;
        }

       */

        public function __set( $name, $value ){
            $this->$data[$name] = $value;
        }

        public function __get($name){
            return $this->$data[$name];
        }


    }


?>