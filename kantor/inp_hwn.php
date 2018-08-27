
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Hewan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			<div class="col-md-6">	
			<form method ="POST" action="?act=input">
				<div class="form-group">
                                            <label>Kategori</label>
                                            <select class="form-control" name="kat">
                                                <option value="DG">Domba Gemuk</option>
                                                <option value="DT">Domba Tanduk</option>
												<option value="K">Kambing</option>
                                            </select>
                                        </div>
				<div class="form-group input-group">
                    <span class="input-group-addon">ID Hewan</span>
                    <input type="text" id="id" class="form-control" placeholder="hanya angka.." name="id">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">Kandang</span>
                    <select class="form-control" name="ket1">
                    <option value="klp2">Kelapa Dua</option>
                    <option value="legok">Legok</option>
                    <option value="curug">Curug</option>
                    <option value="jogja">Jogja</option>
                    <option value="serang">Serang</option>
                        </select>
                </div>
				<div class="form-group input-group">
                    <span class="input-group-addon">Harga</span>
                    <input type="text" id="rp_aw" class="form-control" placeholder="Rp" name="rp">
					
				</div>
				<div class="form-group input-group">
                    <span class="input-group-addon">Gambar</span>
                    <input type="text" class="form-control" placeholder="Url" name="url">
                </div>
				<div class="form-group input-group">
                    <span class="input-group-addon">Keterangan</span>
                    <input type="text" class="form-control" placeholder="Isi dengan berat kambing" name="ket">
                </div>
				<button type="submit" class="btn btn-info btn-circle btn-xl"><i class="fa fa-check"></i>
                            </button>
			</form>
			</div>
			<div class="col-md-6">
			<form method ="POST" action="?act=input">
			<div class="form-group input-group">
                    <span class="input-group-addon">bulk image</span>
                    <input type="text" class="form-control" placeholder="pisahkan dg koma" name="gbr">
                </div>
			<div class="form-group input-group">
                    <span class="input-group-addon">kode hewan</span>
                    <input type="text" class="form-control" placeholder="Isi tanpa huruf" name="kode">
                </div>	
			<button type="submit" class="btn btn-info btn-circle btn-xl" name="bulk"><i class="fa fa-check"></i>
                            </button>
			</form>
			</div>
			</div>
            <!-- /.row -->
        </div>
<?php
if (isset($_POST['rp'])){
	$rp = $_POST['rp']; $url = $_POST['url']; 
	$kat = $_POST['kat']; $id = $_POST['id']; 
	$ket = $_POST['ket']; $kdg = $_POST['ket1'];
	if($rp != ''){

		mysqli_query($con,"INSERT INTO `hewan` (`no`, `id_hwn`, `tgl_masuk`, `foto`, `pemilik`, `nope`, `prov`, `kab`, `kec`, `ds`, `alamat`, `lunas`, `updated`, `showroom_view`, `dealer_view`, `berat`, `kategori`, `kelamin`, `tgl_sold`, `harga_baru`, `harga_lama`, `harga_disc`, `kupon`, `rp_kupon`, `ket1`, `ket2`) VALUES (NULL, '$id', now(), '$url', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$ket', '$kat', 'LK', NULL, NULL, '$rp', NULL, NULL, NULL, '$kdg', NULL);");
		
		//echo mysqli_error();
	}
//echo mysqli_error();
	}	
if(isset($_POST['bulk'])){
	$gbrbu = $_POST['gbr']; $nohwn = $_POST['kode'];
	$dt_gbu = explode(',',$gbrbu);
	foreach ($dt_gbu as $gbbu) {
		mysqli_query($con,"INSERT INTO `$db`.`datil_hewan` (`no`, `id_hwn`, `foto`, `deskripsi`, `berat`, `tgl`) VALUES (NULL, '$nohwn', '$gbbu', 'no', '10', now())");
	}
}	
?>	
<script>
$('#id').keyup(function () {
		a = $('#rp_aw').val(); b = $(this).val(); c = parseInt(a)+parseInt(b);
         $('#rp_a').val(c);
     });
});
</script>