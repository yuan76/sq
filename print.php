<?php
include './kantor/koneksi.php';
$wa_r ='';
$qdat7 = mysqli_query($con,"SELECT `pemilik`,`alamat`,`lunas`,`harga_lama`,`showroom_view`,`kategori`,`id_hwn` FROM `$db`.`hewan` where `lunas` IS NOT NULL");
	$rp_ln =0; $rp_kp =0;	
	while ($dat7 = mysqli_fetch_array($qdat7)){
		if($dat7['lunas'] == 'lunas'){
			$lunas++;
			$rp_ln = $rp_ln + $dat7['harga_lama'];
		}else if($dat7['lunas'] == 'keep'){
			$keep++;
			$rp_kp = $rp_kp + $dat7['harga_lama'];
		}else{
			$tawar++;
		}
		
		if($dat7['lunas'] == "keep"){
			$klse = "info";		
			$tnd ="_";
		}else if($dat7['lunas'] == "lunas"){
			$klse ="success";
			$tnd="*";
		}else{
			$klse ="warning";
			$tnd='';
		}
		
		$wa_r =$wa_r.' '.$dat7['pemilik'].' | https://showroomqurban.com/after.php?q='.$dat7['id_hwn'].' &#13;&#10;';
		
	}	
	
echo '<div class="form-group">
                                            
                                            <textarea class="form-control" rows="45">'.$wa_r.'</textarea>
                                        </div>';
										
?>