<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<?php 
	include "koneksi.php";
	//baca tabel status untuk mode absensi
	$sql = mysqli_query($konek, "select * from status");
	$data = mysqli_fetch_array($sql);
	$mode_absen = $data['mode'];

	//uji mode absen
	$mode = "";
	if($mode_absen==1)
		$mode = "Masuk";
	else if($mode_absen==2)
		$mode = "Istirahat";
	else if($mode_absen==3)
		$mode = "Kembali";
	else if($mode_absen==4)
		$mode = "Pulang";


	//baca tabel tmprfid
	$baca_kartu = mysqli_query($konek, "select * from tmprfid");
	$data_kartu = mysqli_fetch_array($baca_kartu);
	$nokartu    = $data_kartu['nokartu'];
?>


<div class="container-fluid" style="text-align: center;">
	<?php if($nokartu=="") { ?>

	 
	<h1 class="animate__animated animate__fadeInDown">Tempelkan Kartu Siswa Anda</h1>
	<img src="" style="width: 200px"> <br>
	<img src="images/animasi2.gif">

	<?php } else {
		//cek nomor kartu RFID tersebut apakah terdaftar di tabel karyawan
		$cari_karyawan = mysqli_query($konek, "select * from karyawan where nokartu='$nokartu'");
		$jumlah_data = mysqli_num_rows($cari_karyawan);

		if($jumlah_data==0)
			echo "<h1>Maaf! Kartu Tidak Dikenali</h1>";
		else
		{
			//ambil nama karyawan
			$data_karyawan = mysqli_fetch_array($cari_karyawan);
			$nama = $data_karyawan['nama'];
			$alamat = $data_karyawan['alamat'];

			//tanggal dan jam hari ini
			date_default_timezone_set('Asia/Jakarta') ;
			$tanggal = date('Y-m-d');
			$jam     = date('H:i:s');

			//cek di tabel absensi, apakah nomor kartu tersebut sudah ada sesuai tanggal saat ini. Apabila belum ada, maka dianggap absen masuk, tapi kalau sudah ada, maka update data sesuai mode absensi
			$cari_absen = mysqli_query($konek, "select * from absensi where nokartu='$nokartu' and tanggal='$tanggal'");
			//hitung jumlah datanya
			$jumlah_absen = mysqli_num_rows($cari_absen);
			if($jumlah_absen == 0)
			{
				echo "<h1>Selamat Datang <br> $nama <br> $alamat <br> Semangat Untuk Melakukan Perubahan Hari Ini.. !!</h1>";
				mysqli_query($konek, "insert into absensi(nokartu, tanggal, jam_masuk)values('$nokartu', '$tanggal', '$jam')");
			}
			else
			{
				//update sesuai pilihan mode absen
				if($mode_absen == 2)
				{
					echo "<h1>Selamat Istirahat <br> $nama</h1>";
					mysqli_query($konek, "update absensi set jam_istirahat='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");
				}
				else if($mode_absen == 3)
				{
					echo "<h1>Selamat Datang Kembali <br> $nama</h1>";
					mysqli_query($konek, "update absensi set jam_kembali='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");
				}
				else if($mode_absen == 4)
				{
					echo "<h1>Hati-Hati Di Jalan<br>$nama <br> $alamat</span> <br>Tetap Semangat Untuk Esok Hari Yang Lebih Baik Lagi </h1>";
					mysqli_query($konek, "update absensi set jam_pulang='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");
				}
			}
		}

		//kosongkan tabel tmprfid
		mysqli_query($konek, "delete from tmprfid");
	} ?>

</div>