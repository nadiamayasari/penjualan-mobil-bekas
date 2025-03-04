<?php 
    session_start();
    include 'koneksi.php';

    $id_penjualan = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN penjualan ON pembayaran.id_penjualan = penjualan.id_penjualan INNER JOIN ongkir ON penjualan.id_ongkir = ongkir.id_ongkir WHERE penjualan.id_penjualan='$id_penjualan'");
    $detbay = $ambil->fetch_assoc();

    // jika data pembayaran masih kosong
    if(empty($detbay)){
        echo "<script>alert('Silahkan Konfirmasi Pembayaran anda');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }

    // tidak bisa melihat data pembayaran pelanggan lain
    if($_SESSION['pelanggan']['id_pelanggan'] !== $detbay['id_pelanggan']){
        echo "<script>location='riwayat.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Raffa Motor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="frontend/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/animate.css">
    
    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="frontend/css/magnific-popup.css">

    <link rel="stylesheet" href="frontend/css/aos.css">

    <link rel="stylesheet" href="frontend/css/ionicons.min.css">

    <link rel="stylesheet" href="frontend/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="frontend/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="frontend/css/flaticon.css">
    <link rel="stylesheet" href="frontend/css/icomoon.css">
    <link rel="stylesheet" href="frontend/css/style.css">
  </head>
  <body>
  <?php include 'navbar.php'; ?>
   
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pembayaran <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Pembayaran</h1>
          </div>
        </div>
      </div>
    </section>


    <div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-success ">
            <h3 class="mb-0 text-center text-white">Data Pembayaran</h3>
        </div>
        <div class="card-body">
            <!-- Data Pembayaran -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light">Nama</th>
                            <td class="text-center"><?= $detbay['nama']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Bank</th>
                            <td class="text-center"><?= $detbay['bank']; ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal</th>
                            <td class="text-center"><?= date('d M Y', strtotime($detbay['tanggal_penjualan'])); ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Jumlah</th>
                            <td class="text-center">Rp. <?= number_format($detbay['total_beli']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Gambar Bukti Pembayaran -->
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <h5 class="mb-3">Bukti Pembayaran</h5>
                    <img src="bukti_pembayaran/<?= $detbay['bukti']; ?>" alt="Bukti Pembayaran" class="img-fluid rounded shadow" style="max-height: 300px;">
                </div>
            </div>
        </div>
    </div>
</div>


    <?php include 'footer.php'; ?>



</body>
</html>