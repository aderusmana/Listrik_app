<section class="section">
	<div class="section-header">
		<h1><?= $judul; ?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) : ?>
			<div class="alert alert-warning"><?= $this->session->flashdata('pesan'); ?></div>
		<?php endif ?>
		<div class="card">
			<div class="card-body">
				<?php echo form_open('Transaksi/filter_histori_transaksi')  ?>


				<div class="row">
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>Bulan</label>
							<div class="input-group">
								<div class="input-group-addon"><i class=" icon-bulb"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="bulan">
									<option value="" disabled selected>--Pilih--</option>
									<option value="Januari">Januari</option>
									<option value="Februari">Februari</option>
									<option value="Maret">Maret</option>
									<option value="April">April</option>
									<option value="Mei">Mei</option>
									<option value="Juni">Juni</option>
									<option value="Juli">Juli</option>
									<option value="Agustus">Agustus</option>
									<option value="September">September</option>
									<option value="Oktober">Oktober</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-12">
						<div class="form-group">
							<label>Tahun</label>
							<div class="input-group">
								<div class="input-group-addon"><i class=" icon-bulb"></i></div>
								<select class="selectpicker form-control" data-style="form-control btn-default" name="tahun">
									<option value="" disabled selected>--Pilih--</option>
									<?php for ($i = 2025; $i > 2018; $i--) { ?>
										<option value="<?= $i ?>"><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye mr-2"></i>Tampilkan Data</button>
					</div>
				</div>
				<?php echo form_close() ?>



				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nama Pelanggan</th>
							<th scope="col">Tanggal Bayar</th>
							<th scope="col">Bulan / Tahun Bayar</th>
							<th scope="col">Total Bayar</th>
							<th scope="col">Status</th>
							<th scope="col">Bukti</th>
							<th scope="col">Verifikasi Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						if ($count > 0) {
							foreach ($histori as $h) :
						?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $h->nama_pelanggan; ?></td>
									<td><?= $h->tanggal_pembayaran; ?></td>
									<td><?= $h->bulan_bayar ?> /<?= $h->tahun ?></td>
									<td>Rp <?= number_format($h->total_bayar) ?></td>
									<?php if ($h->status == 0) { ?>
										<td>
											<div class="badge badge-primary">Belum Bayar</div>
										</td>
									<?php } else if ($h->status == 1) { ?>
										<td>
											<div class="badge badge-warning">Pending</div>
										</td>
									<?php } else if ($h->status == 2) { ?>
										<td>
											<div class="badge badge-danger">Ditolak</div>
										</td>
									<?php } else { ?>
										<td>
											<div class="badge badge-success">Lunas</div>
										</td>
									<?php } ?>
									<td><img src="<?= base_url() ?>assets/bukti/<?= $h->bukti; ?>" style="max-width:50px;max-height:50px;"></td>
									<td><?= $h->nama_admin; ?></td>
								</tr>
							<?php
							endforeach;
						} else {
							?>
							<td colspan="9">
								<center>Data tidak ditemukan.</center>
							</td>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<a href="<?= base_url('Transaksi/cetak_filter_laporan/?bulan=' . set_value('bulan') . '&tahun=' . set_value('tahun')) ?>" class="btn btn-info" target="_blank"> PRINT <i class="fa fa-print"></i></a>
					<a href="<?= base_url('Transaksi/histori_transaksi') ?>" class="btn btn-info"> RESET <i class="fas fa-sync"></i></a>

				</div>
			</div>
		</div>
	</div>
</section>