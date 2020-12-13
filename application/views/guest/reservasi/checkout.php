<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div id="content">

                    <div class="card">
                        <div class="card-body">
                            <div class="wow fadeIn text-center" data-wow-duration="1s">
                                <p>
                                    <h1>Pembayaran</h1>
                                </p>
                            </div>
                        <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php foreach($detailReservasi as $row): ?>
                        <tr style="line-height:70px;">
                            <td><?= $row->layanan ?></td>
                            <th>Rp. <?= number_format($row->harga) ?>,00</th>
                        </tr>
                        <?php endforeach; ?>
                        <tr style="line-height:70px;">
                            <td><?= $reservasi->nama_kabupaten ?> (Akomodasi)</td>
                            <th>Rp. <?= number_format($reservasi->harga) ?>,00</th>
                        </tr>
                        <tr style="line-height:70px;">
                            <th>Total</th>
                            <th>Rp. <?= number_format($totalPembayaran) ?>,00</th>
                        </tr>
                    </tbody>
                  </table>
                    <hr>
                    <h3>Pembayaran</h3>
                    <hr>
                  <form action="<?= base_url('reservasi/checkout/'.$reservasi->id) ?>" method="post">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Metode Pembayaran</label><br>
                                <input type="radio" name="pembayaran" value="transfer"> Transfer
                                <br> 
                                <input type="radio" name="pembayaran" value="ditempat"> Di Tempat
                            </div>
                            <div class="text-danger"><?php echo form_error('pembayaran'); ?></div> 
                        </div>
                        <div class="col-md-10">
                            <div class="form-group hidden">
                                <label for="">Dp</label>
                                <input type="hidden" name="dp" value="<?=$totalPembayaran*(5/100)?>"><br>
                                <h3>Rp. <?= number_format($totalPembayaran*(5/100)) ?>,00</h3>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                            <a href="<?= base_url('home') ?>" class="btn btn-danger">Kembali</a>
                        </div>
                  </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>