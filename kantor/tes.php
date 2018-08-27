<?php
include "koneksi.php";
$kupon="kosong";
if ($kupon == "kosong"){
			$kupon = "kosong";
			$nilaiKup = 0;			
		} else {			
			$cekKupon = mysqli_query($con, "select * from `akses` where `kupon`='$kupon'");
			if (mysqli_num_rows($cekKupon) > 0) {
				while($data=mysqli_fetch_assoc($cekKupon)){
					$nilaiKup=$data['rp_kupon'];
				}
			} else {
				$kupon = "kosong";
				$nilaiKup = 0;
			}
		}
echo "kupon ".$kupon." ".$nilaiKup;		
?>