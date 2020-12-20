<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div id="content">

                    <div class="card">
                        <div class="card-body">
                            <div class="wow fadeIn" data-wow-duration="1s">
                                <p>
                                    <h3>Konfirmasi Pembayaran</h3>
                                </p>
                                <div class="content-align-center">
                                    <div class="col-md-6">  
                                        <form action="<?= base_url('reservasi/prosesKonfirmasi')?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" value="" placeholder="Nama">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('nama'); ?></div>
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" placeholder="E-mail" class="form-control" name="email" value="">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('email'); ?></div>
                                            <div class="form-group">
                                                <label>Tanggal Pembayaran</label>
                                                <input type="date" name="tanggal_pembayaran" class="form-control" value="<?= date('Y-m-d') ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah Pembayaran</label>
                                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pembayaran" value="">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('jumlah'); ?></div>
                                            <div class="form-group">
                                                <label>Bank Tujuan</label>
                                                <input type="text" name="bank_tujuan" class="form-control" placeholder="Bank Tujuan" value="">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('bank_tujuan'); ?></div>
                                            <div class="form-group">
                                                <label>Nama Rekening Pengirim</label>
                                                <input type="text" name="namaRek" placeholder="Nama Rekening Pengirim" class="form-control" value="">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('namaRek'); ?></div>
                                            <div class="form-group">
                                                <label>No Tagihan/Invoice</label>
                                                <input type="text" name="invoice" id="konfirmasi" placeholder="No Tagihan" class="form-control">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('invoice'); ?></div>
                                            <div class="form-group">
                                                <label>Pesan Tambahan</label>
                                                <textarea name="pesan" placeholder="Pesan Tambahan" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="text-danger"><?php echo form_error('pesan'); ?></div>
                                            <div class="form-group">
                                                <label>Bukti Transaksi</label>
                                                <input type="file" class="form-control" name="bukti">
                                            </div>
                                            <div class="text-danger"><?php echo form_error('bukti'); ?></div>
                                            
                                            <button type="submit" class="btn btn-lg btn-success"> <i class="fa fa-plane"></i>  Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('#konfirmasi').change(function(){
        var param = $('#konfirmasi').val();
        $.ajax({
            url: "<?= base_url('reservasi/getReservasiByInvoice') ?>",
            type: "POST",
            data: {
                invoice: param
                },
            dataType: "JSON",
            success:function(res)
            {
              if(res.status == 404)
              {
                toastr.error('Tidak menemukan Invoice atau Tagihan yang anda maksud');
              }
            }
        });
      
    });
</script>