<?php
include("connect.php");
$file = $_GET["name"];


$sql = "DELETE FROM files WHERE FILE = '".$file."'";

/** deleta do banco e redireciona para a lista de arquivos */
$ret = $db->exec($sql);
if(!$ret) {
  echo $db->lastErrorMsg();
} else {
/** deleta fisicamente */
  unlink("repository/".$file);
/** ---------------------- */
  header("Location: list.php");
}
$db->close();
/** ---------------------- */