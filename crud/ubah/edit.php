<?php
session_start();
if(isset($_SESSION['username'])){
?>

<?php include('../../koneksi/koneksi.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>FORM UBAH DATA</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="icon" href="../../img/logo_bi.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="../../css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="../../css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="../../css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../../css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../../css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="../../index.php"> <img src="../../img/logo_bi.png" alt="logo" width="100" height="100"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>                        
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="../../index.php">Beranda</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="../tampil/tampil.php">Data Alternatif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../..//hitung/hitung.php">Perhitungan ARAS</a>
                                </li>
								<li class="nav-item">
									<a class="nav-link" href="../../logout/logout.php">Logout</a>
								</li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

	<div class="container" style="margin-top:200px">
		<h2>Edit Mahasiswa</h2>
		
		<hr>
		
		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];
			
			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM data_primer WHERE id='$id'") or die(mysqli_error($koneksi));
			
			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak Baik dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>
		
		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$alternatif = $_POST['alternatif'];
			$pembukaan_rekening = $_POST['pembukaan_rekening'];
			$transfer_antar_bank = $_POST['transfer_antar_bank'];
			$transfer_beda_bank = $_POST['transfer_beda_bank'];
			$tabungan= $_POST['tabungan'];
			$pinjaman = $_POST['pinjaman'];
			
			$sql = mysqli_query($koneksi, "INSERT INTO data_primer(id, alternatif, pembukaan_rekening, transfer_antar_bank, transfer_beda_bank, tabungan, pinjaman) VALUES('', '$alternatif', '$pembukaan_rekening', '$transfer_antar_bank', '$transfer_beda_bank', '$tabungan', '$pinjaman')") or die(mysqli_error($koneksi));
			
			$sql = mysqli_query($koneksi, "INSERT INTO data_konversi(id, alternatif, pembukaan_rekening, transfer_antar_bank, transfer_beda_bank, tabungan, pinjaman) VALUES('', '$alternatif', '$pembukaan_rekening', '$transfer_antar_bank', '$transfer_beda_bank', '$tabungan', '$pinjaman')") or die(mysqli_error($koneksi));
				
				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="../tampil/tampil.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				
			}
		
		?>
		
		<form action="tambah.php" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">ALTERNATIF</label>
				<div class="col-sm-10">
					<input type="text" name="alternatif" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">PEMBUKAAN REKENING</label>
				<div class="col-sm-10">
					<input type="text" name="pembukaan_rekening" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TRANSFER ANTAR BANK</label>
				<div class="col-sm-10">
					<input type="text" name="transfer_antar_bank" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TRANSFER BEDA BANK</label>
				<div class="col-sm-10">
					<input type="text" name="transfer_beda_bank" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TABUNGAN(POTONGAN)</label>
				<div class="col-sm-10">
					<input type="text" name="tabungan" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">PINJAMAN(BUNGA)</label>
				<div class="col-sm-10">
					<input type="text" name="pinjaman" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="UBAH">
					<a href="../../crud/tampil/tampil.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>
		
	</div>
	
	
	
</body>
</html>
<?php
}else{
echo "<script language=\"javascript\">alert(\"Silahkan Login Terlebih Dahulu\");document.location.href='../login/index.php';</script>";
}
?>