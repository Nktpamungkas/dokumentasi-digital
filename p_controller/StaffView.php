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
    <title>Share My File</title>

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
          <h1>List Staff Data</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4">
        <input type="search" id="search" value="" class="form-control" placeholder="Search Staff or Teacher">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table" id="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Depatment</th>
              <th>Potition</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(isset($_GET['verify'])) {
              $id_dok = $_GET['verify'];
            }
            $dataStaff = mysql_query("SELECT * FROM tb_staff ORDER BY nama ASC");
            $i = 0;
            while ($user = mysql_fetch_array($dataStaff)) {
              ?>
              <tr>
                <td><?php echo $user['nama'] ?></td>
                <td>
                  <?php
                  $dataDepartemen = mysql_query("SELECT * FROM tb_departemen WHERE id_dep = '$user[departemen]'");
                  $fetchDept = mysql_fetch_assoc($dataDepartemen);
                  echo $fetchDept['nama_dep'];
                  ?>
                </td>
                <td><?php echo $user['jabatan'] ?></td>
                <td><a href="?p=detailstaff&staff=<?php echo $user['id_staff'] ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"> Edit</a></td>
              </tr>
              <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
        <hr>
        <a href="?p=addstaff" class="btn btn-primary">
          <i class="glyphicon glyphicon-send"></i> Add New Staff
        </a>
      </div>
    </div>
    <hr>


    <?php
    if (isset($warning)) {
      echo '<strong>' . $warning . '</strong>, ';
    }
    ?>

  </div>

  <script src="p_layout/js/jquery.min.js"></script>
  <script src="p_layout/js/bootstrap.min.js"></script>
  <script src="p_layout/js/pebri.js"></script>
  <script src="p_layout/js/notif.js"></script>
</body>
</html>
