<?php

class Collection{

    private $pages = array();
    private $pageCount = 0;

    public function where($field, $sign, $val){

        $elmsClass = new Collection; $ind = 0;
        foreach ($this as $key => $value) {
            if(gettype($value) == "object"){
                switch ($sign) {
                    case '=':

                        if($value->{$field} == $val){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 

                        break;
                    case 'LIKE':

                        if(preg_match('/'.$val.'/',  $value->{$field})){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 
        
                        break;                    

                    case '>':

                        if($value->{$field} > $val){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 
                            
                        break;    
                    case '<':

                        if($value->{$field} < $val){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 
                                
                        break;                                     
                    case '>=':

                        if($value->{$field} >= $val){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 
                            
                        break;    
                    case '<=':

                        if($value->{$field} <= $val){
                            $elmsClass->{$ind} = $value;
                            $ind++;
                        } 
                                
                        break;                                     
                    
                    default:
                        
                        break;
                }
            }
            
        }

        return $elmsClass;

            
    }

    public function delete(){
        
        foreach ($this as $key => $value) {
            
            $modelClass = get_class($value);
            $modelClass::deleteItem($value);

        }

    }

    public function paginate($num){
        
        $result_collection = new Collection; 

        $elmsClass = new Collection; $ind = 0;
        foreach ($this as $key => $value) {

            if(gettype($value) == "object"){
                    
                $elmsClass->{$ind} = $value;
                $ind++;

                if(end($this)==$value || $ind==($num)){

                    array_push($result_collection->pages,$elmsClass);
                    $result_collection->pageCount += 1;
                    $ind = 0; 
                    $elmsClass = new Collection;
                    
                }               


                
            }
            
        }

        return $result_collection;

    }

    public function page($num){

        return $this->pages[$num];

    }

    public function links(){

        if(isset($_GET['page'])){
            $num = $_GET['page'];
        }else $num = 1;
    
        $html = "";
        $html .= "<ul class='pagination justify-content-center'>";
        if($num == 1){
            $html .= "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Précédent</a></li>";
        }else{
            $html .= "<li class='page-item'><a class='page-link' href='".$this->url('?page='.($num-1))."' tabindex='-1'>Précédent</a></li>";
        }

        for($i=0; $i < $this->pageCount; $i++){

            if($num == $i+1){
                $html .= "<li class='page-item active'><a class='page-link' href='".$this->url('?page='.($i+1))."'>".($i+1)."</a></li>";
            }else{
                $html .= "<li class='page-item'><a class='page-link' href='".$this->url('?page='.($i+1))."'>".($i+1)."</a></li>";
            }

        }

        if($num == $this->pageCount){
            $html .= "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Suivant</a></li>";
        }else{
            $html .= "<li class='page-item'><a class='page-link' href='".$this->url('?page='.($num+1))."' tabindex='-1'>Suivant</a></li>";
        }        

        $html .= "</ul>";
        

        return $html;

    }

    private function url($add = ''){ 

        $arr_split = explode('/',$_SERVER['SCRIPT_FILENAME']);

        $url = 'http://'.$_SERVER['HTTP_HOST'].'/';
        if($arr_split[count($arr_split)-2] != 'www'){

            $url .= $arr_split[count($arr_split)-2];

        }

        $url .= '/' . $add;

        return $url;
        
    }  
    
    public function empty(){

        if(isset($this->{0})) return false; else return true;
        
    }

    public function get(){

        if(isset($this->{0})) return $this->{0}; else return false;

    }



}

?>