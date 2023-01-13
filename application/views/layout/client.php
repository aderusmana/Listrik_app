<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aplikasi Pembayaran Listrik Pascabayar - Client</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
</head>

<body>
    <div class="jumbotron header">
        <div class="container">
            <center>
                <h1 style="color: white">Selamat Datang di Aplikasi Pembayaran Listrik Pascabayar</h1><br>
                <a href="<?= base_url('Pelanggan/pelanggan_logout') ?>">
                    <button type="submit" name="button" class="btn btn-danger">Logout</button>
                </a>
            </center>
        </div>
    </div>
    <div class="container-fluid">
        <center>
            <h4>Daftar Tagihan Anda</h4><br>
        </center>
        <?php if ($this->session->flashdata('pesan') != null) { ?>
            <?php echo $this->session->flashdata('pesan'); ?>
        <?php } ?>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <div class="card lunas">
                    <div class="card-header lunas">
                        <h4 style="color: white">LUNAS</h4>
                    </div>
                </div>
                <?php foreach ($lunas as $l) { ?>
                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Tagihan <?= $l->bulan ?> <?= $l->tahun ?> </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Awal</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $l->meter_awal ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Akhir</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $l->meter_akhir ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Jumlah Meter</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $l->jumlah_meter ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Grand Total</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format($l->jumlah_meter * $l->daya) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Biaya Admin</b></div>
                                <div class="col-md-7 col-xs-12">: Rp 2,500</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Total Bayar</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format(($l->jumlah_meter * $l->daya) + 2500) ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" name="button" class="btn btn-success btn" disabled>Lunas</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                <div class="card ditolak">
                    <div class="card-header ditolak">
                        <h4 style="color: white">DITOLAK</h4>
                    </div>
                </div>
                <?php foreach ($ditolak as $d) { ?>
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4>Tagihan <?= $d->bulan ?> <?= $d->tahun ?> </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Awal</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $d->meter_awal ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Akhir</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $d->meter_akhir ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Jumlah Meter</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $d->jumlah_meter ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Grand Total</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format($d->jumlah_meter * $d->daya) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Biaya Admin</b></div>
                                <div class="col-md-7 col-xs-12">: Rp 2,500</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Total Bayar</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format(($d->jumlah_meter * $d->daya) + 2500) ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" name="button" class="btn btn-danger btn" data-toggle="modal" data-target="#myModal1">Upload Ulang</button>
                        </div>
                        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form class="form-control" action="<?= base_url() ?>Transaksi/upload_bukti/<?= $d->id_penggunaan ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Upload Bukti Pembayaran</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_penggunaan" value="<?= $d->id_penggunaan ?>">
                                            <input type="hidden" name="bulan_bayar" value="<?= $d->bulan ?>">
                                            <input type="hidden" name="grandtotal" value="<?= $d->jumlah_meter * $d->daya ?>">
                                            <input type="file" name="bukti" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                <div class="card pending">
                    <div class="card-header pending">
                        <h4 style="color: white">PENDING</h4>
                    </div>
                </div>
                <?php foreach ($pending as $p) { ?>
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4>Tagihan <?= $p->bulan ?> <?= $p->tahun ?> </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Awal</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $p->meter_awal ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Akhir</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $p->meter_akhir ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Jumlah Meter</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $p->jumlah_meter ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Grand Total</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format($p->jumlah_meter * $p->daya) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Biaya Admin</b></div>
                                <div class="col-md-7 col-xs-12">: Rp 2,500</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Total Bayar</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format(($p->jumlah_meter * $p->daya) + 2500) ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" name="button" class="btn btn-warning btn" disabled>Pending</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                <div class="card belum">
                    <div class="card-header belum">
                        <h4 style="color: white">BELUM BAYAR</h4>
                    </div>
                </div>
                <?php foreach ($belum as $b) { ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Tagihan <?= $b->bulan ?> <?= $b->tahun ?> </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Awal</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $b->meter_awal ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Meter Akhir</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $b->meter_akhir ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Jumlah Meter</b></div>
                                <div class="col-md-7 col-xs-12">: <?= $b->jumlah_meter ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Grand Total</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format($b->jumlah_meter * $b->daya) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Biaya Admin</b></div>
                                <div class="col-md-7 col-xs-12">: Rp 2,500</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5 col-xs-12"><b>Total Bayar</b></div>
                                <div class="col-md-7 col-xs-12">: Rp <?= number_format(($b->jumlah_meter * $b->daya) + 2500) ?></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">Upload Bukti</button>
                        </div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form class="form-control" action="<?= base_url() ?>Transaksi/upload_bukti/<?= $b->id_penggunaan ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Upload Bukti Pembayaran</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_penggunaan" value="<?= $b->id_penggunaan ?>">
                                            <input type="hidden" name="bulan_bayar" value="<?= $b->bulan ?>">
                                            <input type="hidden" name="grandtotal" value="<?= $b->jumlah_meter * $b->daya ?>">
                                            <input type="file" name="bukti" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="simple-footer">
        Copyright &copy; 2022 Ade Rusmana<div class="bullet"></div>All Rights Reserved.
    </div>
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>