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
    <title>Welcome Home</title>

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

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                   <h1><img src="p_layout/images/shared.png" height="50" width="50"> Shared File</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
            <input id="search" type="search" class="form-control" name="titleTxt" value="" placeholder="Search File">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="POST">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>From</th>
                                <th>Kind File</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $shareData = mysql_query("SELECT * FROM tb_share WHERE staff_share = '$idStaff'");
                            while ($fetchShareData = mysql_fetch_array($shareData)) {
                                if ($fetchShareData['dok_owner'] != $idStaff) {
                                        //
                                    $dokData = mysql_query("SELECT * FROM dokumen WHERE id_dok = '$fetchShareData[id_dok]'");
                                    $fetchDokData = mysql_fetch_assoc($dokData);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $text = $fetchDokData['nama_ori'];
                                            $a = explode(' ', $text);

                                            $aCount = count($a);

                                            for ($i = 0; $i < $aCount; $i++) {
                                                echo ucfirst($a[$i]) . ' ';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $staffData = mysql_query("SELECT * FROM staff WHERE id_staff = '$fetchShareData[dok_owner]'");
                                            $fetchStaffData = mysql_fetch_assoc($staffData);
                                            echo $fetchStaffData['nama'];
                                            ?>
                                        </td>
                                        <td><?php echo $fetchDokData['jenis_dok']; ?></td>
                                        <td><?php echo date('D d M Y', strtotime($fetchDokData['dok_create'])); ?></td>
                                        <td>
                                            <a href="?p=file&verify=<?php echo $fetchDokData['id_dok']; ?>" style="width:45%" class="btn btn-info">
                                            <img src="p_layout/images/information.png" height="20" width="20"></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <hr>
    </div>

    <script src="p_layout/js/jquery.min.js"></script>
    <script src="p_layout/js/bootstrap.min.js"></script>
    <script src="p_layout/js/pebri.js"></script>
    <script src="p_layout/js/notif.js"></script>
</body>
</html>
