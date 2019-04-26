<?php
if (isset($_SESSION['userId'])) {
    // Seesi Ada
    header("Location: ?p=uploadfile");
} else {
    // Sessi Tidak Ada
    if (isset($_POST['submit'])) {

        if (empty($_POST['nikTxt']) || empty($_POST['passTxt'])) {

            $pesanError = 'Please fill the field';
        } else {
            include_once 'p_controller/database/connection.php';
            $nik = $_POST['nikTxt'];
            $pas = $_POST['passTxt'];
            $cekData = mysql_query("SELECT * FROM tb_staff WHERE nik = '$nik' AND password = '$pas'");
            $cekAda = mysql_num_rows($cekData);
            if ($cekAda > 0) {
                //
                $dataUser = mysql_fetch_array($cekData);
                // Set Sessi
                $_SESSION['userId'] = $dataUser['id_staff'];
                header("Refresh: 0");
            } else {
                $pesanError = 'Nik and Password not Match';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Arsip Management | Log in </title>

        <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
        <link href="p_layout/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="p_layout/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="p_layout/vendors/nprogress/nprogress.css" rel="stylesheet">
        <link href="p_layout/vendors/animate.css/animate.min.css" rel="stylesheet">
        <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
        <link href="p_layout/css/style.css" rel="stylesheet">
        <link href="p_layout/build/css/custom.min.css" rel="stylesheet">
        <script src="p_layout/js/bootstrap.min.js"></script>
        <script src="p_layout/js/jquery.min.js"></script>
    </head>

<body class="login">

<style>
    .block {
        display: block;
        width: 100%;
        border: none;
        background-color: #4CAF50;
        color: white;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }

    .block:hover {
        background-color: #ddd;
        color: black;
    }
</style>

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

    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">

                <h3 class="panel-title">
                    <form action="" method="post" style="visibility: ">
                        <fieldset>
                                <!--    TEXTBOX NIK DAN PASSWORD -->
                                    <div>
                                        <legend>Please Sign In</legend>
                                        <?php
                                            if (isset($pesanError)) {
                                            echo '<b style=color:red>' . $pesanError . '</b>';
                                            }
                                        ?>
                                            <input class="form-control glyphicon-user" name="nikTxt" type="text" autofocus="" placeholder="NIK" value="">

                                    </div>

                                    <div>
                                        <input class="form-control" name="passTxt" type="password" placeholder="Password">
                                        <button class="block" type="submit" name="submit">Login</button>
                                    </div>
                                  
                                    <div class="text-center forget">
                                        <a href="#">Lost your password?</a>
                                    </div>
                        </fieldset>
                    </form>
                </section>
            </div>
        </div>
      </div>
    </div>
  </body>
