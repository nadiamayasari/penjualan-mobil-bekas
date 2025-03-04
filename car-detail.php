<?php 
 include 'koneksi.php';

 $ambil = $koneksi->query("SELECT * FROM produk a INNER JOIN merek b ON a.id_merek=b.id_merek INNER JOIN detail_produk d ON a.id_produk=d.id_produk WHERE a.id_produk='$_GET[id_produk]'");
 $pecah= $ambil->fetch_assoc();

 

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

    <style>.gallery-img img {
  width: 100%;
  height: auto;
  object-fit: cover;
}</style>
  </head>
  <body>
    
	 <?php include 'navbar.php'; ?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg_3.jpg'); height:300px;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Car Details</h1>
          </div>
        </div>
      </div>
    </section>
		

		<section class="ftco-section ftco-car-details">
      
      <div class="container">

      <div class="row">
      		<div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Killometer
		                	<span><?= number_format($pecah['kilometer'])?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Transmission
		                	<span><?= $pecah['transmisi']?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Seats
		                	<span>5 Adults</span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-suv"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Warna
		                	<span><?=  $pecah['warna']?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Bahan Bakar
		                	<span><?= $pecah['bahan_bakar']?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
      	</div>


      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(foto_produk/<?= $pecah['foto_produk']?>);"></div>
      				<div class="text text-center">
      					<span class="subheading"><?= $pecah['merek']?></span>
      					<h2><?= $pecah['nama_mobil']?></h2>
      				</div>
      			</div>
      		</div>
      	</div>
        <div class="row mt-4">
     
     <div class="col-md-3">
       <div class="gallery-img rounded mb-3">
         <img src="foto_produk/<?= $pecah['foto_depan'] ?>" class="img-fluid rounded" alt="Foto Produk ">
       </div>
     </div>
     <div class="col-md-3">
       <div class="gallery-img rounded mb-3">
         <img src="foto_produk/<?= $pecah['foto_belakang'] ?>" class="img-fluid rounded" alt="Foto Produk ">
       </div>
     </div>
     <div class="col-md-3">
       <div class="gallery-img rounded mb-3">
         <img src="foto_produk/<?= $pecah['foto_dalam'] ?>" class="img-fluid rounded" alt="Foto Produk ">
       </div>
     </div>
     <div class="col-md-3">
       <div class="gallery-img rounded mb-3">
         <img src="foto_produk/<?= $pecah['foto_spido'] ?>" class="img-fluid rounded" alt="Foto Produk ">
       </div>
     </div>
 </div>
 <p> Keterangan : <?= $pecah['keterangan'] ?> </p>
      
      	
    </section>

   
	<?php include 'footer.php' ?>

  </body>
</html>