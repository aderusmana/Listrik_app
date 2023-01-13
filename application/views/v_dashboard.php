<div class="container-fluid">
	<section class="section">
		<div class="section-header">
			<h1><?= $judul; ?></h1>
		</div>

		<!-- Content Row -->
		<center> <img src="<?php echo base_url(); ?>assets/img/PLN.png" width="7%" height="10%" style="display: block; margin: auto;"></center>

		<div class="row mt-5">
			<div class="section-body">
				<?php if ($this->session->flashdata('pesan') != null) { ?>
					<?php echo $this->session->flashdata('pesan'); ?>
				<?php } ?>
			</div>

			<!-- data pelanggan Card Example -->
			<div class="col-lg-3 col-md-6  col-sm-12 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pelanggan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countpelanggan ?></div>
							</div>
							<div class="col-auto">
								<i class="fa fa-users fa-3x"></i>
							</div>
						</div>
						<a href="<?= base_url('Pelanggan/data_pelanggan') ?>"><button class="btn btn-success">More...</button></a>
					</div>
				</div>
			</div>

			<!-- data pelanggan Card Example -->
			<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Tarif</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counttarif ?></div>
							</div>
							<div class="col-auto">
								<i class="fa fa-dollar-sign fa-3x"></i>
							</div>
						</div>
						<a href="<?= base_url('Tarif/data_tarif') ?>"><button class="btn btn-success">More...</button></a>
					</div>
				</div>
			</div>
			<!-- data pelanggan Card Example -->
			<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Histori Transaksi</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $counthistori ?></div>
							</div>
							<div class="col-auto">
								<i class="fa fa-history fa-3x"></i>
							</div>
						</div>
						<a href="<?= base_url('Transaksi/histori_transaksi') ?>"><button class="btn btn-success">More...</button></a>
					</div>
				</div>
			</div>
			<!-- data pelanggan Card Example -->
			<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pengunaan </div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $countpenggunaan ?></div>
							</div>
							<div class="col-auto">
								<i class="fa fa-list-alt fa-3x"></i>
							</div>
						</div>
						<a href="<?= base_url('Transaksi/penggunaan_pelanggan') ?>"><button class="btn btn-success">More...</button></a>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>