<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'p_controller/database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
} else {
    header("Location: ?");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Your File</title>

    <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="p_layout/css/navbar-fixed-top.css" rel="stylesheet">
</script>
<script type="text/javascript">
    function onload() {
        $("#datas").load("?p=data&id=1");
    }
</script>
</head>

<body onload="onload();">

<!-- Menu Navigation -->
    <?php
        require_once "p_controller/MenuNav.php";
    ?> 

<!-- Form Menu Upload -->
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><strong><img src="p_layout/images/upload.png" height="20" width="20"> Upload Files</strong></div>

            <form action="?p=uploading" name="form" id="forms" class="form-horizontal" enctype="multipart/form-data" method="POST">

                <div class="panel-body">
                    <div class="input-group">
                        <span class="input-group-addon"><img src="p_layout/images/title.png" height="20" width="20"> Title</span>
                        <input id="user" type="text" class="form-control" name="titleTxt" value="" placeholder="Title of file">
                    </div>
                </div>

                <div class="panel-body">
                    <div class="input-group">
                        <span class="input-group-addon"><img src="p_layout/images/uploadbutton.png" height="20" width="20"> File</span>
                        <input id="fileTxt" type="file" class="form-control" name="fileTxt">
                    </div>
                </div>

                <div class="panel-body">
                    <div class="input-group">
                        <span class="input-group-addon"><img src="p_layout/images/folderbutton.png" height="20" width="20"> Folder</span>
                        <select id="fileTxt" class="form-control" name="folder">
                            <?php
                                $folder = mysql_query("SELECT * FROM folder");
                                while ($fetchFolder = mysql_fetch_array($folder)) {
                                    echo "<option value='$fetchFolder[id_folder]'>".ucfirst($fetchFolder['nama_folder'])."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="ol-sm-12 controls">
                        <a href="?p=createletter" class="btn btn-default">
                            <i class="glyphicon glyphicon-pencil"></i> 
                            Create Document
                        </a>
                        <a href="?p=createfolder" class="btn btn-success">
                            <i class="glyphicon glyphicon-folder-open"></i> 
                            Create Folder
                        </a> 
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input name="setuju"  type="checkbox" onClick="Javascript:dis(this, 1);"> (check for upload file)
                            <button id="off" onclick="uploadFile();" name="submit" disabled="disabled" type="submit" href="#" class="btn btn-primary">
                                <i class="glyphicon glyphicon-upload"></i> Upload</button>
                        </div>
                    </div>
                </div>

            </form>

                <?php
                if (isset($pesanError)) {
                    echo '<center><b style="color:red">' . $pesanError . '</b></center>';
                } else {
                    echo '<center><b style="color:green">Please fill the field</b></center>';
                }
                ?>

        </div>
    </div>

        <script src="p_layout/js/jquery.min.js"></script>
        <script src="p_layout/js/bootstrap.min.js"></script>
        <script src="p_layout/js/pebri.js"></script>
        <script src="p_layout/js/notif.js"></script>
</body>
</html>
