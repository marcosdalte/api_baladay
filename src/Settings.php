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
                        'keyword' => 'keyword',
                        'api_key' => 'api_key',
                        'api_secret' => 'api_secret',
                    ],
                    'logger'  => [
                        'name' => 'api-baladay',
                        'path' => __DIR__ . '/../logs/app.log',
                        'level' => \Monolog\Logger::DEBUG,
                    ],
                    "db" => [
                        "host" => "localhost",
                        "dbname" => "baladay",
                        "user" => "root",
                        "pass" => ""
                    ],
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

