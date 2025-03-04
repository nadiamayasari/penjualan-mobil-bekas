<?php 
  include 'koneksi.php';
  session_start();

  if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
	echo "<script>alert('Silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
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

    <style>
   .brand-container {
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 10px;
}

.brand-card {
    flex: 0 0 auto;
    text-align: center;
    width: 130px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: #fff;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 150px; /* Tinggi seragam */
}

/* Mengatur ukuran gambar agar memiliki tinggi yang sama */
.img-container {
    width: 100px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Pastikan gambar tidak melebihi batas dan tetap proporsional */
.brand-card img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Pastikan teks sejajar di bagian bawah */
.brand-card p {
    flex-grow: 1;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    margin-top: 10px;
}


    </style>
  </head>
  <body>
    
    <?php 
      include 'navbar.php';
    ?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Pilih Mobil Kamu</h1>
          </div>
        </div>
      </div>
    </section>
		
    <div class="container mt-4">
    <h3 class="mt-2 fw-bold">Mobil bekas berdasarkan merek</h3>

    <div class="d-flex flex-row brand-container gap-3 py-2">
        <?php $query = mysqli_query($koneksi, "SELECT * FROM merek");
        while ($row = mysqli_fetch_array($query)) { ?>
            <a href="car-merek.php?id_merek=<?= $row['id_merek'] ?>" class="text-decoration-none">
                <div class="brand-card">
                    <div class="img-container">
                        <img src="foto_merek/<?= $row['foto_merek'] ?>" alt="<?= $row['merek'] ?>">
                    </div>
                    <p class="fw-semibold"><?= $row['merek'] ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</div>


		<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
			<?php
              include 'koneksi.php';
              $query = "SELECT a.*, b.*, c.status_penjualan as status_penjualan,d.* FROM produk a LEFT JOIN detail_produk d ON a.id_produk=d.id_produk LEFT JOIN merek b ON a.id_merek=b.id_merek LEFT JOIN penjualan c ON a.id_produk=c.id_produk  ORDER BY a.id_produk DESC";
              $result = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_array($result)) {
              ?>
    			<div class="col-md-4">
    				<div class="car-wrap rounded ftco-animate">
    					<div class="img rounded d-flex align-items-end" style="background-image: url(foto_produk/<?php echo $row['foto_produk'] ?>);">
    					</div>
    					<div class="text">
    						<h2 class="mb-0"><a href="car-single.html"><?php echo $row['nama_mobil'] ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span class="cat"><?php echo $row['merek'] ?></span>
	    						<p class="price ml-auto"><?php echo number_format($row['harga_telah_diskon']) ?></p>
    						</div>
                <div class="d-flex mb-3">
			    						<span class="cat">Stok Unit</span>
			    						<p class="price ml-auto">
                      <?php
                      if ($row['status_penjualan']  == 'Pending') {
                        echo "Proses Pembayaran";
                      } else if(in_array($row['status_penjualan'], ['Dibayar', 'Dikirim'])) {
                        echo "Terjual";
                      }else{
                        echo "Mobil Tersedia";
                      }
                      ?>
                      </p>
		    						</div>
                    <div class="d-flex mb-3">
	    						<span class="cat">Plat Nomor</span>
	    						<p class="price ml-auto"><?php echo $row['no_plat'] ?></p>
    						</div>
    						<p class="d-flex mb-0 d-block"><a href="beli.php?id=<?= $row['id_produk']; ?>" class="btn btn-primary py-2 mr-1">Beli</a> <a href="car-detail.php?id_produk=<?= $row['id_produk'] ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
    					</div>
    				</div>
    			</div>
				<?php
			  }
			  ?>
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>
    

    <?php 
      include 'footer.php';
    ?>  


  </body>
</html>