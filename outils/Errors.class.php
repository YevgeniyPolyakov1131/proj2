<?php

class Errors{

    public function __construct($attributes = null){

        if($attributes !== null){

            foreach ($attributes as $key => $value) {
                $this->addProperty($key, $value);
            }
        }

    }

    private function addProperty($key, $value){

        $this->{$key} = $value;

    }

}


?>