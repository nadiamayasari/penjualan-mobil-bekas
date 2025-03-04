<?php 
    session_start();
    include 'koneksi.php';

    // jika belum login tidak bisa masuk ke riwayat
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>location='login.php';</script>";
        exit();
    }

    // mendapatkan id pembelian dari url
    $idpem = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM penjualan INNER JOIN ongkir ON penjualan.id_ongkir = ongkir.id_ongkir WHERE id_penjualan='$idpem'");
    $detpem = $ambil->fetch_assoc();
    $metode_bayar = $detpem['metode_bayar'];

    // mendapatkan id_pelanggan yg beli
    $id_pelanggan_beli = $detpem['id_pelanggan'];
    // mendapatkan id_pelanggan yg login
    $id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

    if($id_pelanggan_beli !== $id_pelanggan_login){
        echo "<script>location='riwayat.php';</script>";
        exit();
    }


    $totalbayar =  (int)$detpem['total_beli'];
   


    // echo "<pre>";
    //     print_r($detpem);
    //     print_r($_SESSION);
    
    // echo "</pre>";
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
        <div class="card-header bg-success">
            <h2 class="mb-0 text-white">Konfirmasi Pembayaran</h2>
        </div>
        <div class="card-body">
            <p class="text-muted">Silakan kirim bukti pembayaran Anda melalui form di bawah ini.</p>
            <div class="alert alert-info">
                <strong>Total Tagihan Anda:</strong> Rp. <?= number_format($totalbayar); ?>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pembayar:</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank:</label>
                    <input type="text" class="form-control" name="bank" id="bank" placeholder="Masukkan nama bank" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah:</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= $totalbayar; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="bukti" class="form-label">Foto Bukti:</label>
                    <input type="file" class="form-control" name="bukti" id="bukti" required>
                    <small class="text-danger">* Pastikan foto bukti pembayaran jelas dan terlihat dengan baik.</small>
                </div>
                <button type="submit" class="btn btn-success w-100" name="kirim">
                    <i class="bi bi-send"></i> Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>


    <?php 
        // jika tombol kirim ditekan
        if(isset($_POST['kirim'])){
            $namabukti = $_FILES['bukti']['name'];
            $lokasibukti = $_FILES['bukti']['tmp_name'];
            $namafiks = date("YmdHis").$namabukti;
            move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

            $nama = $_POST['nama'];
            $bank = $_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date("Y-m-d");

            // simpan pembayaran
            $koneksi->query("INSERT INTO pembayaran(id_penjualan,nama,bank,jumlah_transfer,tanggal_pembayaran,bukti) VALUES('$idpem','$nama','$bank','$totalbayar','$tanggal','$namafiks')");
            // update status pembayaran
            $koneksi->query("UPDATE penjualan SET status_penjualan = 'Dibayar' WHERE id_penjualan='$idpem'");

            echo "<script>alert('Bukti telah dikirim ke admin');</script>";
            echo "<script>location='riwayat.php';</script>";
        }
    ?>

    <?php include 'footer.php'; ?>

</body>
</html>