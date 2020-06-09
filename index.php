<?php

/* This is the Currency Controller*/


$valuteIdsList = NULL;
$valuteID = "";
    $dateFrom = "";
    $dateTo = "";
    $_GET['action'] = "";
    $valuteList = "";
    

 // Get the database connection file
require_once 'library/connections.php';
 require_once 'classes/Currency.php';
  require_once 'model/currencies-model.php';
  
  
  $valuteIds = getValuteIds();
  
  
  /*
  if($valuteIds){
  $currency = new Currency();
if ($currency->load()){    
    $usd_curs = $currency->get();
    for($i=0;$i<count($usd_curs);$i++){
 for($j=0;$j<count($usd_curs[$i]);$j++){
  $date=strtotime((string)$usd_curs[$i]['Date']);
  $date=(string)$date;
  $valuteID = (string)$usd_curs[$i]->Valute[$j]['ID'];
 $numCode = (string)$usd_curs[$i]->Valute[$j]->NumCode;
 $charCode = (string)$usd_curs[$i]->Valute[$j]->CharCode;
 $nominal = (string)$usd_curs[$i]->Valute[$j]->Nominal;
 $name = (string)$usd_curs[$i]->Valute[$j]->Name;
 $value = (string)$usd_curs[$i]->Valute[$j]->Value;
 
 }
 }
 
}

  }
  
  */
  

  if(!$valuteIds){
  $currency = new Currency();
if ($currency->load()){    
    $usd_curs = $currency->get();
    for($i=0;$i<count($usd_curs);$i++){
 for($j=0;$j<count($usd_curs[$i]);$j++){
  $date=strtotime((string)$usd_curs[$i]['Date']);
  $date=(string)$date;
  $date=(int)$date;
 // $date=(string)$usd_curs[$i]['Date'];
  $valuteID = (string)$usd_curs[$i]->Valute[$j]['ID'];
 $numCode = (string)$usd_curs[$i]->Valute[$j]->NumCode;
 $charCode = (string)$usd_curs[$i]->Valute[$j]->CharCode;
 $nominal = (string)$usd_curs[$i]->Valute[$j]->Nominal;
 $name = (string)$usd_curs[$i]->Valute[$j]->Name;
 $value = (string)$usd_curs[$i]->Valute[$j]->Value;
 addCurrencyRecord($valuteID, $numCode, $charCode, $nominal, $name, $value, $date);
 }
 }
 
}

  }
 
 
  
  // Get the valute ids
  $valuteIds = getValuteIds();
$allValutes = getAllValutes();
//$minId = getMinId();
//$lastDate = getLastDate($minId[0]);
$lastDate = getLastDate();
$lastDate = date('Y-m-d', (int)$lastDate[0]);
$date = date_create($lastDate);
$monthAgo = date_sub($date,date_interval_create_from_date_string("31 days"));
$monthAgo = date_format($monthAgo,"Y-m-d");

//$latestDateTimestamp=strtotime($lastDate[0]);
//$date=date_create($lastDate[0]);
//$latestDate = date_format($date,"Y-m-d");
//$monthAgo = date_sub($date,date_interval_create_from_date_string("31 days"));
//$monthAgo = date_format($monthAgo,"Y-m-d");
 

  
   
 if($_GET['action']){
$action = $_GET['action'];
 } else {
  $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  
 }
 }
 
  
 switch ($action){
  
  case 'getValutes':
   
   
   $valuteID = $_GET['valuteID'];
   $dateFrom = $_GET['dateFrom'];
   /*
   $dateFrom = explode(".", str_replace("-", ".", $dateFrom));
   $array = array_reverse($dateFrom);
   $dateFrom = join(".",$array);
    * */
   $dateTo = $_GET['dateTo'];
   /*
   $dateTo = explode(". ", str_replace("-", ".", $dateTo));
  $array = array_reverse($dateTo);
   $dateTo = join(".",$array);
    */
    
   
   $dateFrom = strtotime($dateFrom);
    $dateFrom = (string)$dateFrom;
    $dateFrom = (int)$dateFrom;
    $dateTo = strtotime($dateTo);
     $dateTo = (string)$dateTo;
     $dateTo = (int)$dateTo;
    
    
   
   $valutes = getValutes($valuteID, $dateFrom, $dateTo);
   if(count($valutes) > 0){
    
    $valuteList = '<table class="table table-hover">';
    $valuteList .= '<thead>';
    $valuteList .= '<tr><th>valuteID</th><th>numCode</th><th>сharCode</th><th>nominal</th><th>name</th><th>value</th><th>date</th></tr>';
    $valuteList .= '</thead>';
    $valuteList .= '<tbody>';
    foreach ($valutes as $valute) {
     $valuteList .= "<tr><td>$valute[valuteID]</td>";
     $valuteList .= "<td>$valute[numCode]</td>";
     $valuteList .= "<td>$valute[charCode]</td>";
     $valuteList .= "<td>$valute[nominal]</td>";
     //$valuteList .= "<td>".@substr_replace($valute[name] ,"", -1)."</td>";
     $valuteList .= "<td>$valute[name]</td>";
     $valuteList .= "<td>$valute[value]</td>";
     @$dateForTable = date('Y-m-d', (int)$valute[date]);
     $valuteList .= "<td>$dateForTable</td></tr>";
    }
    $valuteList .= '</tbody></table>';
     
     
   } else {
    $valuteList = '<p>Sorry, no information was returned.</p>';
   }   
     //echo var_dump($date);
    include 'views/currencies-list.php';
   break;
    
  default:
      //echo var_dump($date);
  include 'views/currencies-list.php';
 }
