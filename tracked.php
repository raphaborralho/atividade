<?php
include("connect.php");
$file = $_GET['name'];
$file_path = "repository/".$file;
$content = file_get_contents($file_path);
$extension = substr($file, -3);
$hash = hash_file('md5', $file_path);
$file = substr($file, 0, -4);

$create_at = date('d-m-Y H:i:s');
$sql = "INSERT INTO files (FILE,EXTENSION,HASH,CONTENT,CREATED_AT)
VALUES ('$file', '$extension', '$hash', '$content', '$create_at')";

/** inseri no banco e redireciona para a lista de arquivos */

$ret = $db->exec($sql);
if(!$ret) {
  echo $db->lastErrorMsg();
//  header("Location: db.php");
} else {
  header("Location: list.php");
}
$db->close();
/** ---------------------- */
