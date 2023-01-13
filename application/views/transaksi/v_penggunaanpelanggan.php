<section class="section">
	<div class="section-header">
		<h1><?= $judul; ?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) { ?>
			<?php echo $this->session->flashdata('pesan'); ?>
		<?php } ?>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="d-inline"></h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="penggunaan">
								<thead>
									<tr>
										<th scope="col">Nama Pelanggan</th>
										<th scope="col">Nomor Meter</th>
										<th scope="col">Daya</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($count > 0) {
										foreach ($pelanggan as $p) {
									?>
											<tr>
												<td><?= $p->nama_pelanggan ?></td>
												<td><?= $p->nomor_kwh ?></td>
												<td><?= $p->daya ?> Watt</td>
												<td>
													<a href="<?= base_url() ?>Transaksi/penggunaan_detail/<?= $p->id_pelanggan ?>">
														<button type="button" name="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail Penggunaan">
															<i class="fas fa-info"></i>
														</button>
													</a>
												</td>
											</tr>
										<?php
										}
									} else {
										?>
										<tr>
											<td colspan="4" style="text-align:center">Data tidak ditemukan.</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="card" id="tambahpelanggan">
					<div class="card-header">
						<h4 class="d-inline">Tambah Penggunaan Pelanggan</h4>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Transaksi/penggunaan_tambah') ?>" method="post">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-bulb"></i></div>
									<select class="selectpicker form-control" data-style="form-control btn-default" name="id_pelanggan">
										<option value="" disabled selected>--Pilih--</option>
										<?php foreach ($pelanggan as $p) : ?>
											<option value="<?= $p->id_pelanggan ?>"><?= $p->nama_pelanggan ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
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
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Tahun</label>
										<div class="input-group">
											<div class="input-group-addon"><i class=" icon-bulb"></i></div>
											<select class="selectpicker form-control" data-style="form-control btn-default" name="tahun">
												<option value="" disabled selected>--Pilih--</option>
												<?php for ($i = 2025; $i > 2010; $i--) { ?>
													<option value="<?= $i ?>"><?= $i ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Meter Awal</label>
										<input type="number" class="form-control" placeholder="Meter Awal" name="meter_awal" autocomplete="off" min="0">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Meter Akhir</label>
										<input type="number" class="form-control" placeholder="Meter Akhir" name="meter_akhir" autocomplete="off" min="0">
									</div>
								</div>
							</div>
							<input type="submit" class="btn btn-primary" value="Tambah" name="tambah">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
	$(document).ready(function() {
		$('#penggunaan').DataTable();
	});
</script>