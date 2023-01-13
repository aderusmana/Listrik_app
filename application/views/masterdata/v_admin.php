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
						<h4 class="d-inline">Data Admin</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="admin">
								<thead>
									<tr>
										<th scope="col">Nama Admin</th>
										<th scope="col">Username</th>
										<th scope="col">Level</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($count > 0) {
										foreach ($admin as $a) {
									?>
											<tr>
												<td><?= $a->nama_admin ?></td>
												<td><?= $a->username ?></td>
												<td><?= $a->nama_level ?></td>
												<td>
													<a onclick="Edit(<?= $a->id_admin ?>);" style="color: white">
														<button type="button" name="button" class="btn btn-success" aria-haspopup="true" aria-expanded="true" data-toggle="tooltip" data-placement="top" title="Edit Admin">
															<i class="fas fa-edit"></i>
														</button>
													</a>
													<a href="<?= base_url() ?>Admin/admin_hapus/<?= $a->id_admin ?>" style="color: white" onclick="return confirm('Apakah yakin?')">
														<button type="button" name="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Admin">
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
				<!-- Edit Admin -->
				<div class="card" id="editadmin" style="display:none">
					<div class="card-header">
						<h4 class="d-inline">Edit Admin</h4>
						<div class="card-header-action">
							<button onclick="Close();" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Admin/admin_ubah') ?>" method="post">
							<div class="form-group">
								<label>Nama Admin</label>
								<input type="text" class="form-control" placeholder="Nama Admin" name="nama_admin" id="nama_admin" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Level</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-bulb"></i></div>
									<select class="selectpicker form-control" data-style="form-control btn-default" name="id_level" id="id_level">
										<option value="" disabled selected>--Pilih--</option>
										<?php foreach ($level as $l) { ?>
											<option value="<?= $l->id_level ?>"><?= $l->nama_level ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="hidden" name="id_admin" id="id_admin">
								<input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off">
							</div>
							<input type="submit" class="btn btn-success" value="Ubah" name="ubah">
						</form>
					</div>
				</div>

				<!-- Tambah Admin -->
				<div class="card" id="tambahadmin">
					<div class="card-header">
						<h4 class="d-inline">Tambah Admin</h4>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="<?= base_url('Admin/admin_tambah') ?>" method="post">
							<div class="form-group">
								<label>Nama Admin</label>
								<input type="text" class="form-control" placeholder="Nama Admin" name="nama_admin" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Level</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-bulb"></i></div>
									<select class="selectpicker form-control" data-style="form-control btn-default" name="id_level">
										<option value="" disabled selected>--Pilih--</option>
										<?php foreach ($level as $l) { ?>
											<option value="<?= $l->id_level ?>"><?= $l->nama_level ?></option>
										<?php } ?>
									</select>
								</div>
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
		$('#admin').DataTable();
	});

	function Close() {
		$('#editadmin').slideUp();
		$('#tambahadmin').slideDown();
	}

	function Edit(id) {
		$('#editadmin').slideDown();
		$('#tambahadmin').slideUp();
		$.ajax({
			type: 'GET',
			url: '<?= base_url('Admin/get_admin_id/') ?>' + id,
			dataType: 'json',
			success: function(data) {
				$('#id_level').val(data.id_level).change();
				$('#id_admin').val(data.id_admin);
				$('#username').val(data.username);
				$('#nama_admin').val(data.nama_admin);
			}
		});
	}
</script>