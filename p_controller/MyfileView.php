<?php
if (isset($_SESSION['userId'])) {
  // Sessi Ada
  $idStaff = $_SESSION['userId'];
  include_once 'p_controller/database/connection.php';
  $dataUserBySesion = mysql_query("SELECT * FROM tb_staff WHERE id_staff = '$idStaff'");
  $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
  //
  if(isset($_GET['verify'])) {
    $dokData = mysql_query("SELECT * FROM tb_dokumen WHERE id_dok = '$_GET[verify]' AND id_folder = $_GET[folder]'");
    $fetchDokData = mysql_fetch_assoc($dokData);
}

if (isset($_GET['download'])) {
    if ($_GET['download'] == TRUE) {

      $file = 'p_file_center/' . $fetchDokData['nama_dok'];
      if (file_exists($file)) {

        $lastCountDownload = $fetchDokData['jml_download'] + 1;
        $plusDownload = mysql_query("UPDATE tb_dokumen SET jml_download = '$lastCountDownload' WHERE id_dok = '$_GET[verify]'");
        //
        if ($plusDownload) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="' . basename($file) . '"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
      } else {
          echo 'a';
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
  <title>My File</title>

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
          <?php
            $folders = mysql_query("SELECT * FROM tb_folder WHERE id_folder = '$_GET[folder]'");
            $fetchFolder = mysql_fetch_assoc($folders);
          ?>
          <h1>My File In Folder <?php echo ucfirst($fetchFolder['nama_folder']); ?></h1>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <input type="search" id="search" value="" class="form-control" placeholder="Search File">
</div>
</div>
<div class="row">
  <div class="col-lg-12">
    <form action="" method="POST">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>File Name</th>
            <th>Kind File</th>
            <th>Created</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $dataDok = mysql_query("SELECT * FROM tb_dokumen WHERE id_staff = '$idStaff' AND id_folder = '$_GET[folder]'");
      while ($fetchDataDok = mysql_fetch_array($dataDok)) {
        ?>
        <tr>
          <td>
            <?php
            $text = $fetchDataDok['nama_ori'];
            $a = explode(' ', $text);

            $aCount = count($a);

            for ($i = 0; $i < $aCount; $i++) {
              echo ucfirst($a[$i]) . ' ';
          }
          ?>
      </td>
      <td><?php echo $fetchDataDok['jenis_dok']; ?></td>
      <td><?php echo date('D d M Y', strtotime($fetchDataDok['dok_create'])); ?></td>
      <td>
        <a class="btn btn-success" href="?p=myfile&verify=<?php echo $fetchDataDok['id_dok']; ?>&download=true">
          <i class="glyphicon glyphicon-download"></i> Download</a>

        <!-- <a class="btn btn-danger" style="width:32%" href="?p=Delete&verify=<?php echo $fetchDataDok['id_dok']; ?>">
          <i class="glyphicon glyphicon-trash"></i> Delete</a> -->

          <?php
          $shareData = mysql_query("SELECT * FROM tb_share WHERE id_dok = '$fetchDataDok[id_dok]'");
          $fetchShareData = mysql_fetch_assoc($shareData);
          if (empty($fetchShareData['id_dok']) || $fetchDataDok['dok_status'] == 1) {
              echo '<a href="?p=share&verify=' . $fetchDataDok['id_dok'] . '" style="width:32%" class="btn btn-warning">'
              . '<i class="glyphicon glyphicon-lock"></i> Private</a>';
          } elseif ($fetchDataDok['dok_status'] == 2) {
              echo '<a href="?p=share&verify=' . $fetchDataDok['id_dok'] . '" style="width:32%" class="btn btn-info">'
              . '<i class="glyphicon glyphicon-share"></i> Share</a>';
          }
          ?>
      </td>
  </tr>
  <?php } ?>
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
</script>
</body>
</html>
