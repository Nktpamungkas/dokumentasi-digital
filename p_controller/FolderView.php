<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'p_controller/database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    //oldPassTxt newPassTxt reNewPassTxt

    if (isset($_POST['submit'])) {

        if (empty($_POST['oldPassTxt']) || empty($_POST['newPassTxt']) || empty($_POST['reNewPassTxt'])) {

            $pesanError = 'Please fill the field';
        } else {
            include_once 'p_controller/database/connection.php';
            $oldPassTxt = $_POST['oldPassTxt'];
            $newPassTxt = $_POST['newPassTxt'];
            $reNewPassTxt = $_POST['reNewPassTxt'];
            //
            if ($newPassTxt != $reNewPassTxt) {
                $pesanError = 'Password and Retyping Password not Match';
            } else {
                $cekData = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff' AND password = '$oldPassTxt'");
                $cekAda = mysql_num_rows($cekData);
                if ($cekAda > 0) {
                    // Ada
                    $changePassword = mysql_query("UPDATE tb_staff SET password = '$newPassTxt' WHERE id_staff = '$idStaff'");
                    if ($changePassword) {
                        $pesanError = 'Password Has Changed';
                    } else {
                        $pesanError = 'Failed Change Password';
                    }
                } else {
                    // Tidak
                    $pesanError = 'Wrong Old Password';
                }
            }
        }
    }
} else {
    header("Location: ?");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Folder</title>

    <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="p_layout/css/navbar-fixed-top.css" rel="stylesheet">
    <script type="text/javascript">
        function onload() {
            $("#datas").load("?p=data&id=1");
        }
    </script>

    <style type="text/css">
        .hfolder {
            float: left;
            width: ;
        }
    </style>
</head>

<body onload="onload();">

    <!-- Menu Navigation -->
    <?php
        require_once "p_controller/MenuNav.php";
    ?> 

    <div class="container">
        <div class="row">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><img src="p_layout/images/folder.png" height="20" width="20"> Your Folder</h3>
                    <?php
                    if (isset($pesanError)) {
                        echo '<b style=color:red>' . $pesanError . '</b>';
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <div class="input-group">
                        <a href="?p=createfolder" class="btn btn-warning"><i class="glyphicon glyphicon-folder-open"></i> Create Folder</a>
                    </div>
                </div>

                <div class="panel-body">
                    <?php
                        $foder = mysql_query("SELECT * FROM tb_folder WHERE folder_status = 1");
                        while ($fetchDataFolder = mysql_fetch_array($foder)) {
                    ?>
                    <a href="?p=myfile&folder=<?php echo $fetchDataFolder['id_folder']; ?>">
                        <div class="col-md-2">
                            <center><h1><img src="p_layout/images/folder2.png" height="50" width="50"></h1> 
                            <?php echo ucfirst($fetchDataFolder['nama_folder']); ?></center>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <script src="p_layout/js/jquery.min.js"></script>
    <script src="p_layout/js/bootstrap.min.js"></script>
    <script src="p_layout/js/pebri.js"></script>
    <script src="p_layout/js/notif.js"></script>
</body>
</html>
