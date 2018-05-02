<?php
include("connect.php");
$id = $_GET["id"];
$sql = "SELECT * FROM files WHERE ID = ".$id;

$ret = $db->query($sql);

function longenough($word){
    return strlen( $word ) > 1;
}

while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {

    $diff = $row['CONTENT'];

    $r = $db->query("SELECT * FROM files WHERE FILE = '".$row['FILE']."' order by ID desc");
           
?>

<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="assets/css/style.css" />    
<script src="assets/js/ckeditor/ckeditor.js"></script>

<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.42/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.42/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.42/js/uikit-icons.min.js"></script>

<title>Document</title>
</head>
<body>
<div class="uk-container">
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="index.php">Home</a></li>
            <li><a href="list.php">List</a></li>
        </ul>
    </div>
</nav>
</div>
<?php
 while($t = $r->fetchArray(SQLITE3_ASSOC) ) {

            $str1=$diff;
            $str2=$t['CONTENT'];

            if (!$t['UPDATED_AT']) {
                $direction = "right";
                $date = $t['CREATED_AT'];
            } else {
                $direction = "left";
                $date = $t['UPDATED_AT'];
            }
            $diff = $t['CONTENT'];
 ?>

 <div class="timeline">
    <div class="container <?php echo $direction; ?>">
        <div class="content uk-card-hover">
            <h2><?php echo $date; ?></h2>
            <p>
            <?php echo $str2; ?>
            </p>
        </div>
    </div>
</div>
    <?php
    }

}

$db->close();
?>

</body>
</html>
