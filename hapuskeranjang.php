<?php 
    session_start();
    include 'koneksi.php';

    $id_produk = $_GET['id'];
    $id_pelanggan  = $_SESSION['pelanggan']['id_pelanggan'];

    $koneksi->query("DELETE FROM keranjang WHERE id_produk='$id_produk' AND id_pelanggan='$id_pelanggan'");

    echo "<script>alert('Produk dihapus dari keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";
?>