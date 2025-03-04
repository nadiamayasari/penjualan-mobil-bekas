<?php 
    session_start();

    // echo "<pre></pre>";
    // print_r($_SESSION['keranjang']);
    // echo "</pre>";

    include 'koneksi.php';
    $id_pelanggan = null;
    if(isset($_SESSION['pelanggan'])) {
        
        $id_pelanggan  = $_SESSION['pelanggan']['id_pelanggan'];
    }

    $keranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
    $cekdata = $keranjang->num_rows;


    // $dataBarang = [];
    // while ($detail = mysqli_fetch_array($keranjang)) {
    //     $dataBarang[] = $detail;
    // }

    if($cekdata <= 0){
        echo "<script>alert('Keranjang kosong, silahkan pilih produk dahulu');</script>";
        echo "<script>location='index.php';</script>";
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
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Keranjang <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Keranjang</h1>
          </div>
        </div>
      </div>
    </section>
    
    <div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-success ">
            <h2 class="mb-0 text-center text-white">Mobil Yang Dipilih</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-success text-white">
                    <tr class="text-center">
                        <!-- <th>No</th> -->
                        <th>Plat Nomor</th>
                        <th>Jenis Mobil</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Harga Setelah Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                                    <?php 
                        $nomor = 1;
                        $dataKeranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");

                        while ($pecahKeranjang = mysqli_fetch_array($dataKeranjang)) { 
                            // Mengambil data produk berdasarkan id_produk
                            $id_produk = $pecahKeranjang['id_produk'];
                            $ambil = $koneksi->query("SELECT * FROM produk INNER JOIN detail_produk ON produk.id_produk = detail_produk.id_produk WHERE produk.id_produk='$id_produk'");
                            $pecahProduk = $ambil->fetch_assoc();
                    ?> 
                            <tr class="text-center">
                                <!-- <td><?= $nomor; ?></td> -->
                                <td><?= $pecahProduk['no_plat']; ?></td>
                                <td><?= $pecahProduk['nama_mobil']; ?></td>
                                <td>Rp.<?= number_format($pecahProduk['harga']); ?></td>
                                <td><?= $pecahProduk['diskon']  ?>%</td>
                                <td>Rp.<?= number_format($pecahProduk['harga_telah_diskon']); ?></td>
                                <td>
                                    <a href="hapuskeranjang.php?id=<?= $pecahKeranjang['id_produk'] ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                    <?php 
                            $nomor++; 
                        } 
                    ?>

                   
                       
                       
                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-primary">
                    <i class="bi bi-cart-plus"></i> Lanjutkan Belanja
                </a>
                <a href="checkout.php" class="btn btn-success">
                    <i class="bi bi-bag-check"></i> Checkout
                </a>
            </div>
        </div>
    </div>
</div>


    <?php include 'footer.php'; ?>
    
  </body>
</html>