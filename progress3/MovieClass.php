<?php

class MovieClass {

        //variable for "php magic methods" __get and __set
        private $data = array();


        private $title;
        private $year;
        private $actors = array();
        private $plot;

        function setTitle( $param_title ){
            $this -> $title = $param_title;
        }

        function getTitle(){
            return $this -> $title;
        }

        function setYear( $param_year ){
            $this -> $year = $param_year;
        }

        function getYear() {
            return $this -> $year;
        }


        function setActors( $param_actors ){
             $this -> $actors = $param_actors;
        }

        function getActors() {
            return $this -> $actors;
        }

        function setPlot( $param_plot ) {
             $this -> $plot = $param_plot; 
        }

        function getPlot() {
            return $this -> $plot;
        }

        //this is so called "php magic methods" , oportunity to avoid getter and setter for each variable
        //not sure at the moment if I use this model in this project as part of OOP - patern
        public function __set( $name, $value ){
            $this->$data[$name] = $value;
        }

        public function __get($name){
            return $this->$data[$name];
        }


    }

?>

