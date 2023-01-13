<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aplikasi Pembayaran Listrik Pascabayar - Register Pelanggan</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            Aplikasi Pembayaran Listrik Pascabayar
                        </div>
                        <?php if ($this->session->flashdata('pesan') != null) { ?>
                            <?php echo $this->session->flashdata('pesan'); ?>
                        <?php } ?>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('Pelanggan/pelanggan_register') ?>">
                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" name="nama_pelanggan" placeholder="Nama Pelanggan" autocomplete="off">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nomor_kwh">Nomor Meter</label>
                                            <input type="number" class="form-control" name="nomor_kwh" placeholder="Nomor Meter" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Daya</label>
                                            <select class="form-control selectric" name="id_tarif">
                                                <option value="" disabled selected>--Pilih--</option>
                                                <?php foreach ($tarif as $t) : ?>
                                                    <option value="<?= $t->id_tarif ?>"><?= $t->daya ?> Watt (Rp <?= number_format($t->tarifperkwh) ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="register" value="Register">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah punya akun? <a href="<?= base_url('Pelanggan') ?>">Login disini!</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; 2020 Ade Rusmana<div class="bullet"></div>All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stisla.js"></script>
    <script src="<?= base_url() ?>assets/js/page/auth-register.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>