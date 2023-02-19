<!DOCTYPE html>
<html>
<head>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Absen SIswa Berbasis IOT</title>
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
	
	<title>Data Siswa</title>
</head>
<body>

	
 <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">SMK Negeri 15 kota bekasi</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active">Halaman Awal</a></li>
          <li><a href="datakaryawan.php">Data Siswa</a></li>
          <li><a href="absensi.php">Rekap Absen</a></li>
          <li><a href="scan.php">Scan Kartu</a></li>
          </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <br>
  <br>
  <br>
  <br>
   <br>
  <br>

	<!--isi -->
	<div class="container-fluid">
		<h3>Data Siswa</h3>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: grey; color: white;">
					<th style="width: 10px; text-align: center">No.</th>
					<th style="width: 200px; text-align: center">No.Kartu</th>
					<th style="width: 400px; text-align: center">Nama</th>
					<th style="width: 400px; text-align: center">Kelas</th>
					<th style="width: 100px; text-align: center">Aksi</th>
				</tr>
			</thead>
			<tbody>

				<?php
					//koneksi ke database
					include "koneksi.php";

					//baca data karyawan
					$sql = mysqli_query($konek, "select * from karyawan");
					$no = 0;
					while($data = mysqli_fetch_array($sql))
					{
						$no++;
				?>

				<tr>
					<td> <?php echo $no; ?> </td>
					<td> <?php echo $data['nokartu']; ?> </td>
					<td> <?php echo $data['nama']; ?> </td>
					<td> <?php echo $data['alamat']; ?> </td>
					<td>
						<a href="edit.php?id=<?php echo $data['id']; ?>"> Edit</a> | <a href="hapus.php?id=<?php echo $data['id']; ?>"> Hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<!-- tombol tambah data karyawan -->
		<a href="tambah.php"> <button class="btn btn-primary">Tambah Data Siswa</button> </a>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>