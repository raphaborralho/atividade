<?php

   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('test.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
      header("Location: index.php");
   } else {
      echo "<pre>Opened database successfully</pre>\n";
   }

   $sql =<<<EOF
      CREATE TABLE files
      (ID INTEGER PRIMARY KEY AUTOINCREMENT,
      FILE              TEXT    NOT NULL,
      HASH              CHAR(50),
      EXTENSION         CHAR(50),
      CONTENT           TEXT,
      CREATED_AT        DATETIME,
      UPDATED_AT        DATETIME,
      DELETED_AT        DATETIME);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo "<pre>".$db->lastErrorMsg()."</pre>";
      header("Location: index.php");
   } else {
      echo "<pre>Table created successfully</pre>\n";
      header("Location: index.php");
   }
   $db->close();
?>