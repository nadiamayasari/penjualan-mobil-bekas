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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Login</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
        	
          <div class="col-md-12 block-9 mb-md-5">
            <form action="" method="post" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Your Password" required>
              </div>
             
              <div class="form-group">
                <input type="submit" value="Login" name="simpan" class="btn btn-primary py-3 px-5">
              </div>
              <p>Belum Punya Akun ?, <a href="daftar.php" class="text-danger">Daftar Disini</a></p>
            </form>
          
          </div>
        </div>
        
      </div>
    </section>
	
    <?php include 'footer.php'; ?>

  </body>
</html>

    <?php 
        // jika tombol login ditekan
        if(isset($_POST['simpan'])){
            $email = $_POST['email'];
            $password =$_POST['password'];
            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

            // hitung akun yang terpanggil
            $akunyangcocok = $ambil->num_rows;

            // jika ada yang cocok maka diloginkan
            if($akunyangcocok==1){
                $akun= $ambil->fetch_assoc();
                $_SESSION['pelanggan'] = $akun;
                echo "<script>alert('Anda berhasil login');</script>";

                if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])){
                    echo "<script>location='checkout.php';</script>";
                }else{
                    echo "<script>location='index.php';</script>";
                }
                
            }else{
                echo "<script>alert('Gagal login, periksa email dan password anda');</script>";
                echo "<script>location='login.php';</script>";
            }
        }
    ?>



