<?php 
session_start();
include 'koneksi.php';
    // mendapatkan id_produk dari url
    $id_produk = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM detail_produk WHERE id_produk='$id_produk'");
    $detail = $ambil->fetch_assoc();

    $pelanggan = $_SESSION['pelanggan'];

    $keranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_produk='$id_produk' AND id_pelanggan='$pelanggan[id_pelanggan]' ");
    $keranjang = $keranjang->fetch_assoc();
    
    // jika stok produk kosong
    if(empty($detail['stok_produk'])){
        echo "<script>alert('Maaf, Stok produk telah habis');</script>";
        echo "<script>location='index.php';</script>";
        exit();
    }
    // jika produk sudah ada di keranjang, maka jumlah di +1
    if($keranjang['id_produk'] == $id_produk){
        $keranjang['jumlah']+=1;
        $koneksi->query("UPDATE keranjang SET jumlah='$keranjang[jumlah]' WHERE id_produk='$id_produk' AND id_pelanggan='$pelanggan[id_pelanggan]' ");
    }
    // selain itu(blm ada di keranjang),maka produk dianggap dibeli 1
    else{
        $koneksi->query("INSERT INTO keranjang(id_pelanggan,id_produk, no_plat) VALUES ('$pelanggan[id_pelanggan]','$id_produk','$detail[no_plat]')");
    }

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    echo "<script>alert('produk telah dimasukkan ke keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";
?>