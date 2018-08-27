<?php 
$nm_us4 = $_SESSION['nama'];
$qtab =mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `showroom_view` = '$nm_us4' ORDER BY `hewan`.`lunas` ASC");
$tabel ='';
while ($dttab = mysqli_fetch_array($qtab)){
	if($dttab['lunas'] == "keep"){
		if(is_null($dttab['dealer_view']) OR empty($dttab['dealer_view'])){
	$klas = 'warning';
		}else{
	$klas = 'danger';	
		}
		$statt = "Keep";
	}else if($dttab['lunas'] == "lunas"){
	$klas = 'success';
	$statt = "Lunas";
	}else{
	$klas = 'info';
	$statt ='Prospek';
	}
	$tab1 = '
	<tr class="'.$klas.'">
	<td></td>
    <td>'.$statt.'</td>
    <td>'.$dttab['kategori'].'-'.$dttab['id_hwn'].'</td>
    <td>'.$dttab['pemilik'].'</td>
    <td>'.$dttab['alamat'].'</td>
	<td>'.$dttab['dealer_view'].'</td>
    </tr>
	';
	$tabel = $tabel.$tab1;
}
//lihat available
$avail ='';
$qav = mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `hewan`.`lunas` IS NULL ");
while($dav = mysqli_fetch_array($qav)){
$avb='
<tr>
                                        <td>'.$dav['kategori'].'</td>
                                        <td>'.$dav['id_hwn'].'</td>
                                        <td>'.number_format($dav['harga_lama'],0).'</td>
                                        <td class="center">'.$dav['berat'].'</td>
                                        
                                    </tr>
';

$avail = $avail.$avb;
}

if($_SESSION["akses"] == "marketing"){
	

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
                                        '.$tabel.'
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
</div>';}else{ $statistik ='';}
$statistik1 =$statistik.'				
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Kambing Available
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <thead>
                                    <tr>
                                        <th>Tipe</th>
                                        <th>Nomor</th>
                                        <th>Harga</th>
                                        <th>Berat</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   '.$avail.'
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
				';
?>				