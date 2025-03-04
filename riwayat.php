<?php 
    session_start();
    include 'koneksi.php';

    // jika belum login tidak bisa masuk ke riwayat
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>location='login.php';</script>";
        exit();
    }
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $semuadata = array();
    $tanggal = "-";
    
    if (isset($_POST['kirim'])) {
        $tanggal = $_POST['tanggal'];
        $ambil = $koneksi->query("SELECT penjualan.*, produk.*, detail_produk.*, ongkir.*, pembayaran.resi_pengiriman FROM penjualan  LEFT JOIN produk ON penjualan.id_produk = produk.id_produk LEFT JOIN detail_produk ON produk.id_produk = detail_produk.id_produk LEFT JOIN ongkir ON penjualan.id_ongkir = ongkir.id_ongkir LEFT JOIN pembayaran ON penjualan.id_penjualan = pembayaran.id_penjualan WHERE penjualan.id_pelanggan='$id_pelanggan' AND penjualan.tanggal_penjualan='$tanggal'");
        while ($pecah = $ambil->fetch_assoc()) {
            $semuadata[] = $pecah;
        }
    } else {
        $ambil = $koneksi->query("SELECT * FROM penjualan LEFT JOIN produk ON penjualan.id_produk = produk.id_produk LEFT JOIN detail_produk ON produk.id_produk = detail_produk.id_produk LEFT JOIN ongkir ON penjualan.id_ongkir = ongkir.id_ongkir LEFT JOIN pembayaran ON penjualan.id_penjualan = pembayaran.id_penjualan WHERE penjualan.id_pelanggan='$id_pelanggan'");
        while ($pecah = $ambil->fetch_assoc()) {
            $semuadata[] = $pecah;
        }
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Riwayat Belanja <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Riwayat Belanja</h1>
          </div>
        </div>
      </div>
    </section>

        
    <div class="container my-5">

    <div class="card shadow">
    <div class="card-header bg-success">
        <h3 class="mb-0 text-white">Riwayat Pembelian <?= $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
    </div>
    <form action="" method="post">
        <div class="row mb-3">
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="tanggal">Pilih Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $tanggal; ?>">
                </div>
            </div>
            <div class="col-md-1">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-primary" name="kirim">Cari</button>
            </div>
            <div class="col-md-2">
                <label for="">&nbsp;</label><br>
                <a href="cetak_riwayat.php?tanggal=<?= isset($_POST['tanggal']) ? $_POST['tanggal'] : ''; ?>" class="btn btn-primary" target="_blank">Cetak</a>
            </div>
        </div>
    </form>

    <div class="card-body">
        <table class="table table-hover table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                <th class="text-center">Plat Nomor</th>
                        <th class="text-center">Jenis Mobil</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Diskon</th>
                        <th class="text-center">Harga Telah Diskon</th>
                        <th class="text-center">Ongkir</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal Pembelian</th>
                        <th class="text-center">Total Pembelian</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                foreach ($semuadata as $pecah) : ?>

                <?php $total =  $pecah['total_beli']; ?>
                    <tr>
                        <td><?= $pecah['no_plat']; ?></td>
                        <td><?= $pecah['nama_mobil']; ?></td>
                        <td><?=number_format($pecah['harga']); ?></td>
                        <td><?= $pecah['diskon']; ?>%</td>
                        <td><?= number_format($pecah['harga_telah_diskon']); ?></td>
                        <td><?= number_format($pecah['tarif']); ?></td>
                        <td>
                            <span class="badge <?= $pecah['status_penjualan'] == 'Pending' ? 'bg-warning text-dark' : 'bg-success'; ?>">
                                <?= $pecah['status_penjualan']; ?>
                            </span>
                            <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                <div class="text-muted mt-1">Resi: <?= $pecah['resi_pengiriman']; ?></div>
                            <?php endif; ?>
                        </td>
                        <td><?= date("d M Y", strtotime($pecah['tanggal_penjualan'])); ?></td>
                   
                        <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
                        <td>
                            <a href="nota.php?id=<?= $pecah['id_penjualan']; ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-file-earmark-text"></i> Nota
                            </a>
                            <?php if ($pecah['status_penjualan'] == 'Pending') : ?>
                                <a href="pembayaran.php?id=<?= $pecah['id_penjualan']; ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-cash"></i> Konfirmasi
                                </a>
                            <?php else : ?>
                                <a href="lihat_pembayaran.php?id=<?= $pecah['id_penjualan']; ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-eye"></i> Lihat Pembayaran
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>


    <?php include 'footer.php'; ?>

</body>
</html>