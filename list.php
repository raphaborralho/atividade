<?php
include("connect.php");
$sql =<<<EOF
      SELECT * from files;
EOF;

$filepath = 'repository';

$files = scandir(($filepath),2);

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
            <div class="uk-card uk-card-body uk-card-default">
                <table class="uk-table uk-table-hover uk-table-striped">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Content</th>
                            <th>Hash</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Deleted at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tracked = array();
                        $untracked = array();
                        foreach($files as $key => $value) {
                            if ( !in_array( $value, array( '.', '..' ) ) ) {
                                $untracked[] = $value;
                            $sql = "select * from files where HASH ='".hash_file('md5', $filepath.'/'.$value)."'";
                            $ret = $db->query($sql);
                            while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                            $tracked[] = $row['FILE'].".".$row['EXTENSION'];
                            ?>
                        <tr>
                            <td><?php echo $row['FILE'].".".$row['EXTENSION']; ?></td>
                            <td><?php echo substr($row['CONTENT'], 0, 5)."[...]"; ?></td>
                            <td><?php echo substr($row['HASH'], 0, 5)."[...]"; ?></td>
                            <td><?php echo $row['CREATED_AT']; ?></td>
                            <td><?php echo $row['UPDATED_AT']; ?></td>
                            <td><?php echo $row['DELETED_AT']; ?></td>
                            <td>
                                <ul class="uk-iconnav">
                                    <li><a title="Edit" href="update.php?id=<?php echo $row['ID'];?>" uk-icon="icon: file-edit"></a></li>
                                    <li><a title="Diff" href="diff.php?id=<?php echo $row['ID'];?>" uk-icon="icon: git-branch"></a></li>
                                    <li><a title="Delete" href="#" uk-icon="icon: trash"></a></li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                            }}}
                        $db->close();
                        ?>
                    <?php
                    $untracked_files = array_diff($untracked, $tracked);
                    if(count($untracked_files)){
                    foreach($untracked_files as $k => $v){
                    ?>
                    <tr class="uk-alert-danger">
                        <td><?php echo $v; ?></td>
                        <td>Untracked file</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <ul class="uk-iconnav">
                                <li><a title="Edit" href="tracked.php?name=<?php echo $v;?>" uk-icon="icon: file-edit"></a></li>
                                <li><a title="Delete" href="#" uk-icon="icon: trash"></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                    <caption>
                        <?php 
                            echo "Untracked files: ".count(array_diff($untracked, $tracked));
                        ?>
                    </caption>
                </table>
        </div>
    </div>
</body>
</html>

