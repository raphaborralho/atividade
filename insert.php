<?php
include("connect.php");
$type = $_POST['type'];

/** reune as informações para criação do arquivo */
$content = $_POST['content'];
$file = $_POST['file'];
$extension = $_POST['extension'];

$file_path = 'repository/'.$file.'.'.$extension;
/** ---------------------- */

/** cria arquivo antes de inserir no banco de dados */
$file_content = fopen($file_path, "w"); //Abre somente para escrita; coloca o ponteiro do arquivo no começo do arquivo e reduz o comprimento do arquivo para zero. Se o arquivo não existir, tenta criá-lo.
 $write = fwrite($file_content, $content);
 fclose($file_content);
/** ---------------------- */
/** calcula o hash após a criação do arquivo */
$hash = hash_file('md5', $file_path);
/** ---------------------- */

/** monta sql */
if($type == "insert"){

    $create_at = date('d-m-Y H:i:s');
    $sql = "INSERT INTO files (FILE,EXTENSION,HASH,CONTENT,CREATED_AT)
     VALUES ('$file', '$extension', '$hash', '$content', '$create_at')";

}
if($type == "update"){
    $create_at = $_POST['created_at'];
    print_r($create_at);
    $updated_at = date('d-m-Y H:i:s');   
    $sql = "INSERT INTO files (FILE,EXTENSION,HASH,CONTENT,CREATED_AT,UPDATED_AT)
     VALUES ('$file', '$extension', '$hash', '$content', '$create_at' ,'$updated_at')";
}
/** ------------------  */
/** inseri no banco e redireciona para a lista de arquivos */

  $ret = $db->exec($sql);
  if(!$ret) {
    echo $db->lastErrorMsg();
    header("Location: db.php");
  } else {
    header("Location: list.php");
  }
 $db->close();
 /** ---------------------- */
