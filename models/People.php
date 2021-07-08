<?php

class People {

  private static $conn;

  public static $id;
  public static $name;
  public static $lastname;
  public static $position;
  public static $created_at;
  public static $updated_at;

  public static function connect($db) {
    self::$conn = $db;
  }

  public static function index() {

    $sql = 'SELECT 
        * 
      FROM 
        peoples
      ORDER BY
        created_at
      DESC
    ';

    $stmt = self::$conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();

  }

  public static function show() {
    
    $sql = 'SELECT
        *
      FROM
        peoples
      WHERE
        id = ' . self::$id . '
      LIMIT 0,1
    ';

    $stmt = self::$conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch();
  }

  public static function store() {

    $sql = 'INSERT INTO
        peoples
      (name, lastname, position)
        VALUES
      (:name, :lastname, :position)
    ';

    $stmt = self::$conn->prepare($sql);

    $stmt->bindParam(':name', self::$name);
    $stmt->bindParam(':lastname', self::$lastname);
    $stmt->bindParam(':position', self::$position);

    return ($stmt->execute()) ? true : false;

  }

  public static function update() {
    
    $sql = 'UPDATE
        peoples
      SET
        name = :name,
        lastname = :lastname,
        position = :position,
        updated_at = :updated_at
      WHERE
        id = ' . self::$id;

    $stmt = self::$conn->prepare($sql);

    $stmt->bindParam(':name', self::$name);
    $stmt->bindParam(':lastname', self::$lastname);
    $stmt->bindParam(':position', self::$position);
    $stmt->bindParam(':updated_at', self::$updated_at);

    return ($stmt->execute()) ? true : false;
  }
}