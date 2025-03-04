<?php 
    session_start();
    include 'koneksi.php';
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
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Checkout <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </section>
    <?php
            $ambil = $koneksi->query("SELECT * FROM penjualan JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan JOIN ongkir ON penjualan.id_ongkir=ongkir.id_ongkir WHERE penjualan.id_penjualan='$_GET[id]'");
            $detail = $ambil->fetch_assoc();

            $total_pembelian = $detail['total_beli'];


            ?>

            <!-- Jika pelanggan yg beli tidak sama dengan pelanggan yang login, maka akan dilarikan ke riwayat.php karena dia tidak berhak melihat nota oranglain -->
            <!-- pelanggan yang beli harus pelanggan yang login-->
            <?php 
                // mendapatkan id pelanggan yang beli
                $idpelangganyangbeli = $detail['id_pelanggan'];

                // mendapatkan id pelanggan yang login
                $idpelangganyanglogin = $_SESSION['pelanggan']['id_pelanggan'];
                if($idpelangganyangbeli !== $idpelangganyanglogin){
                    echo "<script>location='riwayat.php';</script>";
                }
            ?>
    <div class="container my-5">
    <h2 class="text-center mb-4">Detail Pembelian</h2>
    <div class="card shadow">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Informasi Pembelian</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="fw-bold">Pembelian</h5>
                    <p><strong>No. Pembelian:</strong> <?= $detail['id_penjualan']; ?></p>
                    <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($detail['tanggal_penjualan'])); ?></p>
                    <!-- <p><strong>Total:</strong> Rp. <?= number_format($total_pembelian); ?></p> -->
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Pelanggan</h5>
                    <p><strong>Nama:</strong> <?= $detail['nama_pelanggan']; ?></p>
                    <p><strong>Telepon:</strong> <?= $detail['telepon_pelanggan']; ?></p>
                    <p><strong>Email:</strong> <?= $detail['email_pelanggan']; ?></p>
                </div>
                <!-- <div class="col-md-4">
                    <h5 class="fw-bold">Pengiriman</h5>
                    <p><strong>Kurir:</strong> <?= $detail['kurir']; ?></p>
                    <p><strong>Ongkos Kirim:</strong> Rp. <?= number_format($detail['tarif']); ?></p>
                    <p><strong>Alamat:</strong> <?= $detail['alamat_pengiriman']; ?></p>
                </div> -->
            </div>
            <h5 class="fw-bold">Rincian Pembelian</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">Plat Nomor</th>
                        <th class="text-center">Jenis Mobil</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Diskon</th>
                        <th class="text-center">Harga Setelah Diskon</th>
                        <th class="text-center">Ongkir</th>
                        <th class="text-center">Total Pembelian</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM penjualan INNER JOIN produk ON penjualan.id_produk=produk.id_produk  INNER JOIN detail_produk ON penjualan.id_produk=detail_produk.id_produk INNER JOIN ongkir ON penjualan.id_ongkir=ongkir.id_ongkir WHERE penjualan.id_penjualan='$_GET[id]'"); ?>
                    <?php while ($pecah = $ambil->fetch_assoc()) {
                        $metode_bayar = $pecah['metode_bayar'];
                        $total = $pecah['harga_telah_diskon'] + $pecah['tarif'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $pecah['no_plat']; ?></td>
                            <td class="text-center"><?= $pecah['nama_mobil']; ?></td>
                            <td class="text-center">Rp. <?= number_format($pecah['harga']); ?></td>
                            <td class="text-center"><?= $pecah['diskon']; ?>%</td>
                            <td class="text-center">Rp. <?= number_format($pecah['harga_telah_diskon']); ?></td>
                            <td class="text-center">Rp. <?= number_format($pecah['tarif']); ?></td>
                            <td class="text-center">Rp. <?= number_format($total); ?></td>
                            
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
                
            </table>
           
            <?php if($detail['status_penjualan'] == 'Pending') { ?>
            <div class="alert alert-info mt-4">
               
                <p class="mb-0">
                    <strong>Silakan lakukan pembayaran sebesar Rp. <?= number_format($total); ?>  </strong> ke rekening berikut:
                </p>
                <p class="mt-2"><strong>BANK MANDIRI 277 - 3726837 - 63787 AN. SHOWROOM RAFFA MOTOR</strong></p>
                
            </div>
            <?php } ?>
        </div>
    </div>
</div>

    
      
        
<?php include 'footer.php'; ?>


  <!-- loader -->



  </body>
</html>