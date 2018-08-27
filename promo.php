<?php
include './kantor/koneksi.php';
$wa_r ='';
$qdat7 = mysqli_query($con,"SELECT `pemilik`,`berat`,`lunas`,`harga_lama`,`showroom_view`,`kategori`,`id_hwn` FROM `$db`.`hewan` where `lunas` IS NULL");
	$rp_ln =0; $rp_kp =0;	
	while ($dat7 = mysqli_fetch_array($qdat7)){
				
		if($dat7['kategori'] == "DT"){
			$nm = "Domba Bertanduk ".$dat7['kategori'].'-'.$dat7['id_hwn'];		
			$tnd ="🐏";
		}else if($dat7['kategori'] == "DG"){
			$nm = "Domba Gemuk ".$dat7['kategori'].'-'.$dat7['id_hwn'];
			$tnd="🐑";
		}else{
			$nm = "Kambing ".$dat7['kategori'].'-'.$dat7['id_hwn'];
			$tnd='🐐';
		}
		
	//	$wa_r =$wa_r.$tnd.$dat7['lunas'].$tnd.' '.$dat7['kategori'].'-'.$dat7['id_hwn'].' |'.$dat7['showroom_view'].' https://showroomqurban.com/?q='.$dat7['id_hwn'].' &#13;&#10;';
		
	$wa_r = $wa_r.$tnd.$nm.' berat awal masuk '.$dat7['berat'].' harga Rp '.number_format($dat7['harga_lama'],0).' https://showroomqurban.com/?q='.$dat7['id_hwn'].'&cq=nisa &#13;&#10;';
	}	
	
echo '<div class="form-group">
                                            
                                            <textarea class="form-control" rows="45">'.$wa_r.'</textarea>
                                        </div>';
										
?>