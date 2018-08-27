<?php 
$sesi1 = 'merao';
function liat($hwn,$sesi1) {   
	$q1 = mysqli_query($con,"SELECT `updated`,`showroom_view`,`lunas`,`pemilik`,`alamat`,`tgl_sold` FROM `qurban`.`hewan` where `id_hwn`='$hwn'");
	$liat = mysqli_fetch_array($q1);
	$format = "Y-m-d H:i:s";
	$timestamp = strtotime($liat['updated']);
    $difference = $timestamp - $_SERVER['REQUEST_TIME'];
    if($difference < 0){
		if(is_null($liat['lunas'])){
			mysqli_query($con,"UPDATE `qurban`.`hewan` SET `updated` = DATE_ADD(now(), INTERVAL 5 MINUTE) WHERE `hewan`.`id_hwn` = '$hwn'"); 
			$dpt['dtk'] =300;
			mysqli_query($con,"UPDATE `qurban`.`hewan` SET `showroom_view` = '$sesi1' WHERE `hewan`.`id_hwn` = '$hwn'");
			$dpt['lunas'] = 0;
		}else{
			$dpt['lunas'] =$liat['lunas'];
		}
		$dpt['nm'] =$sesi1;	
	}else{
		$dpt['dtk'] = $difference;
		$dpt['nm'] =$liat['showroom_view'];
		$dpt['lunas'] = $liat['lunas'];
    }
	$dpt['pml'] =$liat['pemilik'];
	$dpt['alm'] =$liat['alamat'];
	$dpt['sold'] =$liat['tgl_sold'];
	return $dpt;
}
if(isset($_POST['pelunasan'])){
	$kdl = $_POST['pelunasan']; 
		mysqli_query($con,"UPDATE `qurban`.`hewan` SET `lunas` = 'lunas' WHERE `hewan`.`id_hwn` = '$kdl'"); 
		
}
if(isset($_GET['batal'])){
	$kdb = $_GET['batal']; 
		mysqli_query($con,"UPDATE `qurban`.`hewan` SET `updated` = now() WHERE `hewan`.`id_hwn` = '$kdb'"); 
		
}
$dte = strtotime(date('Y/m/d H:i')) + 60 * 60;
$dts = date('d/m/Y H:i', $dte);
$info = "";
if(isset($_POST['keep'])){
	$nma = $_POST['pemilik']; $alm = $_POST['alamat']; $idny = $_POST['keep'];
	mysqli_query($con,"UPDATE `qurban`.`hewan` SET `pemilik` = '$nma', `alamat` = '$alm', `lunas` = 'keep', `tgl_sold` = now() WHERE `hewan`.`id_hwn` = '$idny'");
	$info = '<div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Pemesanan Qurban '.$idny.'
                        </div>
                        <div class="panel-body">
						<h4>'.$nma.'</h4>
                            <blockquote>
                                <p><h5 class="text-success">Telah memesan hewan qurban untuk dikirim ke alamat :</h5> '.$alm.'</p>
                                <small>Transfer sebelum
                                    <cite title="waktu">'.$dts.'</cite>
                                </small>
                            </blockquote>
                        </div>
                        <div class="panel-footer">
                            <p class="text-warning">Menunggu Pelunasan</p>
                        </div>
                    </div></div>';
}
if(isset($_POST['lunas'])){
	$nma = $_POST['pemilik']; $alm = $_POST['alamat']; $idny = $_POST['lunas'];
	mysqli_query($con,"UPDATE `qurban`.`hewan` SET `pemilik` = '$nma', `alamat` = '$alm', `lunas` = 'lunas', `tgl_sold` = now() WHERE `hewan`.`id_hwn` = '$idny'");
	$info = '<div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Pemesanan Qurban '.$idny.'
                        </div>
                        <div class="panel-body">
						<h4>'.$nma.'</h4>
                            <blockquote>
                                <p><h5 class="text-success">Telah memesan hewan qurban untuk dikirim ke alamat :</h5> '.$alm.'</p>
                                
                            </blockquote>
                        </div>
                        <div class="panel-footer">
                            <p class="text-success">Lunas!</p>
                        </div>
                    </div></div>';
}
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Proses Order </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			<?php 
				echo $info ;
				if(isset($_GET['lihat'])){					
				$dptn = liat($_GET['lihat'],$sesi1);
				if($dptn['lunas'] == 0){
					if ($dptn['nm'] == $sesi1){
						$stat = '<p class="text-success">Ready</p>';
					}else{
						$stat ='<p class="text-warning">Sedang ditawarkan oleh '.$dptn['nm']."</p>" ;
					}
				
				echo '
				<div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Kode Hewan '.$_GET['lihat'].' timer 
							<span id="countdown" class="timer"></span>
					   </div>
                        <div class="panel-body">
							<dl class="dl-horizontal">
							<h6>
                                <dt>Status</dt>
                                <dd>'.$stat.'</dd>
                            </h6>    
                            </dl>
							<form method="POST" action="?act=order">
							<input type="hidden" name="act" value="order"/>
							
                            <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Nama Pemilik</label>
                                            <input type="text" class="form-control" id="ktk" name="pemilik" disabled>
                                        </div>
							<div class="form-group">
                                            <label>Alamat Kirim</label>
                                            <textarea class="form-control" rows="3" id="ktk1" name="alamat" disabled></textarea>
                                        </div>			
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-outline btn-success" id="ktk2" disabled name="lunas" value="'.$_GET['lihat'].'">Lunas</button> <button type="submit" name="keep" class="btn btn-outline btn-primary" id="ktk3" value="'.$_GET['lihat'].'" disabled>Keep</button><button type="button" onClick="batalin('.$_GET['lihat'].');" class="btn btn-outline btn-danger pull-right" id="ktk4" disabled>Batal</button>
                        </div>
						</form>
                    </div>
			</div>';}
				}else{
						if($dptn['lunas'] == "keep"){
							$dt1 = strtotime(date('Y/m/d H:i:s',$dptn['sold'])) + 60 * 60;
							$dt2 = date('d/m/Y H:i', $dt1); $tmb ="";
							if ($dptn['nm'] == $sesi1){
								$tmb ='<form method="POST" action="?act=order"><button type="submit" class="btn btn-outline btn-success pull-right" id="ktk2" name="pelunasan" value="'.$_GET['lihat'].'">Lunas</button></form>';
						
							}
							echo '<div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Pemesanan Qurban '.$_GET['lihat'].'
                        </div>
                        <div class="panel-body">
						<h4>'.$dptn['pml'].'</h4>
                            <blockquote>
                                <p><h5 class="text-success">Telah memesan hewan qurban untuk dikirim ke alamat :</h5> '.$dptn['alm'].'</p>
                                <small>Transfer sebelum
                                    <cite title="waktu">'.$dt2.'</cite>
                                </small>
                            </blockquote>
                        </div>
                        <div class="panel-footer">
                            <p class="text-warning">Menunggu Pelunasan '.$tmb.'</p>
                        </div>
                    </div></div>';
						}else{
						echo '<div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Pemesanan Qurban '.$_GET['lihat'].'
                        </div>
                        <div class="panel-body">
						<h4>'.$dptn['pml'].'</h4>
                            <blockquote>
                                <p><h5 class="text-success">Telah memesan hewan qurban untuk dikirim ke alamat :</h5> '.$dptn['alm'].'</p>
                                
                            </blockquote>
                        </div>
                        <div class="panel-footer">
                            <p class="text-success">Lunas!</p>
                        </div>
                    </div></div>';
						}
				}	
			?>
				<div class="col-lg-8">
                    <div class="panel panel-info">
                        
                        <div class="panel-body">
						<form method="GET" >
						<input type="hidden" name="act" value="order"/>
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
                </div>
			</div>
            <!-- /.row -->
        </div>
	
<script>

var seconds = <?php echo $dptn['dtk']?>;
var pemilik = "<?php echo $dptn['nm']?>"; var aku ="<?php echo $sesi1 ?>";
function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = " "+ minutes + ":" + remainingSeconds;
	if ( pemilik == aku){
		document.getElementById("ktk").disabled = false;
		document.getElementById("ktk1").disabled = false;
		document.getElementById("ktk2").disabled = false;
		document.getElementById("ktk3").disabled = false;
		document.getElementById("ktk4").disabled = false;
	}
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = '<button type="button" class="btn btn-outline btn-primary btn-xs pull-right" onClick="window.location.reload()">Tawarkan</button>';
		document.getElementById("ktk").disabled = true;
		document.getElementById("ktk1").disabled = true;
		document.getElementById("ktk2").disabled = true;
		document.getElementById("ktk3").disabled = true;
		document.getElementById("ktk4").disabled = true;
    } else {
        seconds--;
    }
}
 
var countdownTimer = setInterval('secondPassed()', 1000);
function batalin(id){
        window.location='?act=order&batal='+id;
    }
</script>	