<?php
require_once (dirname(__FILE__).'\session_logged.php');

class pageAssets{
    private $js = array();
    private $css = array();

    //getters
    public function getJs(){
        return $this->js;
    }
    public function getCss(){
        return $this->css;
    }
    public function doJs(){
        foreach ($this->js as $key => $value) {
            print('<script type="text/javascript" src="'.$value.'"></script>');
        }
    }
    public function doCss(){
        foreach ($this->css as $key => $value) {
            print('<link rel="stylesheet" href="'.$value.'">');
        }
    }

    //setters
    //seta todo o array de endereços de js files
    public function setJs($value){
        try{
            $this->js = $value;
        }catch(Exception $e){
            return "erro ao incluir js, verifique o array: ".$e->getMessage();
        }
    }
    public function setCss($value){
        try{
            $this->css = $value;
        }catch(Exception $e){
            return "erro ao incluir css, verifique o array: ".$e->getMessage();
        }
    }
    public function addJs($value){
        array_push($this->js, $value);
    }
    public function addCss($value){
        array_push($this->css, $value);
    }

}


?>
