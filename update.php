<?php
include("connect.php");
$id = $_GET['id'];
$sql = "select * from files where ID =".$id;
$ret = $db->query($sql);
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
<div class="uk-container uk-margin">
    <div class="uk-width-1-1">
        <?php while($row = $ret->fetchArray(SQLITE3_ASSOC) ) { ?>
        <form action="insert.php" method="post" class="uk-grid-collapse" uk-grid>
            <div class="uk-margin uk-width-4-5">
                <label class="uk-form-label" for="form-stacked-text">File name:</label>
                <div class="uk-form-controls">
                <input type="hidden" name="type" class="uk-invisible" value="update" hidden>
                <input type="hidden" name="file" class="uk-invisible" value="<?php echo $row['FILE'];?>"  hidden>
                <input type="hidden" name="extension" class="uk-invisible" value="<?php echo $row['EXTENSION'];?>" hidden>
                <input type="hidden" name="created_at" class="uk-invisible" value="<?php echo $row['CREATED_AT'];?>" hidden>
                <input class="uk-input" value="<?php echo $row['FILE']; ?>" name="file" id="form-stacked-text" type="text" placeholder="<?php echo $row['FILE']; ?>" disabled>
            </div>
        </div>
        <div class="uk-width-expand">
            <label class="uk-form-label" for="form-stacked-text">Extension:</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-input" name="extension" id="extension" value="<?php echo $row['EXTENSION'];?>" disabled>
            </div>
        </div>    
        <div class="uk-margin uk-width-1-1">
            <label class="uk-form-label" for="editor1">File content:</label>
            <div class="uk-form-controls">
                <textarea name="content" id="editor1" rows="10" cols="80"><?php echo $row['CONTENT']; ?></textarea>
                <input class="uk-button uk-button-primary  uk-width-1-1 uk-button-large" type="submit" value="Enviar">
            </div>
        </div>
            <script>
                CKEDITOR.replace( 'editor1' );
            </script>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>