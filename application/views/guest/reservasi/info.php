<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div id="content">

                    <div class="card">
                        <div class="card-body">
                            <div class="wow fadeIn text-center" data-wow-duration="1s">
                                <p>
                                    <h5>Segera lakukan pembayaran sebelum tanggal <span class="text-danger"><?=  date('d-m-Y H:i', strtotime($reservasi->tanggal_berakhir_pembayaran)) ?></span> untuk melanjutkan langkah selanjutnya, sialahkan gunakan Kode pembayaran dibawah ini untuk mengkonfirmasi pembayaran anda :</h5>
                                </p>

                                <h1 class="text-info"><?= $reservasi->invoice ?></h1>
                                <p class="mt-3">Lakukan Konirmasi Pembayaran dengan menekan tombol <a href="<?= base_url('reservasi/konfirmasiPembayaran/'.$reservasi->id) ?>" class="btn btn-sm btn-info">Disini</a> . Terimakasih </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>