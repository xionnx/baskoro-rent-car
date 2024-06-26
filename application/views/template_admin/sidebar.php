<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="javascript:;" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="javascript:;" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle">
              <i class="far fa-envelope-open"></i>
              <span class="badge badge-danger badge-counter">
                <?php $query = $this->db->query('select status from pesan where status = 0');
                echo $query->num_rows($query) ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header" style="font-size: 15px;color: #fff; background-color: #6777ef;">Pesan Masuk</div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="<?= base_url('admin/data_pesan') ?>" class="dropdown-item dropdown-item-unread">

                  <?php foreach ($pesan as $psn) :
                    if ($psn->status == 0) :
                  ?>

                      <div class="dropdown-item-avatar">
                        <img alt="image" src="<?= base_url() . 'assets/upload/gambar_user/' . $psn->gambar_user; ?>" class="rounded-circle" style="margin-right: 5px; width: 45px; height: 45px; object-fit: fill;">
                      </div>
                      <div class="dropdown-item-desc">
                        <!-- nama -->
                        <p style="font-weight: 800; font-size: 15px; margin-bottom:-8px;"><?= $psn->nama ?></p>
                        <!-- pesan -->
                        <p class="mb-3"><?= $psn->isi_pesan ?></p>
                      </div>

                    <?php endif ?>
                  <?php endforeach; ?>

                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="<?= base_url('admin/data_pesan') ?>">Lihat Detail <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="javascript:;" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
              <i class="far fa-bell"></i>
              <span class="badge badge-danger badge-counter">
                <?php $query = $this->db->query('select status_pembayaran from transaksi where status_pembayaran = 1');
                echo $query->num_rows($query) ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header" style="font-size: 15px;color: #fff; background-color: #6777ef;">Notifikasi Transaksi</div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="<?= base_url('admin/transaksi/menunggu_konfirmasi') ?>" class="dropdown-item dropdown-item-unread">

                  <?php foreach ($transaksi as $trans) :
                    if ($trans->status_pembayaran == 1) :
                  ?>

                      <div class="dropdown-item-avatar ">
                        <img alt="image" src="<?= base_url() . 'assets/upload/gambar_user/' . $trans->gambar_user; ?>" style="width: 50px; margin-top: 8px; border-radius: 10px;">
                      </div>
                      <div class="dropdown-item-desc pb-0">
                        <!-- nama -->
                        <p style="font-weight: 800; font-size: 15px; margin-bottom:-8px;"><?= $trans->nama ?></p>
                        <!-- pesan -->
                        <p style="margin-bottom:-8px;"><?= $trans->merk ?></p>
                        <p>Total Sewa : <?= format_rupiah($trans->total_sewa) ?></p>
                        <p></p></br>
                      </div>

                    <?php endif ?>
                  <?php endforeach; ?>

                </a>
              </div>
              <div class="mb-2 mt-2 text-center">
                <a href="<?= base_url('admin/transaksi/menunggu_konfirmasi') ?>">Lihat Detail <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a href="javascript:;" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url() . 'assets/upload/gambar_user/' . $_SESSION['gambar_user']; ?>" class="rounded-circle mr-1" style="width: 40px; height: 40px;">
              <div class="d-sm-none d-lg-inline-block">Halo, <?= $_SESSION['nama'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url('auth/ubah_profile/' . $_SESSION['id_user']); ?>" class="dropdown-item has-icon">
                <i class="fas fa-unlock"></i> Ubah Profile
              </a>
              <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger tombol-keluar">
                <i class="fas fa-sign-out-alt"></i> Log Out
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('admin/dashboard') ?>"><img src="<?= base_url('assets/assets_stisla') ?>/assets/img/logobrc.png" height="45" width="45" alt=""> rental mobil</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('admin/dashboard') ?>"><img src="<?= base_url('assets/assets_stisla') ?>/assets/img/logobrc.png" height="45" width="45" style="margin-top: 10px;" alt=""></a>
          </div>
          <ul class="sidebar-menu">
            <li><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a class="nav-link" href="<?= base_url('admin/data_mobil') ?>"><i class="fas fa-car"></i> <span>Data Mobil</span></a></li>
            <li><a class="nav-link" href="<?= base_url('admin/data_type') ?>"><i class="fas fa-pencil-ruler"></i> <span>Data Type</span></a></li>

            <li class="nav-item dropdown">
              <a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-money-check-alt"></i> <span>Transaksi</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url('admin/transaksi') ?>">Data Transaksi</a></li>
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/menunggu_pembayaran') ?>">Menunggu Pembayaran</a></li>
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/menunggu_konfirmasi') ?>">Menunggu Konfirmasi</a></li>
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/sedang_disewa') ?>">Sedang Disewa</a></li>
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/selesai') ?>">Transaksi Selesai</a></li>
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/batal') ?>">Transaksi Batal</a></li>
              </ul>
            </li>

            <li><a class="nav-link" href="<?= base_url('admin/data_user') ?>"><i class="far fa-user"></i> <span>Data User</span></a></li>

            <li class="nav-item dropdown">
              <a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i> <span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url('admin/transaksi/laporan') ?>">Transaksi</a></li>
              </ul>
            </li>

            <li><a class="nav-link" href="<?= base_url('admin/data_pesan') ?>"><i class="far fa-comment-dots"></i> <span>Data Pesan</span></a></li>

          </ul>
        </aside>
      </div>