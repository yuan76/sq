<?php 
include './kantor/koneksi.php';
$id = $_GET['q'];
$qdat7 = mysqli_query($con,"SELECT * FROM `$db`.`hewan` where `id_hwn` ='$id'");
$dat7 = mysqli_fetch_array($qdat7);

$rp =number_format($dat7['harga_lama'],0);
if($dat7['kategori'] == "DT"){
			$nm = "Domba Bertanduk ".$dat7['kategori'].'-'.$dat7['id_hwn'];		
			
		}else if($dat7['kategori'] == "DG"){
			$nm = "Domba Gemuk ".$dat7['kategori'].'-'.$dat7['id_hwn'];
			
		}else{
			$nm = "Kambing ".$dat7['kategori'].'-'.$dat7['id_hwn'];
			
		}
$alamat = $dat7['alamat'];		$pemilik=$dat7['pemilik'];
$tgl_masuk = $dat7['tgl_masuk']; $tgl_sold = $dat7['tgl_sold'];

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Surat Jalan ShowroomQurban</title>
    <style media="screen">
        body {
            font-family: 'Segoe UI','Microsoft Sans Serif',sans-serif;
        }

        /*
            These next two styles are apparently the modern way to clear a float. This allows the logo
            and the word "Invoice" to remain above the From and To sections. Inserting an empty div
            between them with clear:both also works but is bad style.
            Reference:
            http://stackoverflow.com/questions/490184/what-is-the-best-way-to-clear-the-css-style-float
        */
        header:before, header:after {
            content: " ";
            display: table;
        }

        header:after {
            clear: both;
        }

        .invoiceNbr {
            font-size: 40px;
            margin-right: 30px;
            margin-top: 30px;
            float: right;
        }

        .logo {
            float: left;
        }

        .from {
            float: left;
        }

        .to {
            float: right;
        }

        .fromto {
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5;
            border-radius: 5px;
            margin: 20px;
            min-width: 200px;
        }

        .fromtocontent {
            margin: 10px;
            margin-right: 15px;
        }

        .panel {
            background-color: #e8e5e5;
            padding: 7px;
        }

        .items {
            clear: both;
            display: table;
            padding: 20px;
        }

        /* Factor out common styles for all of the "col-" classes.*/
        div[class^="col-"] {
            display: table-cell;
            padding: 7px;
        }

        /*for clarity name column styles by the percentage of width */
        .col-1-10 {
            width: 10%;
        }

        .col-1-52 {
            width: 52%;
        }

        .row {
            display: table-row;
            page-break-inside: avoid;
        }

    </style>

    <!-- These styles are exactly like the screen styles except they use points (pt) as units
        of measure instead of pixels (px) -->
    <style media="print">
        body {
            font-family: 'Segoe UI','Microsoft Sans Serif',sans-serif;
        }

        header:before, header:after {
            content: " ";
            display: table;
        }

        header:after {
            clear: both;
        }

        .invoiceNbr {
            font-size: 30pt;
            margin-right: 30pt;
            margin-top: 30pt;
            float: right;
        }

        .logo {
            float: left;
        }

        .from {
            float: left;
        }

        .to {
            float: right;
        }

        .fromto {
            border-style: solid;
            border-width: 1pt;
            border-color: #e8e5e5;
            border-radius: 5pt;
            margin: 20pt;
            min-width: 200pt;
        }

        .fromtocontent {
            margin: 10pt;
            margin-right: 15pt;
        }

        .panel {
            background-color: #e8e5e5;
            padding: 7pt;
        }

        .items {
            clear: both;
            display: table;
            padding: 20pt;
        }

        div[class^="col-"] {
            display: table-cell;
            padding: 7pt;
        }

        .col-1-10 {
            width: 10%;
        }

        .col-1-52 {
            width: 52%;
        }

        .row {
            display: table-row;
            page-break-inside: avoid;
        }
    </style>

</head>
<body>
    <header>
        <div class="logo">
           
        </div>
        <div class="invoiceNbr">
            <?php echo $nm ?>
            <br />
           <?php echo 'Rp '.$rp ?>
        </div>
    </header>
<table><tr><td>
    <div class="fromto from">
        <div class="panel">Hewan Masuk: <?php echo $tgl_masuk ?></div>
        <div class="fromtocontent">
            <span>Hewan Terjual :
            <?php echo $tgl_sold ?></span><br />
            <span>Pembayaran* Lunas|DP|</span><br />
			<span>Free biaya pemeliharaan</span><br />
        </div>
    </div>
	</td><td>
    <div class="fromto to">
        <div class="panel"><?php echo $pemilik.' d/a :' ?></div>
        <div class="fromtocontent">
            <span><?php echo $alamat ?></span>
        </div>
    </div>
	</td>
</tr></table>
    <section class="items">

        <!-- your favorite templating/data-binding library would come in handy here to generate these rows dynamically !-->
        <div class="row">
            <div class="col-1-10 panel">
               
            </div>
            <div class="col-1-52 panel">
                Check List
            </div>
            <div class="col-1-52 panel">
                Instruksi
            </div>
        </div>

        <div class="row">
             <div class="col-1-10 panel">
                Ttd Pengantar
            </div>
            <div class="col-1-52">
                <input type="checkbox" name="vehicle" value="Bike"> Hewan Qurban dalam keadaan sehat<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> Tanpa Cacat<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> Hewan Qurban difoto diatas kendaraan<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> Hewan di sediakan rumput di kendaraan<br><br>
            </div>
			<div class="col-1-52">
			 Tempelkan stiker ini di sekitar pintu masuk rumah untuk menjadi customer prioritas kami tahun depan. Anda akan mendapatkan fasilitas FREE ongkir, cashback dan semua fasilitas lain pada Musim Idul Adha tahun depan
           </div>
        </div>
		<hr>
        <div class="row">
             <div class="col-1-10 panel">
                Ttd Penerima
            </div>
            <div class="col-1-52">
                <input type="checkbox" name="vehicle" value="Bike"> Hewan Qurban dalam keadaan sehat<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> Tanpa Cacat<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> FREE Ongkir Tangerang Raya - Jakbar<br><br>
				<input type="checkbox" name="vehicle" value="Bike"> Siap lapor ke 082156411621 jika kurir kurang sopan<br><br>
            </div>
			 <div class="col-1-52">
				Nama Penerima :_________<br><br>
				No HP Penerima:_____________________
				sobek bagian ini dan kembalikan ke showoroomQurban
           </div>
        </div>
        
        <div class="row panel">
		<div class="col-1-10 panel">
               
            </div>
            <div class="col-1-10">
			tanda tangan pengantar
            </div>
            <div class="col-1-52">
			tanda tangan penerima
            </div>
            
        </div>
    </section>
</body>
</html>