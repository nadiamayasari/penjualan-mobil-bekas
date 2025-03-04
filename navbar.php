<?php
// Tangkap URL halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']); // Hanya nama file, misal: keranjang.php
?>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Raffa<span>Motor</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item <?php if ($current_page == 'index.php') { echo 'active'; } ?>"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item <?php if ($current_page == 'about.php') { echo 'active'; } ?>"><a href="about.php" class="nav-link">About</a></li>
            <?php 
              if(isset($_SESSION['pelanggan']) OR !empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item <?php if ($current_page == 'car.php') { echo 'active'; } ?>"><a href="car.php" class="nav-link">Cars</a></li>
            <?php } ?>
	          <li class="nav-item  <?php if ($current_page == 'contact.php') { echo 'active'; } ?>"><a href="contact.php" class="nav-link">Contact</a></li>
	          <li class="nav-item  <?php if ($current_page == 'keranjang.php') { echo 'active'; } ?>"><a href="keranjang.php" class="nav-link">Keranjang</a></li>


			<?php if(isset($_SESSION['pelanggan']) OR !empty($_SESSION['pelanggan'])){ ?>
	          <li class="nav-item  <?php if ($current_page == 'riwayat.php') { echo 'active'; } ?>"><a href="riwayat.php" class="nav-link">Riwayat Belanja</a></li>

			<?php }?>	


            <?php 
              if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item  <?php if ($current_page == 'login.php') { echo 'active'; } ?>"><a href="login.php" class="nav-link">Login</a></li>
            <?php } ?>

            <?php 
              if(isset($_SESSION['pelanggan']) OR !empty($_SESSION['pelanggan'])){
              
            ?>
	          <li class="nav-item  <?php if ($current_page == 'logout.php') { echo 'active'; } ?>"><a href="logout.php" class="nav-link">Logout</a></li>
            <?php } ?>
	        </ul>
	      </div>
	    </div>
	  </nav>