<!--== Page Title Area Start ==-->
<section id="page-title-area" class="section-padding overlay">
    <div class="container">
        <div class="row">
            <!-- Page Title Start -->
            <div class="col-lg-12">
                <div class="section-title  text-center">
                    <h2>Konfirmasi Pembayaran</h2>
                    <span class="title-line"><i class="fa fa-car"></i></span>
                </div>
            </div>
            <!-- Page Title End -->
        </div>
    </div>
</section>
<!--== Page Title Area End ==-->

<!--== Contact Page Area Start ==-->
<div class="contact-page-wrao section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card bg-light" style="width: 400px; margin: auto;">
                    <div class="card-body">
                        <form action="<?= base_url('customer/rental/konfirmasi_pembayaran_simpan') ?>" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                                <h5 class="mb-3">Upload Bukti Pembayaran</h5>
                                <table>
                                    <tr>
                                        <td class="pr-3">Untuk Mobil</td>
                                        <td class="pr-3">:      <?= $mobil->merk ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-3">Dengan Total Biaya Sewa</td>
                                        <td class="pr-3">:      <?= format_rupiah($data_transaksi->total_sewa); ?></td>
                                    </tr>
                                </table>
                                <br>
                                <b>*Silahkan transfer Total Biaya Sewa ke 123456789 Bank BCA a/n RAMADHAN ARIFIYANTO maksimal tanggal <?= $batas_bayar ?>.</b>
                                <br>
                                <br>
                                <b>Jika status pembayaran Ditolak.</b><br>
                                <b>Pastikan bukti pembayaran terlihat jelas dan valid, karena admin akan meninjau bukti pembayaran terlebih dahulu.</b>
                                <br>
                                <input type="file" name="bukti_pembayaran" class="form-control" accept="image/png, image/jpg, image/jpeg" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-warning mt-3 float-right">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--== Contact Page Area End ==-->