<?php
    include "config.php";
    $nim_mhs = $_GET['nim_mhs'];
    $query=mysql_query("SELECT * FROM tb_data_mahasiswa where nim_mhs='$nim_mhs'");
    while($d=mysql_fetch_array($query)){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Surat Keterangan</title>

</head>

<body style="font-family:Times New Roman;font-size:12px" onLoad="print();">

           <table cellspasing=0 cellpadding=0>
                <tr>
                    <td><img src="Images/unis.jpg" height="80px"></td>
                    <td align="center" style="font-family:Arial;">
                        <span style="font-size:24px;">UNIVERSITAS ISLAM SYEKH YUSUF -TANGERANG</span>
                        <br>
                        <span style="font-size:9px;">
                        Jl. Maulana Yusuf No.10, Babakan, Kec. Tangerang, Kota Tangerang, Banten 15118. TELEPHONE
						021-5527061 / 5527063
                        <br>
                        Email : akademik@unis.ac.id
                        </span>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><div style="width: 100%;border: 1px solid black;"></div></td>
                </tr>
				<tr>
				<br>
				 <td colspan="30" align="center"><span style="font-size:20px;">SURAT KETERANGAN DATA MAHASISWA</span></td>
				 </tr>
				 <tr>
				 	<center><td><img class="img-responsive" src="<?php echo $d['location'] ?>"/></td></center>
				 </tr>
					<tr>
                    <td colspan="3"><span style="font-size:12px;">Berikut Biodata Mahasiswa, Sebagai Berikut :</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                               
                            </tr>
                            <tr>
                                <td></td>
                                <td>NIM</td>
                                <td>:</td>
                                <td colspan="4"><?php echo $d['nim_mhs'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td colspan="4"><?php echo $d['nama_mhs'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Tempat Lahir</td>
                                <td>:</td>
                                <td colspan="4"><?php echo $d['tempat_lahir'] ?></td>
                            </tr>
							<tr>
                                <td></td>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td colspan="4"><?php echo $d['tanggal_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
								<td>Alamat</td>
								<td>:</td>
								<td colspan="4"><?php echo $d['alamat'] ?></td>
							</tr>
							<tr>
								<td></td>
								<td>Asal Sekolah</td>
								<td>:</td>
								<td colspan="4"><?php echo $d['asal_sekolah'] ?></td>
							</tr>
							<tr>
								<td></td>
								<td>No Telepon</td>
								<td>:</td>
								<td colspan="4"><?php echo $d['no_tlp'] ?></td>
							</tr>
							<tr>
								<td></td>
								<td>Email</td>
								<td>:</td>
								<td colspan="4"><?php echo $d['email'] ?></td>
							</tr>
							<tr>
                                <td></td>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td colspan="4" font type="bold" ><?php echo $d['status'] ?></td>
                            </tr>
							   </table>
                    </td>
                    <td></td>
                </tr>
                   
                <tr>
                    <td colspan="3"><span style="font-size:12px;">Dengan ini saya menyatakan dengan penuh kesadaran bahwa segala informasi yang kami sampaikan dalam formulir tersebut diatas adalah benar sebagaimana adanya</span></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <table width="495">
                            <tr>
                                <td width="26"></td>
                                <td width="239"><div align="center">Tangerang,.....................................................<br><br><br><br><br><br></div></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div align="center"></div></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div align="center">(...............................................................)<br>
                                  Pengurus</div></td>
                            </tr>
                      </table>
                      <?php } ?>
                    </td>
                </tr>
           </table>
</body>

</html>
