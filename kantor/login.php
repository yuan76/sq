<?php 
session_start();
include 'koneksi.php';
if(isset($_POST['cek'])){
	$nm_u = $_POST['user'];

	$q_det = mysqli_query($con,"select * FROM akses WHERE username = '$nm_u'");
	$det = mysqli_fetch_array($q_det);
	$nm_agen = $det['nama'];
	$saltny = $det['salt'];
	$pass_db = $det['password'];
	//echo $nm_agen." ".$saltny." ".$pass_db;
}


if(isset($_POST['sand'])){
	$sandi = $_POST['sand'];
	//echo $sandi;
	
	if($pass_db ==''){
		
		$escapedName = mysqli_real_escape_string($con,$nm_agen); 
		$escapedPW = mysqli_real_escape_string($con,$sandi);
		//echo $escapedName." ".$escapedPW." db tidak ada";

		# generate a random salt to use for this account
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

		$saltedPW =  $escapedPW . $salt;

		$hashedPW = hash('sha256', $saltedPW);
		//echo $saltedPW." ".$hashedPW." yg db kosong";

	mysqli_query($con,"UPDATE akses SET salt='$salt', password='$hashedPW' WHERE username='$nm_u'");
	$_SESSION["otoritas"] = $hashedPW;
	header('location: ./login.php?error=3');
	
	//echo "pass db kosong";
	
	}else{
		
		$escapedName = mysqli_real_escape_string($con, $nm_agen); 
		$escapedPW = mysqli_real_escape_string($con, $sandi);
		
		/*
		echo $escapedName." ".$escapedPW." db ada <br>";
		if (isset($escapedPW)){
			echo "escapePw ada db ada";
		} else {
			echo "escapePw tidak ada db ada";
		}
		*/
		
		# generate a random salt to use for this account
		
		$salt = $saltny;

		$saltedPW =  $escapedPW . $salt;

		$hashedPW = hash('sha256', $saltedPW);
		
		//echo $salt." yuan ".$saltedPW." yuan ".$hashedPW." yang db ada";

		//echo $hashedPW."<br>";
		//echo $pass_db;
		
		if($hashedPW == $pass_db){
		//echo "ya sama";
		
		$_SESSION["otoritas"] = $hashedPW;
		header('location: ./');
		
		//print_r($_SESSION['otoritas']);
		
		}else{
			//echo "tidak sama";
		header('location:location: ./login.php?error=2');
		//	echo $pass_db.' <-pass ';
		}
		
		
		//echo "pass db tidak kosong";
	}
	
} 
/*
else {
	echo "tidak ada sandi";
}
*/
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

    <title>Login Showroom Qurban</title>
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Akses Masuk</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
							<?php $info ='';
							if(isset($_GET['error'])){
								$error = $_GET['error'];
								if ($error == 2){
									$info = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-danger">Anda tidak memiliki akses ke sistem ini!</p></div>';
								}else if($error == 3){
									$info = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-info">Ini login yang pertama! password anda sudah diset, cobalah login lagi</p></div>';
								}else if($error == "sesiexp"){
									$info = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-danger">Anda perlu login kembali</p></div>';
								}else{
								$info = "error ".$error; }
							}
							echo $info;
							?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="sand" type="password" value="">
                                </div>
								<div>Ingin bergabung dengan kami?</div>
								<div>Silahkan <a href="registrasi/">Klik di sini</a></div>
                                <button type="submit" class="btn btn-info pull-right" id="ktk2"  name="cek" >Buktikan!</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

</body>

</html>
