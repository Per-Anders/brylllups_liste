<?php

require("Database.php");
require("Tables.php");
require("Forms.php");


class Users extends Table {

  public static $table = "bryllup_users";
  public static $tableId = "user_id";


  public function search($pattern){
    $table = static::$table;
    $sql = "SELECT * FROM $table join topic ON note.topic_id=topic.topic_id WHERE title LIKE :pattern OR body LIKE :pattern OR topic_title LIKE :pattern ORDER BY saved DESC";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":pattern", "%$pattern%", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  public function get_buy_history($user_id){
    $table = static::$table;
    $sql = "SELECT bryllup_buyers.buy_id, bryllup_onsker.onske_id, bryllup_onsker.name, bryllup_onsker.link, bryllup_onsker.status, bryllup_onsker.quantity, bryllup_buyers.quantity, bryllup_buyers.buy_date  FROM  bryllup_users inner join bryllup_buyers ON bryllup_users.user_id=bryllup_buyers.user_id inner join bryllup_onsker on bryllup_buyers.gift_id = bryllup_onsker.onske_id WHERE bryllup_users.user_id = :user_id";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":user_id", $user_id);
    if(!$stmt->execute()){
      print_r($stmt->errorInfo());
    }
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }




  
  public function validate_email($email) {
    $table = static::$table;
    $sql = "SELECT * FROM $table WHERE email = :email";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }


  public function send_reset_mail($email) {
    $token = bin2hex(random_bytes(50));
    return $token;
  }

  public function check_email($email) {
    $table = static::$table;
    $sql = "SELECT * FROM $table WHERE email = :email";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    // return $stmt->fetch(PDO::FETCH_OBJ);
    return $stmt->rowCount();
  }


  public function login($email, $password) {
    $table = static::$table;
    $sql = "SELECT * FROM $table WHERE email = :email AND password = :password AND active = 1";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":password", $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }



    public function validate_token($email, $token) {
        $table = static::$table;
        $sql = "SELECT * FROM $table WHERE email = :email AND hash = :token LIMIT 1";
        $stmt = static::$pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":token", $token);
         if(!$stmt->execute()){
          print_r($stmt->errorInfo());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }




} // slutten av users class


class Onsker extends Table {
  public static $table = "bryllup_onsker";
  public static $tableId = "onske_id";
}


class Buyers extends Table {
  public static $table = "bryllup_buyers";
  public static $tableId = "buy_id";

}


