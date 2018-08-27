<?php
	include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="apple-touch-icon" sizes="76x76" href="https://showroomqurban.com/favicon-i.png">
	<link rel="icon" type="image/png" href="https://showroomqurban.com/favicon.png">

	<meta name="googlebot-news" content="index,follow"/>
	<meta name="googlebot" content="index,follow"/>
	<meta name="robots" content="index,follow"/>
	<meta name="language" content="id"/>
	<meta name="geo.country" content="id"/>
	<meta name="news_keywords" content="qurban, kambing, qurban tangerang, tangerang, gharar, qurban gharar, kambing gharar, anti gharar">
	<meta name="keywords" content="qurban, kambing, qurban tangerang, tangerang, gharar, qurban gharar, kambing gharar, anti gharar">
	<meta http-equiv="content-language" content="In-Id"/>
	<meta name="geo.placename" content="Indonesia"/>
	<meta property="fb:pages" content="142246279698643"/>
	<meta property="fb:app_id" content="586095088077536"/>
	<meta property="og:image" content="https://showroomqurban.com/oge.png"/>
	<meta property="og:locale" content="id_ID"/>
	<meta property="og:type" content="article"/>
	<meta property="og:title" content="Hewan Qurban adalah Kendaraan Akherat"/>
	<meta property="og:description" content="Pilih kendaraan akherat terbaik anda di Showroom Qurban"/>
	<meta property="og:url" content="https://showroomqurban.com/kantor/"/>
	<meta property="og:image:type" content="image/png"/>
	<meta property="og:image:width" content="200"/>
	<meta property="og:image:height" content="200"/>
	<meta property="og:site_name" content="Showroom Qurban"/>
	<meta property="article:author" content="142246279698643" itemprop="author"/>
	
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@showroom.qur">
	<meta name="twitter:title" content="Hewan Qurban adalah Kendaraan Akherat">
	<meta name="twitter:description" content="Pilih kendaraan akherat terbaik anda di Showroom Qurban">
	<meta name="twitter:image" content="https://showroomqurban.com/og280x150.jpg">
	<meta name="twitter:image:src" content="og.jpg"/>
	<meta name="thumbnail" content="https://showroomqurban.com/og600x315.jpg"/>

    <title>Daftar reseller atau marketing - Showroom Qurban</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Registrasi</h3>
                    </div>
                    <div class="panel-body">
                        <form action="proses.php" method="POST">
                            <fieldset>	                           					
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Nama" name="nama" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Password" name="pass" type="password" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Ulangi Password" name="passCek" type="password" required>
                                </div>
								<!--
								<div class="form-group">
									<select name="jenis" class="form-control">
										<option value="jenis1" selected>- Pilih Jenis Pemasaran-</option>
										<option value="reseller">Reseller</option>
										<option value="marketing">Marketing</option>
									</select>
								</div>		
								-->
								<?php if(!isset($_GET['cq'])){
								echo '
                                <div class="form-group">
									<select name="ref" class="form-control">
											<option value="ref1" selected>- Pilih Marketing -</option>';
											$result = mysqli_query($con,"SELECT * FROM akses where akses='marketing'");
											while($data = mysqli_fetch_array($result)){
												echo "<option value='".$data[username]."'>".$data[nama]."</option>";
											} 
								echo '			
									</select>
                                </div>';
								
											}else{
												echo '<input type="hidden" name="ref" value = "'.$_GET['cq'].'"';
											}
								?>
								<div class="form-group">
                                    <input class="form-control" placeholder="Masukkan No Hp" name="email" type="text" required>
                                </div>
								
                                <button type="submit" class="btn btn-info pull-right" id="daftar" name="daf">Daftar</button>
								<a href="../login.php"> <button type="button" class="btn btn-danger pull-right" id="kembali" name="kem">Kembali</button></a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
