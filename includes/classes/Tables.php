<?php
require_once("Database.php");

class Table extends Database {

  public $cols = [];
  public $sql = "";
  public static $table;

  public function Column($name, $type, $primary=["primary"=>"false"]){
    $column = "";
    if ($type == "int" && $primary["primary"] == "true") {
      $column = $name." INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY ";
      array_push($this->cols, $name);
    }
    elseif ($type == "text") {
      $column = $name." TEXT DEFAULT NULL ";
      array_push($this->cols, $name);
    }
    elseif ($type == "datetime") {
      $column = $name." TIMESTAMP DEFAULT CURRENT_TIMESTAMP ";
      array_push($this->cols, $name);
    }
    elseif ($type == "varchar") {
      $column = $name." VARCHAR(255) DEFAULT NULL ";
      array_push($this->cols, $name);
    }
    elseif ($type == "integer") {
      $column = $name." INT(11) DEFAULT NULL ";
      array_push($this->cols, $name);
    }

    $this->sql .= $column. ", ";

  } 


  public function commit(){
    $this->sql = substr($this->sql, 0, -2);
    $sql = "CREATE TABLE IF NOT EXISTS ".static::$table. " (".$this->sql. ")";
    print($sql);
    $stmt = static::$pdo->prepare($sql);
    if(!$stmt->execute()){
      print_r($stmt->errorInfo());
    }

  } 

} 





 ?>
