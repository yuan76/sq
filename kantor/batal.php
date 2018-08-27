<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit/Batal Order </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
	<?php	
	//aksi ubah
	include "koneksi.php";
	if(isset($_POST['ubah'])){
		$idh = $_POST['ubah']; 
		$pml = $_POST['pml'];
		$almt = $_POST['alm'];
		$nope = $_POST['nope'];
		$prov = $_POST['prov'];
		$kab = $_POST['kab'];
		$kec = $_POST['kec'];
		$ds = $_POST['ds'];		
		//$potongan = $_POST['potongan'];
		$kupon = strtoupper($_POST['kupon']);
		
		/*
		if ($potongan == ""){		
			$potongan = 0;
		} else {
			$potongan = $potongan;
		}
		*/
		if ($kupon == "kosong"){
			$kupon = "kosong";
			$nilaiKup = 0;
		} else if($kupon==""){
		    $kupon = "";
			$nilaiKup = 0;
		} else {			
			$cekKupon = mysqli_query($con, "select * from `akses` where `kupon`='$kupon'");
			if (mysqli_num_rows($cekKupon) > 0) {
				while($data=mysqli_fetch_assoc($cekKupon)){
					$nilaiKup=$data['rp_kupon'];
					$kupon=$data['kupon'];
				}			
			} else {
			    $kupon = "";
				$nilaiKup = 0;
			    echo "<script> alert('Maaf, kupon yang anda masukkan tidak tersedia');
			    window.location='?act=kensel&lihat=$idh'</script>";
			
			}
		}	
		
		$qryAmbilHar = mysqli_query($con,"select `harga_lama` from `hewan` WHERE `hewan`.`id_hwn` = '$idh'");
		$hLama = mysqli_fetch_assoc($qryAmbilHar);
		$hBaru = $hLama['harga_lama'] - $nilaiKup;
		//$hBaru = $hBaru - $nilaiKup;
		mysqli_query($con,"UPDATE `$db`.`hewan` SET `pemilik` = '$pml', `alamat` = '$almt', `nope` = '$nope', `prov` = '$prov', `kab` = '$kab', `kec` = '$kec', `ds` = '$ds', `harga_disc` = NULL, `kupon` = '$kupon', `rp_kupon` = '$nilaiKup', `harga_baru` = '$hBaru' WHERE `hewan`.`id_hwn` = '$idh';");
	}
		//aksi batal
	if(isset($_POST['batal'])){
		$idh = $_POST['batal']; 
		$pml = $_POST['pml'];
		$almt = $_POST['alm'];
		mysqli_query($con,"UPDATE `$db`.`hewan` SET `pemilik` = NULL, `alamat` = NULL, `lunas`= NULL, `nope`= NULL, `prov`= NULL, `kab`= NULL, `kec`= NULL, `ds`= NULL, `harga_baru`= NULL, `showroom_view`= NULL, `harga_disc`= NULL, `kupon`= NULL, `rp_kupon`= NULL WHERE `hewan`.`id_hwn` = '$idh';");
	}
	
	//query cari
	$panel ='';
	if(isset($_GET['lihat'])){
		$order = $_GET['lihat'];
		//klo ada di db
		$qc = mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `id_hwn` = '$order' AND `lunas` IS NOT NULL");
		$dc = mysqli_fetch_array($qc);
		$tbd ='';
		if(is_null($dc['dealer_view'])){
			$tb = ' disabled ';
		}
		if($dc['id_hwn']){
			if($dc['showroom_view'] == $nm_us){ //cocokin pemillik
				
			$panel ='
					<div class="col-lg-4">
						<div class="panel panel-info">
							<div class="panel-heading">
								'.$dc['kategori'].'-'.$dc['id_hwn'].' 
								
						   </div>
							<div class="panel-body">
								<dl class="dl-horizontal">
								<h6>
									<dt>'.$dc['dealer_view'].'</dt>
									<dd><p class="text-success">Kontak</p></dd>
								</h6>    
								</dl>
								<form method="POST" action="?act=kensel" >
									<input type="hidden" name="kensel" value="'.$dc['id_hwn'].'"/>
									<input type="hidden" name="act" value="kensel"/>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Nama Pemilik</label>
										<input type="text" class="form-control" id="ktk" name="pml" value="'.$dc['pemilik'].'"'.$tbd.'>
									</div>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Nomor HP/WA</label>
										<input type="text" class="form-control" id="ktkNope" name="nope" value="'.$dc['nope'].'"'.$tbd.'>
									</div>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Provinsi</label>
										<input type="text" class="form-control" id="ktkProv" name="prov" value="'.$dc['prov'].'"'.$tbd.'>
									</div>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Kabupaten</label>
										<input type="text" class="form-control" id="ktkKab" name="kab" value="'.$dc['kab'].'"'.$tbd.'>
									</div>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Kecamatan</label>
										<input type="text" class="form-control" id="ktkKec" name="kec" value="'.$dc['kec'].'"'.$tbd.'>
									</div>
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Desa</label>
										<input type="text" class="form-control" id="ktkDes" name="ds" value="'.$dc['ds'].'"'.$tbd.'>
									</div>
									<div class="form-group">
										<label>Alamat Kirim</label>
										<textarea class="form-control" rows="3" id="ktk1" name="alm" value="'.$dc['alamat'].'">'.$dc['alamat'].'</textarea>
									</div>	
									<div class="form-group has-success">								
										<label class="control-label" for="inputSuccess">Kode Kupon</label>
										<input type="text" class="form-control" id="ktkKup" name="kupon" value="'.$dc['kupon'].'"'.$tbd.'>
									</div>									
							</div>
							<div class="panel-footer">
								<button type="submit" class="btn btn-outline btn-success" id="ktk2" name="ubah" value="'.$dc['id_hwn'].'">Edit</button> 
								<button type="submit" class="btn btn-outline btn-danger pull-right" id="ktk4" name="batal" value="'.$dc['id_hwn'].'">Batal Order</button>
							</div>
								</form>
							<img class="img-responsive" src="http://192.168.1.152/qurban2/assets/img/examples/kamb4.jpg" alt="showroom qurban">
						</div>
				</div>	';	
			}else{
    			//$panel =''; //jika record g ada
    			echo "<script> alert('Gagal edit karena kambing sudah di tawarkan oleh reseller lain');
    			window.location='index.php?act=kensel';</script>";
    		}
			
		}else{
			//$panel =''; //jika record g ada
			echo "<script> alert('Gagal edit karena kambing sudah di tawarkan oleh reseller lain');
			window.location='index.php?act=kensel';</script>";
		}
	}
		
				
		$cari ='		
				<div class="col-lg-8">
                    <div class="panel panel-info">
                        
                        <div class="panel-body">
						<form method="GET" >
						<input type="hidden" name="act" value="kensel"/>
                            <div class="form-group input-group">
                                            <input type="text" class="form-control" name="lihat">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>			
                        </div>
                        <div class="panel-footer">
                            Lihat Hewan Qurban
                        </div>
                    </div>
                </div>';
	echo $panel.$cari;			
	?>			
			</div>