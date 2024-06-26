    <!--== SlideshowBg Area Start ==-->
    <section id="slideslow-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="slideshowcontent">
                        <div class="display-table">
                        <div class="display-table-cell">
                                <h1 class="animation-waves">
                                    <span>BASKORO RENT CAR</span>
                                    <span>BASKORO RENT CAR</span>
                                </h1><br>
                                <p>JASA SEWA MOBIL DI DEPOK <br> DENGAN HARGA YANG TERJANGKAU</p>
                                <img src="<?= base_url('assets/assets_stisla') ?>/assets/img/logobrc.png" width="250" class="ml-3 mt-4" alt="JSOFT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== SlideshowBg Area End ==-->

    <!--== Choose Car Area Start ==-->
    <section id="choose-car" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Mobil Yang Kami Sediakan</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                    </div>
                    <div class="text-center" style="position: relative; height: 65px; bottom: 65px">
                        <a class="rent-btn text-center" href="<?= base_url('customer/dashboard/list_mobil')?>"  data-toggle="tooltip" data-placement="top" title="Sewa Mobil">Sewa Mobil Sekarang</a>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <!-- Choose Area Content Start -->
                <div class="col-lg-12">
                    <div class="choose-ur-cars">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Choose Cars Content-wrap -->
                                <div class="row popular-car-gird">

                                    <!-- Single Popular Car Start -->
                                    <?php foreach ($mobil as $mb) : ?>
                                        <div class="col-lg-6 col-md-6 con suv mpv">
                                            <div class="single-popular-car">
                                                <div class="p-car-thumbnails">
                                                    <a class="car-hover" href="<?= base_url() . 'assets/upload/mobil/' . $mb->gambar ?>">
                                                        <img src="<?= base_url() . 'assets/upload/mobil/' . $mb->gambar ?>" alt="JSOFT" style="height: 320px; width: 540px">
                                                    </a>
                                                </div>

                                                <div class="p-car-content">
                                                    <h3>
                                                        <a href="<?= base_url('customer/dashboard/detail_mobil/') . $mb->id_mobil ?>"><?= $mb->merk ?></a>
                                                        <span class="price" style="color: #014782"><i class="fa fa-tag"></i> <?= format_rupiah($mb->harga) ?> / hari</span>
                                                    </h3>

                                                    <h5><?= $mb->nama_type ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- Single Popular Car End -->

                                </div>
                                <!-- Choose Cars Content-wrap -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Choose Area Content End -->
            </div>
        </div>
    </section>
    <!--== Choose Car Area End ==-->