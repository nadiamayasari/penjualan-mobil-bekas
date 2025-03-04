<?php 
    session_start();
    include 'koneksi.php';

    if(isset($_SESSION['pelanggan'])) {
        
      $id_pelanggan  = $_SESSION['pelanggan']['id_pelanggan'];
    }

    $keranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
    $cekdata = $keranjang->num_rows;

 
    // jika belum login maka akan dilarikan ke login.php
    if(!isset($_SESSION['pelanggan'])) {
        echo "<script>alert('Silahkan login terlebih dahulu');</script>";
        echo "<script>location='login.php';</script>";
    }

    if($cekdata <= 0){
        echo "<script>alert('Silahkan pilih produk terlebih dahulu');</script>";
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
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Raffa<span>Motor</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
            <?php 
              if(isset($_SESSION['pelanggan']) OR !empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
	          <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
            <?php } ?>
	          <li class="nav-item "><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item active"><a href="keranjang.php" class="nav-link">Keranjang</a></li>

            <?php 
              if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <?php } ?>

            <?php 
              if(isset($_SESSION['pelanggan']) OR !empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            <?php } ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
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
    <section class="konten">
        <div class="container">
            <h1>Halaman Checkout</h1>
            <hr>
            <table class="table table-bordered table-striped">
                <thead style="background-color:#5cb85c;">
                    <tr class="text-center">
                        <th align="center">No Plat</th>
                        <th align="center">Jenis Mobil</th>
                        <th align="center">Harga</th>
                        <th align="center">Diskon</th>
                        <th align="center">Harga Telah Diskon</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor =1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php 
                        $dataKeranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");

                        while ($pecahKeranjang = mysqli_fetch_array($dataKeranjang)) { 
                            // Mengambil data produk berdasarkan id_produk
                            $id_produk = $pecahKeranjang['id_produk'];
                            $ambil = $koneksi->query("SELECT * FROM produk INNER JOIN detail_produk ON produk.id_produk = detail_produk.id_produk WHERE produk.id_produk='$id_produk'");
                            $pecahProduk = $ambil->fetch_assoc();
                    ?> 
                     <tr class="text-center">
                                <td><?= $pecahProduk['no_plat']; ?></td>
                                <td><?= $pecahProduk['nama_mobil']; ?></td>
                                <td>Rp. <?= number_format($pecahProduk['harga']); ?></td>
                                <td><?= $pecahProduk['diskon']  ?>%</td>
                                <td>Rp.<?= number_format($pecahProduk['harga_telah_diskon']); ?></td>
                                <!-- <td>
                                    <a href="hapuskeranjang.php?id=<?= $pecahKeranjang['id_produk'] ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td> -->
                            </tr>
                    <?php 
                            $totalbelanja += $pecahProduk['harga_telah_diskon'];
                            $nomor++; 
                        } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th class="text-center">Rp. <?php echo number_format($totalbelanja); ?></th>
                    </tr>
                </tfoot>
            </table>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <select name="id_ongkir" id="" class="form-control" required>
                                <option value="">Pilih Pengiriman</option>
                                <?php 
                                    $ambil = $koneksi->query("SELECT * FROM ongkir ORDER BY id_ongkir");
                                    while($perongkir = $ambil->fetch_assoc()) {
                                ?>
                                <option value="<?= $perongkir['id_ongkir']; ?>"><?= $perongkir['kota']; ?> - Rp. <?= number_format($perongkir['tarif']); ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <select name="jenis_pembayaran" class="form-control" required>
                                <option value="">Pilih Pembayaran</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                         </div>
                        </div>

                        <input type="hidden" id="total_harga" value="<?php echo $totalbelanja; ?>">

                                    </div>
                       <br>
                    <div class="form-group">
                        <label for="">Alamat Lengkap Pengiriman :</label>
                        <textarea name="alamat_pengiriman" id="" cols="30" rows="2" placeholder="Masukkan alamat lengkap pengiriman" class="form-control" required></textarea>
                    </div>
                    <button class="btn btn-success" name="checkout">Checkout</button>
                </form>        
                <?php 
                    if(isset($_POST['checkout'])){
                     
                        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                        $id_ongkir = $_POST['id_ongkir'];
                        $tanggal_penjualan = date("Y-m-d");
                        $alamat_pengiriman = $_POST['alamat_pengiriman'];
                        $jenis_pembayaran = $_POST['jenis_pembayaran'];
                        $diskon = $_POST['diskon'];
                        // $harga_telah_diskon = $_POST['harga_telah_diskon'];

                        $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                        $arrayongkir = $ambil->fetch_assoc();
                        $tarif = $arrayongkir['tarif'];

                        $bayarPerbulan = 0;
                        
                        
                        $dataPembelian = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");

                        while($result = mysqli_fetch_array($dataPembelian)){
                            // mendapatkan data produk berdasarkan id_produk
                            $id_produk = $result['id_produk'];
                            $ambil = $koneksi->query("SELECT * FROM detail_produk WHERE id_produk='$id_produk'");
                            $perproduk = $ambil->fetch_assoc();

                            $harga = $perproduk['harga'];
                            $harga_telah_diskon = $perproduk['harga_telah_diskon'];
                            
                            // $harga_telah_diskon = $harga - (round($harga * ($diskon / 100)));
                            $total_beli = $harga_telah_diskon + $tarif;
                            
                            
                            $koneksi->query("UPDATE detail_produk SET stok_produk=stok_produk - 1 WHERE id_produk='$id_produk'");

                            
                           
                            $koneksi->query("INSERT INTO penjualan(id_produk, id_pelanggan,id_ongkir,harga,total_beli,metode_bayar,status_penjualan,tanggal_penjualan,alamat_pembeli) VALUES ('$id_produk','$id_pelanggan','$id_ongkir','$harga','$total_beli','$jenis_pembayaran','Pending','$tanggal_penjualan','$alamat_pengiriman')");
                            // update stok

                            $id_penjualan = $koneksi->insert_id;

                            $koneksi->query("DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
                        }
                        // mengkosongkan keranjang belanja
                        // unset($_SESSION['keranjang']);

                        // masuk ke halaman nota
                        echo "<script>alert('Checkout sukses');</script>";
                        echo "<script>location='nota.php?id=$id_penjualan';</script>";
                    }
                ?>
        </div>
    </section>
    <br>
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="frontend/js/jquery.min.js"></script>
  <script src="frontend/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="frontend/js/popper.min.js"></script>
  <script src="frontend/js/bootstrap.min.js"></script>
  <script src="frontend/js/jquery.easing.1.3.js"></script>
  <script src="frontend/js/jquery.waypoints.min.js"></script>
  <script src="frontend/js/jquery.stellar.min.js"></script>
  <script src="frontend/js/owl.carousel.min.js"></script>
  <script src="frontend/js/jquery.magnific-popup.min.js"></script>
  <script src="frontend/js/aos.js"></script>
  <script src="frontend/js/jquery.animateNumber.min.js"></script>
  <script src="frontend/js/bootstrap-datepicker.js"></script>
  <script src="frontend/js/jquery.timepicker.min.js"></script>
  <script src="frontend/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="frontend/js/google-map.js"></script>
  <script src="frontend/js/main.js"></script>

  <script>

    function hitungDiskon()
    {
      let totalHarga = parseFloat(document.getElementById("total_harga").value);
        
        // Ambil nilai diskon dari input
        let diskon = parseFloat(document.getElementById("diskon").value);

        // Pastikan nilai diskon valid
        if (isNaN(diskon) || diskon < 0) {
            diskon = 0;
        }

        // Hitung harga setelah diskon
        let hargaSetelahDiskon = totalHarga - (totalHarga * (diskon / 100));

        // Tampilkan hasil ke input harga_telah_diskon
        document.getElementById("harga_telah_diskon").value = Math.round(hargaSetelahDiskon)
    }
      

    $(document).ready(function(){
    


    });

  </script>
    
  </body>
</html>