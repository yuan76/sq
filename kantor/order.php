<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Proses Order </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			<div class="col-lg-4">
<?php
$sesi1 = 'merem2';
$hwn =276;
    $q1         = mysqli_query($con,"SELECT `updated`,`showroom_view`,`lunas`,`pemilik`,`alamat`,`tgl_sold`,`no`,NOW() as `wkt` FROM `qurban`.`hewan` where `id_hwn`='$hwn'");
    $liat       = mysqli_fetch_array($q1);
    $format     = "Y-m-d H:i:s A";
    
	
	$timestamp  = strtotime($liat['updated']);
    $difference = $timestamp - strtotime($liat['wkt']);
   /*if ($difference < 0) {
        if (is_null($liat['lunas'])) {
        //    mysql_query("UPDATE `qurban`.`hewan` SET `updated` = DATE_ADD(now(), INTERVAL 5 MINUTE) WHERE `hewan`.`id_hwn` = '$hwn'");
            $dpt['dtk'] = 300;
        //    mysql_query("UPDATE `qurban`.`hewan` SET `showroom_view` = '$sesi1' WHERE `hewan`.`id_hwn` = '$hwn'");
            $dpt['lunas'] = "kacau";
        } else {
            $dpt['lunas'] = $liat['lunas'];
        }
        $dpt['nm'] = $sesi1;
    } else {
        $dpt['dtk']   = $difference;
        $dpt['nm']    = $liat['showroom_view'];
        $dpt['lunas'] = $liat['lunas'];
    }
    $dpt['pml']  = $liat['pemilik'];
    $dpt['alm']  = $liat['alamat'];
    $dpt['sold'] = $liat['tgl_sold'];
	*/
	echo date("Y-m-d H:i A",strtotime($liat['updated'])+3600).'=='.$timestamp.'=='.$liat['updated'].'=='.$liat['wkt'].'</br>'.$timestamp/60;
	
//print_r($dpt);

?>
</div>
</div>
</div>