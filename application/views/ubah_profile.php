<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- <title>Reset Password &mdash; Stisla</title> -->
    <title><?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url() ?>assets/assets_shop/img/logobrc.ico">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/assets_stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/assets_stisla/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?= base_url() ?>/assets/assets_stisla/assets/img/logobrc.png" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>
                        
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Ubah Profile</h4>
                            </div>
                            
                            <div class="card-body">
                            <?= $this->session->flashdata('pesan') ?>
                            <?= $this->session->unset_userdata('pesan') ?>
                                <form method="POST" action="<?= base_url('auth/ubah_profile_aksi'); ?>" autocomplete="off" enctype="multipart/form-data">
                                <?php foreach ($user as $us) : ?>
                                    <div class="form-group">
                                        <label for="email_baru">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" id="email" class="form-control pwstrength" value="<?= $us->email ?>" tabindex="2" readonly>
                                        </div>
                                        <?= form_error('email', '<div class="text-small text-danger">', '</div>') ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nama_baru">Nama</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="nama_baru" id="nama_baru" class="form-control pwstrength" value="<?= $us->nama; ?>" tabindex="2" autofocus>
                                            <div class="invalid-feedback">
														Nama Tidak Boleh Kosong
											</div>
                                        </div>
                                        <?= form_error('nama_baru', '<div class="text-small text-danger">', '</div>') ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat_baru">Alamat</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                            </div>
                                            <textarea type="text" name="alamat_baru" id="alamat_baru" class="form-control pwstrength" tabindex="2" data-height="150" autofocus><?= $us->alamat; ?></textarea>
                                        </div>
                                        <?= form_error('alamat_baru', '<div class="text-small text-danger">', '</div>') ?>
                                    </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password_baru">Password Baru</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password_baru" id="password_baru" class="form-control" autofocus>
                                        </div>
                                        <span>Kosongkan Jika Tidak Ingin Mengubah</span>
                                        <?= form_error('password_baru', '<div class="text-small text-danger">', '</div>') ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password_baru">Confirm Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                                        </div>
                                        <span>Kosongkan Jika Tidak Ingin Mengubah</span>
                                        <?= form_error('password_confirm', '<div class="text-small text-danger">', '</div>') ?>
                                    </div>
                                </div>
                            </div>

                           <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <br>
                                    <a href="<?= base_url() . 'assets/upload/gambar_user/' . $us->gambar_user ?>">
                                        <img src="<?= base_url() . 'assets/upload/gambar_user/' . $us->gambar_user ?>" width="150px">
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="gambar_user">Pilih File</label>
                                    <input type="file" name="gambar_user" id="gambar_user" accept="image/png, image/jpg, image/jpeg" class="form-control">
                                </div>
                            </div>
                        </div>
                                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Ubah Profile
                                        </button>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <a href="<?= $_SESSION['level'] == 1 ? base_url('admin/dashboard') : base_url('customer/dashboard'); ?>">Kembali.</a>
                                    </div>

                                </form>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; <a href="https://github.com/stisla/stisla">Stisla </a>
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/assets/assets_stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/assets/assets_stisla/assets/js/custom.js"></script>
    
</body>

<script type="text/javascript"> 
    $(document).ready(function() {
        $('.alert').fadeIn(300).fadeOut(2000);
    });
</script>

</html>