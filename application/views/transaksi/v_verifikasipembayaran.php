<section class="section">
	<div class="section-header">
		<h1><?= $judul; ?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) { ?>
			<?php echo $this->session->flashdata('pesan'); ?>
		<?php } ?>
		<div class="card">
			<div class="card-header">
				<h4 class="d-inline">Verifikasi pembayaran di bawah ini!</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped" id="verifikasi">
						<thead>
							<tr>
								<th scope="col">Nomor Meter</th>
								<th scope="col">Nama Pelanggan</th>
								<th scope="col">Tanggal Bayar</th>
								<th scope="col">Bulan Bayar</th>
								<th scope="col">Total Bayar</th>
								<th scope="col">Bukti</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($hitung > 0) {
								foreach ($verifikasi as $h) :
							?>
									<tr>
										<td><?= $h->nomor_kwh; ?></td>
										<td><?= $h->nama_pelanggan; ?></td>
										<td><?= $h->tanggal_pembayaran; ?></td>
										<td><?= $h->bulan_bayar; ?></td>
										<td>Rp <?= number_format($h->total_bayar) ?></td>
										<td> <img src="<?= base_url() ?>assets/bukti/<?= $h->bukti ?>" style="max-width:40px;max-height:40px;"></td>
										<td>
											<form class="form-horizontal" action="<?= base_url() ?>Transaksi/transaksi_verifikasi/<?= $h->id_penggunaan ?>" method="post">
												<input type="submit" name="yes" value="Setujui" class="btn btn-primary btn-sm btn-rounded">
												<input type="submit" name="no" value="Tolak" class="btn btn-danger btn-sm btn-rounded">
											</form>
										</td>
									</tr>
								<?php
								endforeach;
							} else {
								?>
								<td colspan="7">
									<center>Data tidak ditemukan.</center>
								</td>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
	$(document).ready(function() {
		$('#verifikasi').DataTable();
	});
</script>