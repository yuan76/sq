<html>
<head>	
	<title> Registrasi Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$pass = $_POST['pass'];
$passCek = $_POST['passCek'];
//$jenis = $_POST['jenis'];
$ref = $_POST['ref'];
$email = $_POST['email'];

if($pass == $passCek){
	if($ref != "ref1"){		
		//Mengatur username yang diambil dari nama
		$nama = preg_replace('/[^A-Za-z0-9\  ]/', '', $nama);
		$pisahNama=explode(" ",$nama);
		//$arrayNama=$pisahNama[0].$pisahNama[1];
		$user=strtolower($pisahNama[0]);
		$cekusername = mysqli_query($con, "select * from akses where nama like '$pisahNama[0]%'");
		$tambah=mysqli_num_rows($cekusername);

		if ($tambah <= 0) {
			$username=$pisahNama[0];
		} else {
			$username=$pisahNama[0].$tambah;
		}

		//echo $username."<br>";

		//Mengatur Password dan salt
		$salt = uniqid('', true);
		$escapedPass = mysqli_real_escape_string($con,$pass);
		$saltedPass =  $escapedPass . $salt;

		$hashedPass = hash('sha256', $saltedPass);
		//echo $salt." ".$hashedPass."<br>";

		//Mengatur Kupon
		function buatKupon($length){
			$data = '1234567890';
			$string = '';
			for($i = 0; $i < $length; $i++) {
				$pos = rand(0, strlen($data)-1);
				$string .= $data{$pos};
			}
			return $string;
		}
		$kupon=buatKupon(6);
		$rp=100000;
		
		$email = preg_replace('/[^A-Za-z0-9\  ]/', '', $email);
		$digit = substr($email,0,1);
			if((strlen($email) >= 9 && strlen($email) <= 13) && ($digit == 0)){
		$sql = "insert into akses (kode,username,password,nama,akses,salt,email,referal,kupon,rp_kupon)	
			values (NULL,'$username','$hashedPass','$nama','reseller','$salt','$email','$ref','$kupon','$rp')";
		$query=mysqli_query($con,$sql);
    		if($query){
    			echo "
    			<div class='pageLoader'></div>
    			<br />
    
    			<div class='container'>
    				<div class='card'>
    					<div class='card-body' style='text-align:center;'>
    						<h2>Selamat, anda berhasil terdaftar menjadi Reseller SQ</h2>
    						<p>Dengan username ".$username."</p>
    						<p>Dibawah ini adalah kupon yang anda dapat gunakan untuk pemasaran</p>
    						<p> <i>".$kupon."</i>, senilai Rp.".$rp."</p>
    						<br>
    						<sup>gunakan kupon dengan sebaik baiknya</sup>
    						<br> <br>
    						<a href='index.php'><p> Kembali </p></a>
    					</div>
    				</div>
    			</div>
    			";
    		}
		} else {
			echo "<script> alert('Apakah anda sudah yakin memasukkan nomor HP dengan benar?');
			window.location='index.php'</script>";
		}
		
	} else {
		echo "<script> alert('Mohon pilih Marketing anda terlebih dahulu');
		window.location='index.php'</script>";
	}
} else {
	echo "<script> alert('Password tidak sama, mohon ulangi lagi');
		window.location='index.php'</script>";
}
?>
</body>
</html>