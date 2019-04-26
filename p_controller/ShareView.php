<?php
if (isset($_SESSION['userId'])) {
  // Sessi Ada

  if (isset($_GET['verify'])) {
    include_once 'p_controller/database/connection.php';
    $dokOwner = mysql_query("SELECT * FROM tb_dokumen WHERE id_dok = '$_GET[verify]' AND id_staff = '$_SESSION[userId]'");
    $cekDokOwner = mysql_num_rows($dokOwner);
    if ($cekDokOwner > 0) {
      $idStaff = $_SESSION['userId'];

      $dataUserBySesion = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff'");
      $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

      //
      $id_dok = $_GET['verify'];
      //
      if (isset($_POST['submit'])) {
        if(isset($_POST['u'])) {
          $jml_u = count($_POST['u']);

          for ($i=0; $i < $jml_u ; $i++) {
            $ids = $_POST['u'][$i];
            $saveShare = mysql_query("INSERT INTO tb_share (id_dok, dok_owner, staff_share, share_create, share_status)
              VALUES('$id_dok','$idStaff','$ids', now(),'2')");
            if ($saveShare) {

              // Notifikasi
              $notifikasi = mysql_query("INSERT INTO tb_notifikasi (type, id_staff, kode, item, notif_create, notif_status)
                VALUES('1','$idStaff','$ids', '$id_dok', now(),'1')");
              //
              if($notifikasi) {
                $shareStatus = mysql_query("UPDATE tb_dokumen SET dok_status = 2 WHERE id_dok = '$_GET[verify]'");
                if($shareStatus) {

                } else {
                  echo "query shareStatus errot";
                }
              } else {
                echo "query notifikasi error";
              }
            } else {
              echo "query saveShare error";
            }
          }
        } else {
          $error = "Chose People";
        }
      }
      //
    } else {
      header("Location: ?p=home");
    }
  } else {
    header("Location: ?p=home");
  }
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
          <h1>Share File With :</h1>
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
              <th><input type="checkbox" id="checkall" /> Name</th>
              <th>Department</th>
              <th>Potition</th>
            </tr>
          </thead>
          <tbody>
            <form action="" method="POST">
              <?php
              $dataStaff = mysql_query("SELECT * FROM tb_staff ORDER BY nama ASC");
              $i = 0;
              while ($user = mysql_fetch_array($dataStaff)) {
                if ($user['id_staff'] != $idStaff) {
                  $dataShare = mysql_query("SELECT * FROM tb_share WHERE id_dok = '$_GET[verify]' AND staff_share = '$user[id_staff]'");
                  $fetchShare = mysql_fetch_assoc($dataShare);
                  ?>
                  <tr>
                    <td>
                      <?php if($fetchShare['staff_share'] == $user['id_staff']) { ?>
                      <input disabled checked type='checkbox' value='<?php echo $user['id_staff']; ?>'> <?php echo $user['nama']; ?></td>
                      <?php } else { ?>
                      <input type='checkbox' name='u[]' value='<?php echo $user['id_staff']; ?>'> <?php echo $user['nama']; ?></td>
                      <?php } ?>
                      <td>
                        <?php
                        $dataDep = mysql_query("SELECT nama_dep FROM tb_departemen WHERE id_dep = $user[departemen]");
                        $fetchDep = mysql_fetch_assoc($dataDep);
                        echo $fetchDep['nama_dep'];
                        ?>
                      </td>
                      <td><?php echo $user['jabatan']; ?></td>
                    </tr>
                    <?php
                  }
                }
                ?>
              </tbody>
            </table>
            <hr>
            <button name="submit" type="submit" class="btn btn-primary">
              <i class="glyphicon glyphicon-send"></i> Send
            </button>
          </form>
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
