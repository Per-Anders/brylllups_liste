<?php



class Database {


  public static $table;
  public static $tableId;
  public static $pdo;
  public $form;



  // public function connection(){
  //   static::$pdo = new PDO('mysql:hostname=blurred;charset=utf8', 'blurred', 'blurred');
  // }

  public function connect_to_database($db_name){
    static::$pdo = new PDO('mysql:hostname=blurred;dbname='.$db_name.';charset=utf8', 'blurred', 'blurred');
  }

  public function create_database($db_name) {
    $sql = "CREATE DATABASE IF NOT EXISTS " . $db_name;
    $stmt = static::$pdo->prepare($sql);
    $stmt->execute();
    static::$pdo = new PDO('mysql:hostname=blurred;dbname='.$db_name.';charset=utf8', 'blurred', 'blurred');
  }



  public function create($form){
    $table = static::$table;
    $form = array_map(function($v){
      return trim(strip_tags($v));
    }, $form);

    $col = implode(', ', array_keys($form));
    $value = ":".implode(', :', array_keys($form));

    $sql = "INSERT INTO $table ($col) VALUES ($value)";
    $stmt = static::$pdo->prepare($sql);

    foreach($form as $k => $v){
      $stmt->bindValue(":".$k, $v);
    }

    if(!$stmt->execute()){
      print_r($stmt->errorInfo());
    }

  } // END create


public function update($form, $id){
  $table = static::$table;
  $tableId = static::$tableId;

  $form = array_map(function($v){
    return trim(strip_tags($v));
  }, $form);

  $columns = '';
  $i = 1;
  foreach($form as $name => $value){
    $columns .= "{$name} = :{$name}";
    if($i < count($form)) {
      $columns .= ', ';
    }
    $i++;
  }

  $sql = "UPDATE $table SET {$columns} WHERE $tableId = :id LIMIT 1";
  $stmt = static::$pdo->prepare($sql);
  $stmt->bindValue(":id", $id);

  foreach($form as $k => $v){
    $stmt->bindValue(":".$k, $v);
  }
  if(!$stmt->execute()){
    print_r($stmt->errorInfo());
  }
} // END UPDATE



  public function find_all(){
    $table = static::$table;
    $sql = "SELECT * FROM $table";
    $stmt = static::$pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  public function find_by_id($id){
    $table = static::$table;
    $tableId = static::$tableId;

    $sql = "SELECT * FROM $table WHERE $tableId = :id";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }



  public function find_by_filter($table="", $column="", $criterion="", $order_by="", $limit="") {
    $tableId = static::$tableId;
    $sql = "SELECT ";

    if ($column != "") {
      $sql .= $column;
    } else {
      $sql .= " * ";
    }

    if ($table != "" && $table != is_array($table)) {
      $sql .= " FROM " .$table;
    }

    if(is_array($table)){
      $tmp_table = [];
      $tmp_col = [];
      foreach ($table as $key => $value) {
        array_push($tmp_table, $key);
        array_push($tmp_col, $value);
      }

      $sql .= " FROM " . $tmp_table[0];
      $sql .= " JOIN " . $tmp_table[1]. " ON " . $tmp_table[0].".".$tmp_col[0]."=";
      $sql .= $tmp_table[1].".".$tmp_col[1];
    }

    if ($criterion != "") {
      $sql .= " WHERE ".$criterion;
    }

    if($order_by != ""){
      $sql .= " ORDER BY ".$order_by . " DESC ";
    }

    if($limit != ""){
      $sql .= $limit;
    }

    // print($sql);



    $stmt = static::$pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }


  public function find_one_by_filter($table="", $column="", $criterion="", $order_by="") {
    $tableId = static::$tableId;
    $sql = "SELECT ";

    if ($column != "") {
      $sql .= $column;
    } else {
      $sql .= " * ";
    }

    if ($table != "" && $table != is_array($table)) {
      $sql .= " FROM " .$table;
    }

    if(is_array($table)){
      $tmp_table = [];
      $tmp_col = [];
      foreach ($table as $key => $value) {
        array_push($tmp_table, $key);
        array_push($tmp_col, $value);
      }

      $sql .= " FROM " . $tmp_table[0];
      $sql .= " JOIN " . $tmp_table[1]. " ON " . $tmp_table[0].".".$tmp_col[0]."=";
      $sql .= $tmp_table[1].".".$tmp_col[1];
    }

    if ($criterion != "") {
      $sql .= " WHERE ".$criterion;
    }

    if($order_by != ""){
      $sql .= " ORDER BY ".$order_by . " DESC";
    }

    // print($sql);



    $stmt = static::$pdo->prepare($sql);
    if(!$stmt->execute()){
      print_r($stmt->errorInfo());
    }$stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);

  }


  public function delete($id){
   $table = static::$table;
   $tableId = static::$tableId;

    $sql = "DELETE FROM $table WHERE $tableId = :id";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    if(!$stmt->execute()){
      print_r($stmt->errorInfo());
    }
  }



} // END Class Database


$db = new Database();
$db->connect_to_database("blurred");
// if ($db) {
//     echo "koblet til databasen!";
// }


 ?>
