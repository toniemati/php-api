<?php

class Database {
  private static $pdo;

   private static $host = 'localhost';
   private static $dbname = 'junior';
   private static $username = 'root';
   private static $password = '';

  public static function connect() {

    try {
      self::$pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
      self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return self::$pdo;

    } catch (PDOException $e) {
      exit('Database error: ' . $e->getMessage());

    }
  }
}