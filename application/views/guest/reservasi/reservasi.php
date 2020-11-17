<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12 text-center content-align-center">
                <div class="wow fadeIn" data-wow-duration="1s">
                    <p>
                        <h1>Layanan</h1>
                    </p>
                    <p>Istilah Karawitan ini sering diucapkan, baik dalam konteks diskusi, seminar, pembelajaran kompo- sisi musik, maupun obrolan santai di warung kopi. Kami menyediakan beberapa layanan untuk acara dan kegiatan anda. Berikut adalah list layanan yang kami sediakan :
                    </p>
                    <?php if($galeri):  ?>
                        <div class="row">
                            <?php foreach($galeri as $galeri): ?>
                            <div class="col-md-3 col-xs-3 ml-3 mb-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?= base_url('uploads/galeri/'.$galeri->file) ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= ucfirst($galeri->judul) ?></h5>
                                        <p class="card-text"><?= $galeri->deskripsi ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <h5>Tidak ada Foto Galeri Tersedia</h5>
                    <?php endif; ?>
                </div>
                <?php if($this->session->userdata("is_logged_in") == true): ?>
                <div class="text-center">
                        <a href="<?= base_url('reservasi/create') ?>" class="btn d-block btn-primary">Pesan Sekarang</a>
                </div>
                <?php endif; ?>
        </div>
    </div>
</section>