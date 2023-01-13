<section class="section">
	<div class="section-header">
		<h1><?= $judul; ?></h1>
	</div>
	<div class="section-body">
		<?php if ($this->session->flashdata('pesan') != null) : ?>
			<div class="alert alert-warning"><?= $this->session->flashdata('pesan'); ?></div>
		<?php endif ?>
		<div class="card">
			<div class="card-header">
				<h4 class="d-inline">Detail Penggunaan</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Periode</th>
								<th scope="col">Meter Awal</th>
								<th scope="col">Meter Akhir</th>
								<th scope="col">Total Meter</th>
								<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($count > 0) {
								foreach ($detail as $d) {
							?>
									<tr>
										<td><?= $d->bulan ?> <?= $d->tahun ?></td>
										<td><?= $d->meter_awal ?></td>
										<td><?= $d->meter_akhir ?></td>
										<td><?= $d->jumlah_meter ?></td>
										<?php if ($d->status == 0) { ?>
											<td>
												<div class="badge badge-primary">Belum Bayar</div>
											</td>
										<?php } else if ($d->status == 1) { ?>
											<td>
												<div class="badge badge-warning">Pending</div>
											</td>
										<?php } else if ($d->status == 2) { ?>
											<td>
												<div class="badge badge-danger">Ditolak</div>
											</td>
										<?php } else { ?>
											<td>
												<div class="badge badge-success">Lunas</div>
											</td>
										<?php } ?>
									</tr>
								<?php
								}
							} else {
								?>
								<tr>
									<td colspan="5" style="text-align:center">Data tidak ditemukan.</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>