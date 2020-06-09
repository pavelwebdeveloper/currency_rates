<?php

function addCurrencyRecord($valuteID, $numCode, $charCode, $nominal, $name, $value, $date) {
 // Create a connection object using the acme connection function
 $db = currencyConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'INSERT INTO currency (valuteID, numCode, charCode, nominal, name, value, date) VALUES (:valuteID, :numCode, :charCode, :nominal, :name, :value, :date)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':valuteID', $valuteID, PDO::PARAM_STR);
 $stmt->bindValue(':numCode', $numCode, PDO::PARAM_STR);
 $stmt->bindValue(':charCode', $charCode, PDO::PARAM_STR);
 $stmt->bindValue(':nominal', $nominal, PDO::PARAM_STR);
 $stmt->bindValue(':name', $name, PDO::PARAM_STR);
 $stmt->bindValue(':value', $value, PDO::PARAM_STR);
 $stmt->bindValue(':date', $date, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

function getValuteIds() {
 // Create a connection object from the acme connection function
 $db = currencyConnect();
 // The SQL statement to be used with the database 
 $sql = 'SELECT DISTINCT valuteID FROM currency ORDER BY valuteID ASC';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line runs the prepared statement 
 $stmt->execute();
 // The next line gets the data from the database and 
 // stores it as an array in the $categories variable 
 $valuteIds = $stmt->fetchAll();
 // The next line closes the interaction with the database 
 $stmt->closeCursor();
 // The next line sends the array of data back to where the function 
 // was called (this should be the controller)
 return $valuteIds;
}


function getValutes($valuteID, $dateFrom, $dateTo){
 // Create a connection object using the acme connection function
 $db = currencyConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'SELECT * FROM currency WHERE valuteID=:valuteID AND (date BETWEEN :dateFrom AND :dateTo)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':valuteID', $valuteID, PDO::PARAM_STR);
 $stmt->bindValue(':dateFrom', $dateFrom, PDO::PARAM_INT);
 $stmt->bindValue(':dateTo', $dateTo, PDO::PARAM_INT);
  $stmt->execute();
  $valutes = $stmt->fetchall(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $valutes;
}

function getAllValutes(){
 // Create a connection object using the acme connection function
 $db = currencyConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'SELECT * FROM currency';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
  $stmt->execute();
  $valutes = $stmt->fetchall(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $valutes;
}

/*
function getMinId() {
 // Create a connection object from the acme connection function
 $db = currencyConnect();
 // The SQL statement to be used with the database 
 $sql = 'SELECT MIN(id) AS minId FROM currency';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line runs the prepared statement 
 $stmt->execute();
 // The next line gets the data from the database and 
 // stores it as an array in the $categories variable 
 $minId = $stmt->fetch();
 // The next line closes the interaction with the database 
 $stmt->closeCursor();
 // The next line sends the array of data back to where the function 
 // was called (this should be the controller)
 return $minId;
}
 
 */



function getLastDate() {
 // Create a connection object from the acme connection function
 $db = currencyConnect();
 // The SQL statement to be used with the database 
 //$sql = 'SELECT date FROM currency where id = :minId';
 $sql = 'SELECT MAX(date) FROM currency';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 //$stmt->bindValue(':minId', $minId, PDO::PARAM_INT);
 // The next line runs the prepared statement 
 $stmt->execute();
 // The next line gets the data from the database and 
 // stores it as an array in the $categories variable 
 $lastDate = $stmt->fetch();
 // The next line closes the interaction with the database 
 $stmt->closeCursor();
 // The next line sends the array of data back to where the function 
 // was called (this should be the controller)
 return $lastDate;
}
