<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'p_controller/database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    //oldPassTxt newPassTxt reNewPassTxt

    if (isset($_POST['submit'])) {

        if (empty($_POST['foldername'])) {

            $pesanError = 'Please fill the field';
        } else {
            include_once 'p_controller/database/connection.php';
            $foldername = $_POST['foldername'];
            //
            $saveFolder = mysql_query("INSERT INTO tb_folder VALUES('','$idStaff','$foldername',now(),'1')");
            if($saveFolder) {
                header("Location: ?p=folder");
            } else {
                echo "QUERY ERROR";
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
    <title>Create Folder</title>

    <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="p_layout/css/navbar-fixed-top.css" rel="stylesheet">
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

    <script>
        function waktu(id)
        {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
            d = date.getDate();
            day = date.getDay();
            days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            h = date.getHours();
            if (h < 10)
            {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10)
            {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10)
            {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + months[month] + ' ' + d + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('waktu("' + id + '");', '1000');
            return true;
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2>Create Folder</h2>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Fill</h3>
                        <?php
                        if (isset($pesanError)) {
                            echo '<b style=color:red>' . $pesanError . '</b>';
                        }
                        ?>
                    </div>

                    <div class="panel-body">
                        <form role="form" action="" method="POST">

                            <fieldset>

                                <div class="form-group">
                                    <input class="form-control" name="foldername" type="text" placeholder="Folder Name">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-success" name="submit" type="submit" value="Create Folder">
                                </div>

                                <span id="waktu"></span>
                                <script type="text/javascript">window.onload = waktu('waktu');</script>

                            </fieldset>

                        </form>
                    </div>
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
