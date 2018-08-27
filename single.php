    <div class="main main-raised">
<?php 
//jika gbr lebih dari 1
$gbc = $_GET['q'];
$qco = mysqli_query($con,"SELECT `foto` FROM `$db`.`datil_hewan` WHERE `id_hwn` = '$gbc'");
$cekco = mysqli_num_rows($qco);
if($cekco > 0){
$slide ='';$itema = "item active";
while($dt_gco = mysqli_fetch_array($qco)){
	
$gslid ='
<div class="'.$itema.'">
											<img src="'.$dt_gco['foto'].'" alt="kambing showroom qurban">
											<div class="carousel-caption">
												<h4><i class="material-icons">location_on</i> Dokumentasi </h4>
											</div>
										</div>
';
$itema ='item';
$slide = $slide.$gslid;
}
//echo $cekco;	
echo '	
	<div class="section" id="carousel">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">

						<!-- Carousel Card -->
						<div class="card card-raised card-carousel">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<div class="carousel slide" data-ride="carousel">


									<!-- Wrapper for slides -->
									<div class="carousel-inner">
										
										'.$slide.'
									</div>

									<!-- Controls -->
									<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
										<i class="material-icons">keyboard_arrow_left</i>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
										<i class="material-icons">keyboard_arrow_right</i>
									</a>
								</div>
							</div>
						</div>
						<!-- End Carousel Card -->

					</div>
				</div>
			</div>
		</div>';
}
?>



        <div class="section">
		<div class="col-md-12">
		<div class="col-md-4 col-md-offset-4">
	    						<div class="card card-profile ">
	    							<div class="card-image">
	    								<a href="#pablo">
	    									<img class="img" src="<?php echo $img; ?>" />
	    								</a>
	    							</div>

	    							<div class="card-content">
	    								<h4 class="card-title"><?php echo $jdla; ?></h4>
	    								<h6 class="category text-gray"><?php echo $rp_k; ?></h6>
										<p><?php echo $bert; ?></p>
	    								<div class="footer">
	    									<a href="#pablo" class="btn btn-just-icon btn-twitter btn-round"><i class="fa fa-twitter"></i></a>
	    									<a href="#pablo" class="btn btn-just-icon btn-facebook btn-round"><i class="fa fa-facebook-square"></i></a>
	    									<a href="#pablo" class="btn btn-just-icon btn-google btn-round"><i class="fa fa-google"></i></a>
	    								</div>
	    							</div>
	    						</div>
	    					</div>
			
<?php
function ref5($get, $id,$db,$qre){
	
	$tmp_tomb ='';
	if($qre == true){
		$ref_no = substr_replace($qre['email'],'62',0,1);
		$tmp_tomb = '							
													
		';
		$tmp_tomb ='
		<div class="col-md-6 col-md-offset-3">
	        					<div class="text-center">
	        						<h3 class="title">Terima Kasih,</h3>
	        						<p class="description">
	        							Anda adalah pembeli yang bijak, setelah anda mengenal salah satu markting kami. Sekarang isi form dibawah ini untuk memesan kendaraan akherat anda :)
	        							
	        							
	        					<div class="card card-raised card-form-horizontal">
	        						<div class="card-content">
	        							<form method="POST" >
	        								<div class="row">
	        									<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">contact_phone</i>
	        											</span>
	        											<input type="text" name="wa" placeholder="Masukan No HP/WA Anda..." class="form-control" />
	        										</div>
	        									</div>
												<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">user</i>
	        											</span>
	        											<input type="text" name="kupon" placeholder="Kupon Diskon" class="form-control" />
	        										</div>
	        									</div>
	        									
	        									<input type="hidden" name="noRef" value="'.$ref_no.'" class="form-control" />
	        							<input type="hidden" name="namaRef" value="'.$get.'" class="form-control" />		
	        									
												</div><div class="row">
	        									<div class="col-sm-12 col-lg-12">
	        										<button type="submit" class="btn btn-primary btn-block" name="idh" value="'.$id.'">Pesan Sekarang</button>
	        									</div>
	        								</div>
	        							</form>
	        						</div>
	        					</div>
	        							
	        							
	        							
	        							
										
	        						</p>
	        					</div>
								</div>
		';
		
	}else{
		$tmp_tomb ='
	
	        				<div class="col-md-6 col-md-offset-3">
	        					<div class="text-center">
	        						<h3 class="title">Inikah Hewan Qurban Anda?</h3>
	        						<p class="description">
	        							Miliki segera, mumpung harga masih bagus dan mumpung hewan masih ada. Ayo pesan sekarang! tinggalkan nomor selular anda dan kami akan menghubungi
	        						</p>
	        					</div>

	        					<div class="card card-raised card-form-horizontal">
	        						<div class="card-content">
	        							<form method="POST" >
	        								<div class="row">
	        									<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">contact_phone</i>
	        											</span>
	        											<input type="text" name="wa" placeholder="Masukan No HP/WA Anda..." class="form-control" />
	        										</div>
	        									</div>
												<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">user</i>
	        											</span>
	        											<input type="text" name="kupon" placeholder="Kupon Diskon" class="form-control" />
	        										</div>
	        									</div>
												
											</div><div class="row">
	        									<div class="col-sm-12 col-lg-12">
	        										<button type="submit" class="btn btn-primary btn-block" name="idh" value="'.$id.'">Pesan Sekarang</button>
	        									</div>
	        								</div>
	        							</form>
	        						</div>
	        					</div>

	        				</div>	
	';
	}	
	return($tmp_tomb);
}

//fungsi normal
function norm5($id_hwn){
	$tmp_tomb ='
	
	        				<div class="col-md-6 col-md-offset-3">
	        					<div class="text-center">
	        						<h3 class="title">Inikah Hewan Qurban Anda?</h3>
	        						<p class="description">
	        							Miliki segera, mumpung harga masih bagus dan mumpung hewan masih ada. Ayo pesan sekarang! tinggalkan nomor selular anda dan kami akan menghubungi
	        						</p>
	        					</div>

	        					<div class="card card-raised card-form-horizontal">
	        						<div class="card-content">
	        							<form method="POST" >
	        								<div class="row">
	        									<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">contact_phone</i>
	        											</span>
	        											<input type="text" name="wa" placeholder="Masukan No HP/WA Anda..." class="form-control" />
	        										</div>
	        									</div>
												<div class="col-sm-6 col-lg-6">

	        										<div class="input-group">
	        											<span class="input-group-addon">
	        												<i class="material-icons">user</i>
	        											</span>
	        											<input type="text" name="kupon" placeholder="Kupon Diskon" class="form-control" />
	        										</div>
	        									</div>
												</div><div class="row">
	        									<div class="col-sm-12 col-lg-12">
	        										<button type="submit" class="btn btn-primary btn-block" name="idh" value="'.$id_hwn.'">Pesan Sekarang</button>
	        									</div>
	        								</div>
	        							</form>
	        						</div>
	        					</div>

	        				</div>	
	';
	return $tmp_tomb;
}


if($stal == NULL ){
	if(isset($_GET['cq'])){
		$get5 = $_GET['cq'];
		$qre5 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `$db`.`akses` WHERE `username` ='$get5' AND `email` IS NOT NULL"));
		$aksi =ref5($_GET['cq'],$idny,$db,$qre5);
	}else{
		$aksi =norm5($idny);
	}
echo $aksi;
}else{
	echo '
	<div class="col-md-6 col-md-offset-3">
	        					<div class="text-center">
	        						<h3 class="title">Yaahh? anda terlambat</h3>
	        						<p class="description">
	        							Kendaraan akherat ini telah menemukan pemiliknya, ayo semangat dn temukan kendaraan akherat anda :-)
	        						</p>
	        					</div>
								</div>
	';
}
							?>
			
		</div><!-- section -->

        <div class="section">
		<div class="features text-center">
                <div class="row">
    				<div class="col-md-4">
    					<div class="info">
    						<div class="icon icon-info">
    							<i class="material-icons">local_shipping</i>
    						</div>
    						<h4 class="info-title">FREE DELIVERY </h4>
    						<p>Fasilitas FREE DELIVERY kami berikan untuk anda yang tinggal diwilayah Tangerang Raya dan Jakarta Barat</p>
    					</div>
    				</div>

    				<div class="col-md-4">
    					<div class="info">
    						<div class="icon icon-success">
    							<i class="material-icons">verified_user</i>
    						</div>
    						<h4 class="info-title">JEMPUT QURBAN</h4>
    						<p>Dapatkan Cashback Rp 100.000 saat anda melakukan pengambilan hewan qurban yang sudah anda pesan.</p>
    					</div>
    				</div>

    				<div class="col-md-4">
    					<div class="info">
    						<div class="icon icon-rose">
    							<i class="material-icons">favorite</i>
    						</div>
    						<h4 class="info-title">FREE JASA SEMBELIH</h4>
    						<p>Bagi anda yang berkenan mengikuti program "SEBAR QURBAN", hewan qurban anda akan disembelih di mushola/masjid terpencil yang belum melaksanakan kegiatan sembelih hewan qurban. Lokasi mushola/masjid adalah di daerah pinggiran kota, di perkampungan/desa, diseputar Tangerang Raya</p>
    					</div>
    				</div>

                </div>
            </div>

		</div>
	</div>	