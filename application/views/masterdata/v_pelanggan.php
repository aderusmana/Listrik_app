<section class="section">
	<div class="section-header">
		<h1><?= $judul; ?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) { ?>
			<?php echo $this->session->flashdata('pesan'); ?>
		<?php } ?>
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="d-inline">Data Pelanggan</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="pelanggan">
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
													<a onclick="Edit(<?= $p->id_pelanggan ?>);" style="color: white">
														<button type="button" name="button" class="btn btn-success" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Edit Pelanggan">
															<i class="fas fa-edit"></i>
														</button>
													</a>
													<a href="<?= base_url() ?>Pelanggan/pelanggan_hapus/<?= $p->id_pelanggan ?>" style="color: white" onclick="return confirm('Apakah yakin?')">
														<button type="button" name="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Pelanggan">
															<i class="fas fa-trash"></i>
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
			<div class="col-lg-3 col-md-3 col-sm-12">
				<!-- Edit Pelanggan -->
				<div class="card" id="editpelanggan" style="display:none">
					<div class="card-header">
						<h4 class="d-inline">Edit Pelanggan</h4>
						<div class="card-header-action">
							<button onclick="Close();" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Pelanggan/pelanggan_ubah') ?>" method="post">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan" id="nama_pelanggan" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Nomor Meter</label>
								<input type="number" class="form-control" placeholder="Nomor Meter" name="nomor_kwh" id="nomor_kwh" autocomplete="off" min="0">
							</div>
							<div class="form-group">
								<label>Daya</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-bulb"></i></div>
									<select class="selectpicker form-control" data-style="form-control btn-default" name="id_tarif" id="id_tarif">
										<option value="" disabled selected>--Pilih--</option>
										<?php foreach ($tarif as $t) : ?>
											<option value="<?= $t->id_tarif ?>"><?= $t->daya ?> Watt (Rp <?= number_format($t->tarifperkwh) ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" id="alamat" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="hidden" name="id_pelanggan" id="id_pelanggan">
								<input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off">
							</div>
							<input type="submit" class="btn btn-success" value="Ubah" name="ubah">
						</form>
					</div>
				</div>

				<!-- Tambah Pelanggan -->
				<div class="card" id="tambahpelanggan">
					<div class="card-header">
						<h4 class="d-inline">Tambah Pelanggan</h4>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Pelanggan/pelanggan_tambah') ?>" method="post">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama_pelanggan" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Nomor Meter</label>
								<input type="number" class="form-control" placeholder="Nomor Meter" name="nomor_kwh" autocomplete="off" min="0">
							</div>
							<div class="form-group">
								<label>Daya</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-bulb"></i></div>
									<select class="selectpicker form-control" data-style="form-control btn-default" name="id_tarif">
										<option value="" disabled selected>--Pilih--</option>
										<?php foreach ($tarif as $t) : ?>
											<option value="<?= $t->id_tarif ?>"><?= $t->daya ?> Watt (Rp <?= number_format($t->tarifperkwh) ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" placeholder="Alamat" name="alamat" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
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
		$('#pelanggan').DataTable();
	});

	function Close() {
		$('#editpelanggan').slideUp();
		$('#tambahpelanggan').slideDown();
	}

	function Edit(id) {
		$('#editpelanggan').slideDown();
		$('#tambahpelanggan').slideUp();
		$.ajax({
			type: 'GET',
			url: '<?= base_url('Pelanggan/get_pelanggan_id/') ?>' + id,
			dataType: 'json',
			success: function(data) {
				$('#id_tarif').val(data.id_tarif).change();
				$('#id_pelanggan').val(data.id_pelanggan);
				$('#username').val(data.username);
				$('#nomor_kwh').val(data.nomor_kwh);
				$('#nama_pelanggan').val(data.nama_pelanggan);
				$('#alamat').val(data.alamat);
			}
		});
	}
</script>