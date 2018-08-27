<div class="main main-raised">
  <div class="section">
    <div class="container">
      <?php echo $pesan; 
	  
		
		$qryTersedia = mysqli_query($con,"select count(id_hwn) from hewan where lunas is null");
		$tersedia = mysqli_fetch_row($qryTersedia);

		$qryLunas = mysqli_query($con,"select count(id_hwn) from hewan where lunas='lunas'");
		$lunas = mysqli_fetch_row($qryLunas);

		$qryPesan = mysqli_query($con,"select count(id_hwn) from hewan where lunas='keep'");
		$pesan = mysqli_fetch_row($qryPesan);
		
	  ?>
      <h2 class="section-title">Hewan Qurban</h2>
      <div class="row">

        <?php
        $qdg = mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `lunas` IS NULL AND `kategori` = 'DG' ORDER BY `hewan`.`no` ASC");
        $kdg = mysqli_fetch_array($qdg);
        echo panelk($kdg, $db, $tambaht, $kand, $con); ?>

        <?php //kostum utk DG semua
        $qdg1 = mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `lunas` IS NULL AND `kategori` = 'DG' ORDER BY `hewan`.`no` ASC LIMIT 2,1");
        $kdg1 = mysqli_fetch_array($qdg1);
        echo panelk($kdg1, $db, $tambaht, $kand, $con); ?>

        <?php
        $qdg2 = mysqli_query($con,"SELECT * FROM `$db`.`hewan` WHERE `lunas` IS NULL AND `kategori` = 'DG' ORDER BY `hewan`.`no` ASC LIMIT 3,1");
        $kdg2 = mysqli_fetch_array($qdg2);
        echo panelk($kdg2, $db,$tambaht, $kand, $con); ?>
<div class="col-lg-6 col-xs-6">
							  <div class="small-box" style="background-color:#008400; color:#FFFFFF">
								<div class="inner" style="text-align:center">
								<h3>
									<?php if (isset($tersedia[0])) {
									  echo $tersedia[0];
									} else {
									  echo "0";
									}
									?>
									<sup style="font-size: 18px"> Hewan </sup>
								</h3>
								</div>
								<div class="small-box-footer">
								   masih tersedia
								</div>
							  </div>
							</div>
							<div class="col-lg-6 col-xs-6">
							  <div class="small-box" style="background-color:#c40001; color:#FFFFFF">
								<div class="inner" style="text-align:center">
								<h3>
									<?php if (isset($lunas[0])) {
									  echo $lunas[0];
									} else {
									  echo "0";
									}
									?>
									<sup style="font-size: 18px"> Hewan </sup>
								</h3>
								</div>
								<div class="small-box-footer">
								  sudah terjual
								</div>
							  </div>
							</div>
								<div class="col-md-4 col-md-offset-4 col-xs-8 col-xs-offset-2">
        <div class="togglebutton">
		<p> Apakah anda sedang mencari Kendaraan Akherat? Gunakan fiter untuk menemukan kendaraan akherat terbaik </p>
          <label>Filter
            <input <?php echo isset($_GET['mode']) && $_GET['mode']=='filtering'?'checked':''; ?> id="toggleFilt" type="checkbox"> 
          </label>
		  
        </div>

        <div id="formFilt" <?php echo isset($_GET['mode']) && $_GET['mode']=='filtering'?'':'style="display:none;"'; ?>  class="col-md-9">

          <!-- filtering form -->
            <form id="filteringForm"  onsubmit="mainFilter();" action="index.php?" method="get">

              <input type="hidden" name="mode" value="filtering">

              <div class="form-group">
                <label>Kategori</label>
                <select id="kategoriFilt" xonchange="mainFilter();" class="form-control" name="kategori">
                  <option value="">Semua</option>
                  <option <?php echo isset($_GET['kategori']) && $_GET['kategori']=='DG'?'selected':''; ?> value="DG">Domba Gemuk</option>
                  <option <?php echo isset($_GET['kategori']) && $_GET['kategori']=='DT'?'selected':''; ?> value="DT">Domba Tanduk</option>
                  <option <?php echo isset($_GET['kategori']) && $_GET['kategori']=='K'?'selected':''; ?> value="K">Kambing</option>
                </select>
              </div>


              <div class="form-group">
                <label>Status</label>
                <select id="lunasFilt" xonchange="mainFilter();" class="form-control" name="lunas">
                  <option value="">Semua</option>
                  <option <?php echo isset($_GET['lunas']) && $_GET['lunas']=='0'?'selected':''; ?> value="0">Tersedia</option>
                  <option <?php echo isset($_GET['lunas']) && $_GET['lunas']=='1'?'selected':''; ?> value="1">Terjual</option>
                </select>
              </div>

              <!-- <div class="form-group">
                <label>Berat</label>
                <div id="beratFilt" name="beratFilt" class="slider slider-info"></div>
              </div> -->

              <div class="form-group" data-role="rangeslider">
                <label>Harga</label>
                <input type="text" id="hargaFilt" name="harga_lama" value="" />
              </div>

              <div class="form-group" data-role="rangeslider">
                <label>Berat</label>
                <input type="text" id="beratFilt" name="berat" value="" />
              </div>

              <!-- <div class="form-group" data-role="rangeslider">
                <label for="price-min">Price:</label>
                  <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
                <label for="price-max">Price:</label>
                  <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
              </div> -->

              <!-- <div class="form-group">
                <label>Harga</label>
                <div id="hargaFilt" name="harga" class="slider slider-info"></div>
              </div> -->
              <div class="form-group">
                <label>Sort</label>
                <select id="sortFilt" xonchange="mainFilter();" class="form-control" name="sorting">
                  <option value="">Semua</option>
                  <option <?php echo isset($_GET['sorting']) && $_GET['sorting']=='minHarga'?'selected':''; ?> value="minHarga">Termurah</option>
                  <option <?php echo isset($_GET['sorting']) && $_GET['sorting']=='maxHarga'?'selected':''; ?> value="maxHarga">Termahal</option>
                  <option <?php echo isset($_GET['sorting']) && $_GET['sorting']=='minBerat'?'selected':''; ?> value="minBerat">Bobot Terringan</option>
                  <option <?php echo isset($_GET['sorting']) && $_GET['sorting']=='maxBerat'?'selected':''; ?> value="maxBerat">Bobot Terberat</option>
                </select>
              </div>

              <input class="btn btn-info" type="submit" name="" value="OK">
            </form> <!-- end of : filtering form -->

          </div>
</div>
      </div>
    </div>
  </div><!-- section -->
  
  	
		
  <div class="section">
    <div class="container">
      <h2 class="section-title">Stok Kami</h2>

      <div class="row">

          <div class="col-md-9">

          <!-- display hewan  -->
            <div class="row">
              <?php echo $halis ;?>

              <div class="col-md-8 col-md-offset-2">
                <?php echo $pegi;?>
              </div>
            </div>

        </div>

        <?php
          $listhe  = '';
          $sqll    = "SELECT `harga_lama`,`id_hwn`,`berat`,`kategori`
                      FROM `$db`.`hewan`
                      WHERE `lunas` IS NULL
                      ORDER BY `hewan`.`no` ASC";
          $sqll    = mysqli_query($con,$sqll);

          while($listh = mysqli_fetch_assoc($sqll)){
            $katl = $listh['kategori'].'-'.$listh['id_hwn'];
            $berll= $listh['berat'];

            $listn ='
                <tr>
                  <td class="text-info">Rp '.number_format($listh['harga_lama'],0).'</td>
                  <td>'.$berll.'</td>
                  <td class="td-actions">
                    <a href="https://showroomqurban.com/?q='.$listh['id_hwn'].$tambaht.'" rel="tooltip" class="btn btn-info">
                      <i class="material-icons">camera_alt</i>
                    </a> '.$katl.'
                  </td>
                </tr>
                ';
            $listhe = $listhe.$listn;
          }
        ?>

        <div class="col-md-3">
          <h6>PROMO HARI INI</h6>
          <div class="alert alert-info">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>

              <b>Berat</b> adalah kg awal masuk
              </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center">HARGA</th>
                  <th>KG*</th>
                  <th>HEWAN</th>
                </tr>
              </thead>
              <tbody>
                <?php echo $listhe;?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

  </div><!-- section -->

</div> <!-- end-main-raised -->
