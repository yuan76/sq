<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Komisi</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
		<div class="col-lg-12">

    <?php
      // get kupon by reseller (current user login)
      $sKupon = 'select kupon,username,nama
                  from akses
                  where password ="'.$_SESSION['otoritas'].'"';
      $eKupon = mysqli_query($con,$sKupon);
      $rKupon = mysqli_fetch_assoc($eKupon);
   
    // get list - pembeli (yg menggunakan kupon reseller )
      $sPembeli = 'select * from hewan
                  where showroom_view="'.$rKupon['nama'].'" and lunas="lunas"';
      $ePembeli = mysqli_query($con,$sPembeli);
      $nPembeli = mysqli_num_rows($ePembeli);
    ?>

      <!-- <div class="row"> -->
		<h4 class="col-lg-6">Nama Pemilik : <?php echo $rKupon['nama'];?></h4>        
        <h4 class="col-lg-6 text-right">
          Total : <?php echo $nPembeli; ?>
		<h4 class="col-lg-6">Kupon : <?php echo $rKupon['kupon'];?></h4>
          <!-- <span>@125k</span> -->
        </h4>
      <!-- </div> -->
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>Kode Hewan</th>
            <th>Pemilik</th>
            <th>Harga Lama</th>
            <th>Harga Baru</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if ($nPembeli<=0) {
          echo '<tr><td style="color:red;" class="text-center" colspan="4">kosong</td></tr>';
        } else {
          while ($rPembeli=mysqli_fetch_assoc($ePembeli)) {
            echo '<tr>
              <td>'.$rPembeli['kategori'].'-'.$rPembeli['id_hwn'].'</td>
              <td>'.$rPembeli['pemilik'].'</td>
              <td>Rp. '.number_format($rPembeli['harga_lama']).'</td>
              <td>Rp. '.number_format($rPembeli['harga_baru']).'</td>
            </tr>';
          }
        }
        ?>
        </tbody>
      <table>
      <h3>
        Total Komisi :
        <?php 
		if ($nPembeli >= 13){
            $totalKomisi = $nPembeli*200000;
        } else if ($nPembeli >= 10) {
          $totalKomisi = $nPembeli*175000;
        } else if ($nPembeli >= 7) {
          $totalKomisi = $nPembeli*150000;
        } else if ($nPembeli >= 4) {
          $totalKomisi = $nPembeli*125000;
        } else if ($nPembeli >= 1) {
          $totalKomisi = $nPembeli*100000;
        } 
		?>
        <span class="label label-success">
          <?php echo 'Rp '.number_format($totalKomisi);?>
        </span>
      </h3>
      <!-- get list - pembeli (yg menggunakan kupon reseller ) -->

    </div>
  </div>
</div>


<!-- <table xid="komisiTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>nama</th>
            <th>username</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>nama</th>
            <th>username</th>
            <th>Harga</th>
        </tr>
    </tfoot>
</table> -->
