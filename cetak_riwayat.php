<?php 
session_start();
include 'koneksi.php';
$semuadata=array();
$tanggal = "-";
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

    if(isset($_GET['tanggal'])) {
        $tanggal = $_GET['tanggal'];
        $ambil = $koneksi->query("SELECT  penjualan.*, produk.*, detail_produk.*, ongkir.*, pembayaran.resi_pengiriman FROM penjualan  LEFT JOIN produk ON penjualan.id_produk = produk.id_produk LEFT JOIN detail_produk ON produk.id_produk = detail_produk.id_produk LEFT JOIN ongkir ON penjualan.id_ongkir = ongkir.id_ongkir LEFT JOIN pembayaran ON penjualan.id_penjualan = pembayaran.id_penjualan WHERE id_pelanggan='$id_pelanggan' AND tanggal_penjualan='$tanggal'");


        while($pecah = $ambil->fetch_assoc()){
            $semuadata[]=$pecah;
        }
    }
?>
<html>
	<head>
		<title>Cetak Laporan Transaksi</title>
	</head>
<body onload="window.print();">
<center>
    <h2>SHOWROOM RAFFA MOTOR</h2>
    <h4>Jln. Sungai Gemuruh, Nagari Inderapura, Kecamatan Pancung Soal, Kabupaten Pesisir Selatan.</h4>
    <hr>
 </center>
 <hr>
 <center>
    <h3>Laporan Transaksi</h3>
    </center>
<table  width="100%" cellspacing="0" cellpadding="5" border="1">
    <thead>
        <tr>
        <th class="text-center">Plat Nomor</th>
                        <th align="center">Jenis Mobil</th>
                        <th align="center">Harga</th>
                        <th align="center">Diskon</th>
                        <th align="center">Harga Telah Diskon</th>
                        <th align="center">Ongkir</th>
                        <th align="center">Status</th>
                        <th align="center">Tanggal Pembelian</th>
                        <th align="right">Total Pembelian</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach($semuadata as $key => $pecah) : ?>
            <?php $total = $pecah['harga_telah_diskon'] + $pecah['tarif']; ?>
        <tr>
        <td><?= $pecah['no_plat']; ?></td>
                        <td><?= $pecah['nama_mobil']; ?></td>
                        <td align="right"><?=number_format($pecah['harga']); ?></td>
                        <td align="right"><?= $pecah['diskon']; ?>%</td>
                        <td align="right"><?= number_format($pecah['harga_telah_diskon']); ?></td>
                        <td align="right"><?= number_format($pecah['tarif']); ?></td>
                        <td>
                            <span class="badge <?= $pecah['status_penjualan'] == 'Pending' ? 'bg-warning text-dark' : 'bg-success'; ?>">
                                <?= $pecah['status_penjualan']; ?>
                            </span>
                            <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                <div class="text-muted mt-1">Resi: <?= $pecah['resi_pengiriman']; ?></div>
                            <?php endif; ?>
                        </td>
                        <td ><?= date("d M Y", strtotime($pecah['tanggal_penjualan'])); ?></td>
                       
                   
                        <td align="right">Rp <?= number_format($total, 0, ',', '.'); ?></td>
                       
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8">Total</th>
            <th align="right">Rp.<?= number_format($total); ?></th>
        </tr>
    </tfoot>
</table>

</body>
</html>