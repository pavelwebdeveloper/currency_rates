<?php

class Currency
{
    
    protected $list = array();
     protected $sublist = array();
   
     
    public function load()
    {
     $scripturl = 'http://www.cbr.ru/scripts/XML_dynamic.asp';
     
        $xml = new DOMDocument();
        //$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
        $countdown = 0;
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y', time()-$countdown);
        //$url = 'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=02/03/2001&date_req2=14/03/2001';
        //$list = simplexml_load_file($url);
        
        
        
//валюты
        
         if ($list = simplexml_load_file($url))
         {
          
          for($i=0;$i<=35;$i++){ 
          $this->sublist = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y', time()-$countdown));
          $countdown += 86400;
          array_push($this->list, $this->sublist);
          }
          
 
            return true;
        } 
        else
            return false;
    }
    
    public function get()
    {
        return isset($this->list) ? $this->list : 0;
    }
}

