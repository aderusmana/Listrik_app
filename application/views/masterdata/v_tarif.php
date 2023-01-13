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
						<h4 class="d-inline">Data Tarif</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hovered" id="tarif">
								<thead>
									<tr>
										<th scope="col">Daya</th>
										<th scope="col">Tarif/KWH</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($count > 0) {
										foreach ($tarif as $t) {
									?>
											<tr>
												<td><?= $t->daya ?> Watt</td>
												<td>Rp <?= number_format($t->tarifperkwh) ?></td>
												<td>
													<a onclick="Edit(<?= $t->id_tarif ?>);" style="color: white">
														<button type="button" name="button" class="btn btn-success" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Edit Tarif">
															<i class="fas fa-edit"></i>
														</button>
													</a>
													<a href="<?= base_url() ?>Tarif/tarif_hapus/<?= $t->id_tarif ?>" style="color: white" onclick="return confirm('Apakah yakin?')">
														<button type="button" name="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Tarif">
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
											<td colspan="3" style="text-align:center">Data tidak ditemukan.</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<!-- Edit Tarif -->
				<div class="card" id="edittarif" style="display:none">
					<div class="card-header">
						<h4 class="d-inline">Edit Tarif</h4>
						<div class="card-header-action">
							<button onclick="Close();" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Tarif/tarif_ubah') ?>" method="post">
							<div class="form-group">
								<label>Daya (Watt)</label>
								<input type="hidden" name="id_tarif" id="id_tarif">
								<input type="number" class="form-control" placeholder="Daya (Watt)" name="daya" id="daya" autocomplete="off" min="0">
							</div>
							<div class="form-group">
								<label>Tarif/ Kwh</label>
								<input type="number" class="form-control" placeholder="Tarif/ Kwh" name="tarifperkwh" id="tarifperkwh" autocomplete="off" min="0">
							</div>
							<input type="submit" class="btn btn-success" value="Ubah" name="ubah">
						</form>
					</div>
				</div>

				<!-- Tambah Tarif -->
				<div class="card" id="tambahtarif">
					<div class="card-header">
						<h4 class="d-inline">Tambah Tarif</h4>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Tarif/tarif_tambah') ?>" method="post">
							<div class="form-group">
								<label>Daya (Watt)</label>
								<input type="number" class="form-control" placeholder="Daya (Watt)" name="daya" autocomplete="off" min="0">
							</div>
							<div class="form-group">
								<label>Tarif/ Kwh</label>
								<input type="number" class="form-control" placeholder="Tarif/ Kwh" name="tarifperkwh" autocomplete="off" min="0">
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
		$('#tarif').DataTable();
	});

	function Close() {
		$('#edittarif').slideUp();
		$('#tambahtarif').slideDown();
	}

	function Edit(id) {
		$('#edittarif').slideDown();
		$('#tambahtarif').slideUp();
		$.ajax({
			type: 'GET',
			url: '<?= base_url('Tarif/get_tarif_id/') ?>' + id,
			dataType: 'json',
			success: function(data) {
				$('#id_tarif').val(data.id_tarif);
				$('#daya').val(data.daya);
				$('#tarifperkwh').val(data.tarifperkwh);
			}
		});
	}
</script>