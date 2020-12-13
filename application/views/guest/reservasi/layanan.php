<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="wow fadeIn" data-wow-duration="1s">
                    <p>
                        <h1>Form Pilih Layanan</h1>
                    </p>
               </div>
                <div id="content">
                    <form method="POST" action="<?= base_url('reservasi/create') ?>">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-xs-9">
                                <div class="row">
                                    <?php foreach($layanan as $layanan): ?>
                                        <div class="col-md-4">
                                            <div class="card mt-2">
                                                <div class="card-header">
                                                    <div class="form-group">
                                                    <input type="checkbox" name="idLayanan" value="<?= $layanan->id_layanan ?>"> <h3><?= $layanan->nama_layanan ?></h3> 
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                    <h4>Rp. <?= number_format($layanan->harga) ?>,00</h4>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                            <h1>HHH</h1>
                            </div>
                            <div class="text-center mt-2">
                                <button type="submit" class="btn d-block btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>