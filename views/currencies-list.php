<?php 

 // Build a dynamic drop-down select list using the $valuteIds array
 $valuteIdsList .= '<select name="valuteID" id="valuteID">';
 $valuteIdsList .= '<option disabled selected>Choose a valuteID</option>';
 foreach ($valuteIds as $valuteId) {
 $valuteIdsList .= "<option value='$valuteId[valuteID]'";
 $valuteIdsList .= ">$valuteId[valuteID]</option>";
 }
 $valuteIdsList .= '</select>';
?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Currencies</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 </head>
 <body >
  
  <main id="main">
   <div class="container">
  <div class="jumbotron">
   <?php
   /*
   if (isset($usd_curs)) {
    $time = strtotime((string)$usd_curs[3]['Date']);
    $time = (string)$time;
    var_dump($time);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]['ID']);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]->NumCode);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]->CharCode);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]->Nominal);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]->Name);
    print_r('<br>');
    print_r((string)$usd_curs[3]->Valute[1]->Value);
    print_r('<br>');
    print_r(count($usd_curs));
    print_r('<br>');
    print_r(count($usd_curs[3]));
    echo "<br>";
    echo "<br>";
    //$time = strtotime('10/16/2003');
 
//$newformat = date('Y-m-d',$time);
   }
    */
    
   ?>
   
   
   <form action="/phpprojects/currency_rates/index.php" method="post">
    <fieldset>
   <?php
   echo "<br>";
   echo "<br>";
   
   //echo var_dump($lastDate);
   //On 2019-08-19, this resulted in 2019-08-12
echo "In order to get results for the currency rates you should choose dates within the range from <strong>".$monthAgo."</strong> till <strong>".$lastDate."</strong>";
echo "<br>";
echo "<br>";
   
   echo $valuteIdsList;
   echo "<br>";
   echo "<br>";
   //echo var_dump($allValutes);
   //echo "<br>";
   
   ?>
   <label for="birthday">Date from:</label>
  <input type="date" id="dateFrom" name="dateFrom">
  <label for="birthday">Date to:</label>
  <input type="date" id="dateTo" name="dateTo">
  <input class="submitBtn" type="submit" value="Get Rates" onclick="getValutes()">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="$valuteList" >
    </fieldset>
    

   </form>
   <?php
   echo "<br>";
   echo "<br>";
   echo $valuteList;
   //echo $lastDate[0];
   echo "<br>";
   
   ?>
   <p id="bottomline"></p>
  </main>
  <script>
    

  function getValutes() {
 var str = "getValutes";
 var valuteID = document.getElementById("valuteID").value;

 var dateFrom = document.getElementById("dateFrom").value;
 var dateTo = document.getElementById("dateTo").value;
 
   var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("main").innerHTML = this.responseText;
      } else {
       document.getElementById("main").innerHTML = "The request is being processed............";
      }
    };
    xmlhttp.open("GET", "/phpprojects/currency_rates/index.php?action="+str +"&valuteID="+valuteID+"&dateFrom="+dateFrom+"&dateTo="+dateTo, true);
    xmlhttp.send();
    console.log(dateFrom);
 console.log(typeof dateFrom);
 console.log(dateFrom);
 console.log(typeof dateTo);
 console.log(valuteID);
 console.log(typeof valuteID);
    
   
    
   }
   
   
</script>
  </div>
    </div>
 </body>
</html>


