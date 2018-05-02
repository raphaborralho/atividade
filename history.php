<?php
include("connect.php");
$sql =<<<EOF
      SELECT * from files;
EOF;
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
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="index.php">Home</a></li>
            <li><a href="list.php">List</a></li>
        </ul>

    </div>
</nav>
    <div class="uk-container">
        <div class="uk-margin">
            <div class="uk-card uk-card-body uk-card-default">
                <table class="uk-table uk-table-hover uk-table-striped">
                    <thead>
                        <tr>
                            <th class="uk-text-truncate">File</th>
                            <th class="uk-text-truncate">Content</th>
                            <th class="uk-text-truncate">Hash</th>
                            <th class="uk-text-truncate">Created at</th>
                            <th class="uk-text-truncate">Updated at</th>
                            <th class="uk-text-truncate">Deleted at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = $db->query($sql);
                        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                        ?>
                        <tr>
                            <td><?php echo $row['FILE']; ?></td>
                            <td><?php echo $row['CONTENT']; ?></td>
                            <td><?php echo $row['HASH']; ?></td>
                            <td><?php echo $row['CREATED_AT']; ?></td>
                            <td><?php echo $row['UPDATED_AT']; ?></td>
                            <td><?php echo $row['DELETED_AT']; ?></td>
                            <td>
                                <ul class="uk-iconnav">
                                    <li><a href="update.php?id=<?php echo $row['ID'];?>" uk-icon="icon: file-edit"></a></li>
                                    <li><a href="#" uk-icon="icon: git-branch"></a></li>
                                    <li><a href="#" uk-icon="icon: trash"></a></li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                        }
                        
                        $db->close();
                        ?>
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
</html>

