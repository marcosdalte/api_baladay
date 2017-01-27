<?php 

// namespace Settings {
class Settings {
        private $conf;

    public function __construct($conf = null){
        $this->setConf($conf);
        
    }
    
    public function setConf(){
        $this->conf = array('settings' => [
                    'displayErrorDetails' => true,
                    'addContentLengthHeader' => false,
                    ],
                    'authentication' => [
                        'keyword' => 'Baladay',
                        'api_key' => 'sKpDMwwP9ngBf7I4',
                        'api_secret' => 'RNe9NiCec3ENMe4q7KJkwm52',
                    ],
                    'single' => 'single',
                    );
        return $this;
    }
    
    public function getConf(){
        return $this->conf;   
    }
    
    public function getConfValue($attr){
        $conf = $this->getConf();
        foreach ($conf as $keyOne => $value) {
            if(is_array($value)){
                foreach ($value as $keyTwo => $secValue){
                    if(!strcmp($keyTwo, $attr))
                        return $secValue;
                }
            } else {
                if(!strcmp($keyOne, $attr))
                    return $value;
            }
        }
        return null;   
    }
        
}

