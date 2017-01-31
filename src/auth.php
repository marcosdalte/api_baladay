<?php

class auth {
    private $app;
    
    public function __construct($app = null){
        $this->setApp($app);
    }
    
    public function getApp(){
        return $this->app;
    }
    
    public function setApp($app){
        $this->app = $app;
        return $this;
    }
    
    public function verify($header){
        $signature = $this->create_signature();
        if (!strcmp(str_replace(' ', '',$header),$signature)){
            return true;
        }else{
            return false;
        }
    }
    
    private function cript($key){
        return hash('sha256', $key);
    }
    
    private function create_signature(){
        $app = $this->getApp();
        $conf = new Settings;
        $keyword = $conf->getConfValue("keyword");
        $api_key = $conf->getConfValue("api_key");
        $api_secret = $conf->getConfValue("api_secret");
        
        $signature = $keyword . $api_key . ":" . $this->cript($api_secret);
        return $signature;
    }
}
