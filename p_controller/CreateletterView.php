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
    <title></title>

    <link href="p_layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="p_layout/css/navbar-fixed-top.css" rel="stylesheet">
    <script type="text/javascript">
        function onload() {
            $("#datas").load("?p=data&id=1");
        }
    </script>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
        th {
            text-align: left;
        }
    </style>
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

    <!-- Form Menu -->
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><strong><img src="p_layout/images/upload.png" height="20" width="20"> Create Letter</strong></div>

            <form action="?p=#" name="form" id="forms" class="form-horizontal" enctype="multipart/form-data" method="POST">
            	<br>
            		<ul class="nav nav-tabs ">
            	    	<li class="active"><a data-toggle="tab" href="#SKPI">SKPI</a></li>
            	    	<li><a data-toggle="tab" href="#SKK">SKK</a></li>
                        <li><a data-toggle="tab" href="#PENGAJUAN">Surat Pengajuan Barang</a></li>
                        <li><a data-toggle="tab" href="#PROMOSI">Surat Promosi & Rotasi Jabatan</a></li>
            	  	</ul>

	  	<div class="tab-content">
            <!-- SURAT KETERANGAN PENGALAMAN KERJA -->
			<div id="SKPI" class="tab-pane fade">
		      <p>
		      	<table class="table table-bordered">
		      		<tbody>
		      			<tr class="success">
		      				<th colspan="2">SURAT KETERANGAN PENGALAMAN KERJA</th>
		      			</tr>

		      			<tr>
			      			<td width="250">Nomor Surat SKPI</td>
			      			<td>
			      				<div class="col-sm-3">
			      					<input type="text" name="nomorsurat" placeholder="Nomor Surat .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>

		      			<tr>
			      			<td width="250">Nama Manajer</td>
			      			<td>
			      				<div class="col-sm-3">
			      					<input type="text" name="namamanajer" placeholder="Nama Manajer .." class="form-control" required>
			      				</div>
			      				<div class="col-sm-3">
			      					<input type="text" name="jabatan" placeholder="Jabatan .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>

		      			<tr>
			      			<td width="250">Nama Karyawan</td>
			      			<td>
			      				<div class="col-sm-3">
			      					<input type="text" name="namakaryawan" placeholder="Nama Karyawan .." class="form-control" required>
			      				</div>
			      				<div class="col-sm-9">
			      					<input type="text" name="type" placeholder="Alamat Karyawan .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>

		      			<tr>
			      			<td width="250">Lama Bekerja</td>
			      			<td>
			      				<div class="col-sm-3">
			      					<input type="text" name="dari" placeholder="Dari - Bulan Tahun .." class="form-control" required>
			      				</div>
			      				<div class="col-sm-3">
			      					<input type="text" name="sampai" placeholder="Sampai - Bulan Tahun .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>

		      			<tr>
			      			<td width="250">Jabatan</td>
			      			<td>
			      				<div class="col-sm-3">
			      					<input type="text" name="jabatankaryawan" placeholder="Jabatan .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>

		      			<tr>
			      			<td width="250">Alasan mengundurkan diri</td>
			      			<td>
			      				<div class="col-sm-9">
			      					<input type="text" name="alasan" placeholder="Alasan mengundurkan diri .." class="form-control" required>
			      				</div>
			      			</td>	
		      			</tr>
		      		</tbody>
		      	</table>
		      </p>
                <div class="panel-body">
                    <div class="form-group">
                    <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input name="setuju"  type="checkbox" onClick="Javascript:dis(this, 1);"> (check for create file)
                                <button id="off" onclick="uploadFile();" name="submit" disabled="disabled" type="submit" href="#" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-upload"></i> Create</button>
                        </div>
                    </div>
                </div>
		    </div>

            <!-- SURAT KETERANGAN KERJA -->
		    <div id="SKK" class="tab-pane fade">
		      <p>
		      	<table class="table table-bordered">
		      		<tbody>
		      			<tr class="success">
		      				<th colspan="2">SURAT KETERANGAN KERJA</th>
		      			</tr>

                        <tr>
                            <td width="250">Nomor Surat SKK</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="nomorsurat" placeholder="Nomor Surat .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Nama</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="nama" placeholder="Nama Karyawan.." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Jabatan</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="jabatan" placeholder="Jabatan.." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Lama Bekerja</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="dari" placeholder="Dari - Bulan Tahun .." class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="sampai" placeholder="Sampai - Bulan Tahun .." class="form-control" required>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td width="250">Karyawan Tetap/Kontrak</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="karyawan" placeholder="Karyawan/Kontrak.." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

		      		</tbody>
		      	</table>
		      </p>
                <div class="panel-body">
                    <div class="form-group">
                    <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input name="setuju"  type="checkbox" onClick="Javascript:dis(this, 1);"> (check for create file)
                                <button id="off" onclick="uploadFile();" name="submit" disabled="disabled" type="submit" href="#" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-upload"></i> Create</button>
                        </div>
                    </div>
                </div>
		    </div>

            <!-- PENGAJUAN BARANG -->
            <div id="PENGAJUAN" class="tab-pane fade">
              <p>
                <table class="table table-bordered">
                    <tbody>
                        <tr class="success">
                            <th colspan="2">SURAT PENGAJUAN BARANG</th>
                        </tr>

                        <tr>
                            <td width="250">Nomor Surat</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="nomorsurat" placeholder="Nomor Surat .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Tanggal</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="tempat" placeholder="Kota/Kab.." class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" name="tanggal" placeholder="tanggal .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Lampiran</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="lampiran" placeholder="Banyaknya Lampiran .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Perihal</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="perihal" placeholder="Perihal .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Kepada </td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="kepada" placeholder="Kepada Yth .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                    </tbody>
                </table>
              </p>
                <div class="panel-body">
                    <div class="form-group">
                    <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input name="setuju"  type="checkbox" onClick="Javascript:dis(this, 1);"> (check for create file)
                                <button id="off" onclick="uploadFile();" name="submit" disabled="disabled" type="submit" href="#" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-upload"></i> Create</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROMOSI & ROTASI JABATAN -->
            <div id="PROMOSI" class="tab-pane fade in active">
              <p>
                <table class="table table-bordered">
                    <tbody>
                        <tr class="success">
                            <th colspan="2">SURAT PROMOSI & ROTASI JABATAN</th>
                        </tr>

                        <tr>
                            <td width="250">Nomor Surat</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="nomorsurat" placeholder="Nomor Surat .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Tanggal</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="tempat" placeholder="Kota/Kab.." class="form-control" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" name="tanggal" placeholder="tanggal .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Lampiran</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="lampiran" placeholder="Banyaknya Lampiran .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Perihal</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="perihal" placeholder="Perihal .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td width="250">Kepada </td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="kepada" placeholder="Kepada Yth .." class="form-control" required>
                                </div>
                            </td>   
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <img src="p_layout/images/title.png" height="20" width="20"> Nama</span>
                                            <input id="user" type="text" class="form-control" name="nama" value="" placeholder="Nama">
                                    <span class="input-group-addon">
                                        <img src="p_layout/images/title.png" height="20" width="20"> Jabatan Lama</span>
                                            <input id="user" type="text" class="form-control" name="nama" value="" placeholder="Jabatan Lama">
                                    <span class="input-group-addon">
                                        <img src="p_layout/images/title.png" height="20" width="20"> Jabatan Baru</span>
                                            <input id="user" type="text" class="form-control" name="nama" value="" placeholder="Jabatan Baru">
                                    <span class="input-group-addon">
                                        <img src="p_layout/images/title.png" height="20" width="20"> Penempatan</span>
                                            <input id="user" type="text" class="form-control" name="nama" value="" placeholder="Penempatan">        
                                </div>
                                <hr>
                                    <button class="btn btn-primary"><i class="glyphicon glyphicon-upload"></i> Add Data</button>
                                <hr>
                                    <table style="width:100%">
                                        <tr>
                                            <th rowspan="2" width="50" class="text-center">No</th>
                                            <th rowspan="2" width="250" class="text-center">Nama</th> 
                                            <th colspan="2" width="300"class="text-center">Jabatan</th>
                                            <th rowspan="2" width="300"class="text-center">Penempatan</th>
                                        </tr>
                                        <tr>
                                            <th width="150" class="text-center">Lama</th>
                                            <th width="150" class="text-center">Baru</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Parjo</td>
                                            <td>Manajer Cabang</td>
                                            <td>Pusat</td>
                                            <td>Pusat</td>

                                        </tr>
                                        <tr>
                                            
                                        </tr>
                                    </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </p>
                <div class="panel-body">
                    <div class="form-group">
                    <!-- Button -->
                        <div class="col-sm-12 controls">
                            <input name="setuju"  type="checkbox" onClick="Javascript:dis(this, 1);"> (check for create file)
                                <button id="off" onclick="uploadFile();" name="submit" disabled="disabled" type="submit" href="#" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-upload"></i> Create</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script src="p_layout/js/jquery.min.js"></script>
    <script src="p_layout/js/bootstrap.min.js"></script>
    <script src="p_layout/js/pebri.js"></script>
    <script src="p_layout/js/notif.js"></script>
</body>
</html>
