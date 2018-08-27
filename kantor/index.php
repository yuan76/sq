<?php session_start();
include 'koneksi.php';
include 'cek.php';
include 'statistik.php';
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

    <title>Back Office - Showroom Qurban</title>

    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="./vendor/morrisjs/morris.css" rel="stylesheet">

    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
 <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>
<!-- DataTables CSS -->
    <link href="./vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="./vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="../assets/css/kantor.css" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Showroom Qurban</a>
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation" id="menuSamping">
                <div class="sidebar-nav navbar-collapse">
				       <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Panel Kerja</a>
                        </li>
<?php if($_SESSION["akses"] == "admin"){
	echo '
                        <li>
                            <a href="?act=input"><i class="fa fa-edit fa-fw"></i> Input Hewan</a>
						</li>
						';
}
?>
<?php if($_SESSION["akses"] == "offline"){
	echo '
                        <li>
                            <a href="?act=offline"><i class="fa fa-edit fa-fw"></i> Penjualan Offline</a>
						</li>
						';
}
?>
<?php if(($_SESSION["akses"] == "marketing" OR $_SESSION["akses"] == "offline") OR $_SESSION["akses"] == "reseller"){
	echo '
                        <li>
                            <a href="?act=kensel"><i class="fa fa-edit fa-fw"></i> Edit/Batal Order</a>
						</li>
						';
}
?>
<?php if($_SESSION["akses"] == "marketing" OR $_SESSION["akses"] == "reseller"){
	echo '
                        <li>
                            <a href="?act=order"><i class="fa fa-edit fa-fw"></i> Input Order</a>
						</li>
						<li>
                            <a href="?act=komisi"><i class="fa fa-money fa-fw"></i> Komisi</a>
                        </li>
						';
}
?>
						<li>
                            <a href="?act=logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>
						
                    </ul>
                
		</div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
<?php $tawar =0;
	$lunas =0; $txt_wa =''; $alert ='';
	$keep =0; $wa_r ='*REPORT order showroomQurban* &#13;&#10;'.date("j F Y, g:i a").'&#13;&#10; =================== &#13;&#10;';
	$total =0; $tabad ='';
	//lihat user yg login
	$aktif_user = $_SESSION['akses'];
	$nm_us = $_SESSION['nama'];
	
	//jika marketing
	if($aktif_user == 'marketing'){
	
	$qdat = mysqli_query($con,"SELECT `pemilik`,`alamat`,`lunas`,`harga_baru`,`id_hwn`,`dealer_view`,`kategori` FROM `$db`.`hewan` where `showroom_view` = '$nm_us'");
	while ($dat = mysqli_fetch_array($qdat)){
		//jika lunas, hitung
		if($dat['lunas'] == 'lunas'){
			$lunas++;
		}else if($dat['lunas'] == 'keep'){
			$keep++;
			$wa_no = substr_replace($dat['dealer_view'],'62',0,1);
			if(!is_null($dat['dealer_view'])){
			$alert = $alert.'<div class="alert alert-danger">
                            Anda mendapatkan order dari '.$dat['dealer_view'].' utk '.$dat['kategori'].'-'.$dat['id_hwn'].' <a href="https://api.whatsapp.com/send?phone='.$wa_no.'&text=Assalamualaikum%2C%20Saya%20marketing%20SQ%20terima%20kasih%20telah%20memesan%20http%3A%2F%2Fshowroomqurban.com%2F%3Fq%3D'.$dat['id_hwn'].'" type="button" class="btn btn-danger">FollowUp</a>
                            </div>';
			}
		}else{
			$tawar++;
		}
	}
	$total = $keep+$lunas;
	}else if($aktif_user == 'admin'){
		$qdat7 = mysqli_query($con,"SELECT `pemilik`,`alamat`,`lunas`,`harga_lama`,`showroom_view`,`kategori`,`id_hwn` FROM `$db`.`hewan` where `lunas` IS NOT NULL");
	$rp_ln =0; $rp_kp =0;	
	while ($dat7 = mysqli_fetch_array($qdat7)){
		//jika lunas, hitung
		if($dat7['lunas'] == 'lunas'){
			$lunas++;
			$rp_ln = $rp_ln + $dat7['harga_lama'];
		}else if($dat7['lunas'] == 'keep'){
			$keep++;
			$rp_kp = $rp_kp + $dat7['harga_lama'];
		}else{
			$tawar++;
		}
		
	//	if($dat7['lunas'] == "keep"){
	//		$klse = "info";		
	//		$tnd ="
	if($dat7['lunas'] == "keep"){
			$klse = "info";		
			$tnd ="ðŸ“³";
		}else if($dat7['lunas'] == "lunas"){
			$klse ="success";
			$tnd="âœ…";
		}else{
			$klse ="warning";
			$tnd='warn';
		}
		$tabi = '
		<tr class="'.$klse.'">
	<td>'.number_format($dat7['harga_lama'],0).'</td>
    <td>'.$dat7['lunas'].'</td>
    <td>'.$dat7['kategori'].'-'.$dat7['id_hwn'].'</td>
    <td>'.$dat7['pemilik'].'</td>
    <td>'.$dat7['alamat'].'</td>
	<td>'.$dat7['showroom_view'].'</td>
    </tr>
		';
		$tabad = $tabad.$tabi;
		$wa_r =$wa_r.$tnd.' '.$dat7['kategori'].'-'.$dat7['id_hwn'].' âœ'.$dat7['showroom_view'].' '.number_format($dat7['harga_lama'],0).'| _'.$dat7['pemilik'].'_ &#13;&#10;';
	}
	$total = $keep+$lunas;
	$tabad = $tabad.'<tr class="danger"><td colspan="3">Keep Rp '.number_format($rp_kp,0).'</td><td colspan="3"> Lunas Rp '.number_format($rp_ln,0).'</td></tr>';
	$wa_r =$wa_r."Keep : _Rp ".number_format($rp_kp,0).'_ &#13;&#10;'."Lunas : _Rp".number_format($rp_ln,0).'_';
	$txt_wa = '
	<div class="form-group">
                                            <label>Report WA</label>
                                            <textarea class="form-control" rows="15">'.$wa_r.'</textarea>
                                        </div>
	';
	
	$statistik ='<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Panel Order
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>FOLLOW</th>
                                            <th>STATUS</th>
                                            <th>KODE</th>
                                            <th>PEMILIK</th>
											<th>ALAMAT</th>
											<th>KONTAK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$tabad.'
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
</div>';
	
	
	}
	
	if(isset($_GET['act'])){
		if ($_GET['act'] == "input"){
			include 'inp_hwn.php';
		}else if($_GET['act'] == "order"){
			include 'order1.php';
		}else if($_GET['act'] == "kensel"){
			include 'batal.php';
		}else if($_GET['act'] == "offline"){
			include 'offline.php';	
		}else if($_GET['act'] == "komisi"){
            include 'komisi.php';
		}else if($_GET['act'] == "admin"){
			include 'admin.php';	
		}else{
		
		}
	}else{	
		echo '    <div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">'.$alert.'
						<h1 class="page-header">Bissmillah</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-gitlab fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$tawar.'</div>
										<div>Hewan ditawarkan!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-money fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$lunas.'</div>
										<div>Lunas!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-shopping-cart fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$total.'</div>
										<div>Order!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-support fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$keep.'</div>
										<div>Pending!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>'.$txt_wa.'
				'.$statistik.$statistik1.'
				<!-- /.row -->
			</div>';
		}
?>   

    </div>
    <!-- DataTables JavaScript -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="./vendor/datatables-responsive/dataTables.responsive.js"></script>
   <script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>