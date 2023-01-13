<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Aplikasi Pembayaran Listrik Pascabayar - <?= $judul; ?></title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/components.min.css">
</head>

<body>
	<center>
		<img width="8%" height="15%" src="<?= base_url() ?>assets/img/PLN.png" alt="" srcset="">
		<section class="container">
			<h1><?= $judul; ?></h1>
	</center>
	<p style="text-align: right">Admin : <?php echo $this->session->userdata('nama_admin') ?></p>

	<table class=" table table-bordered table-striped mt-4">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Daya</th>
				<th>Bulan/Tahun </th>
				<th>Jumlah Meter</th>
				<th>Tanggal Bayar</th>
				<th>Biaya Admin</th>
				<th>Total Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($cetak as $ct) : ?>
				<ct>
					<td><?= $no++ ?></td>
					<td><?= $ct->nama_pelanggan ?></td>
					<td><?= $ct->daya ?></td>
					<td><?= $ct->bulan_bayar ?> / <?= $ct->tahun ?></td>
					<td><?= $ct->jumlah_meter ?></td>
					<td><?= $ct->tanggal_pembayaran ?></td>
					<td>Rp. <?php echo number_format($ct->biaya_admin, 0, ',', '.') ?></td>
					<td>Rp. <?php echo number_format($ct->total_bayar, 0, ',', '.') ?></td>

					</tr>
				<?php endforeach; ?>
		</tbody>
		<tfoot>
	</table>
	</tfoot>
	</table>

</body>
<script>
	window.print();
</script>

</html>