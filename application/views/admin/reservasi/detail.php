
<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <div class="card-body">
                <h4>Informasi Reservasi</h4>

                <table class="mb-5 mt-5">
                    <tr height="30px">
                        <th width="150px">Nama</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"> <?= $reservasi->nama ?></th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Acara</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $reservasi->acara ?></th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Kabupaten</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $reservasi->nama_kabupaten ?></th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Alamat</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $reservasi->alamat ?></th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Tanggal Pesan</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= date('d/m/Y', strtotime($reservasi->tgl_pesan)) ?></th>
                    </tr>   
                    <tr height="30px">
                        <th width="150px">Tanggal Expire Pembayaran</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= date('d/m/Y', strtotime($reservasi->tanggal_berakhir_pembayaran)) ?></th>
                    </tr>   
                    <tr height="30px">
                        <th width="150px">DP</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px">Rp.<?= number_format($reservasi->dp) ?>,00</th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Status Reservasi</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px">
                            <select name="status" class="form-control" id="">
                                <option value="belum" <?=$reservasi->status == 'belum' ? 'selected' : ''?>>Belum</option>
                                <option value="belum" <?=$reservasi->status == 'menunggu' ? 'selected' : ''?>>Menunggu</option>
                                <option value="sudah" <?=$reservasi->status == 'sudah' ? 'selected' : ''?>>Sudah</option>
                            </select>
                        </th>
                    </tr>
                </table>
            </div>
       </div>
       <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#home" data-toggle="tab" aria-expanded="false"
                        class="nav-link active">
                        <span class="d-block d-sm-none"><i class="uil-home-alt"></i></span>
                        <span class="d-none d-sm-block">Detail Reservasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile" data-toggle="tab" aria-expanded="true"
                        class="nav-link">
                        <span class="d-block d-sm-none"><i class="uil-user"></i></span>
                        <span class="d-none d-sm-block">Bukti Pembayaran</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane show active" id="home">
                    <h4>Detail Reservasi</h4>
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($detailReservasi as $row): ?>
                            <tr>
                                <td><?= $row->layanan ?></td>
                                <td>Rp.<?= number_format($row->harga) ?>,00</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><b>Total Harga + Kabupaten (Rp. <?= number_format($reservasi->harga) ?>,00)</b></td>
                                <td>
                                    <?php
                                        $arrayHargaLayanan = array_column($detailReservasi, 'harga');
                                        array_push($arrayHargaLayanan, $reservasi->harga);

                                        $arrayTotal = array_sum($arrayHargaLayanan);

                                        echo "Rp.". number_format($arrayTotal).",00";

                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="profile">
                    <h4>Data Pembayaran</h4>
                    <?php if($konfirmasi):  ?>
                        <table class="mb-5 mt-5">
                            <tr height="30px">
                                <th width="150px">Nama Pengirim</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"> <?= $konfirmasi->nama ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">E-mail</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $konfirmasi->email ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">Tanggal pembayaran</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?=  date('d/m/Y', strtotime($konfirmasi->tanggal_pembayaran))  ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">Jumlah Pembayaran</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= number_format($konfirmasi->jumlah) ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">Nama Bank Pengirim</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $konfirmasi->bank ?></th>
                            </tr>   
                            <tr height="30px">
                                <th width="150px">Nama Pemilik Rekening</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $konfirmasi->nama_rek ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">No Invoice</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $konfirmasi->no_invoice ?></th>
                            </tr>
                            <tr height="30px">
                                <th width="150px">Pesan</th>
                                <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= $konfirmasi->pesan ?></th>
                            </tr>
                        </table>

                        <img src="<?= base_url('uploads/bukti_bayar/'.$konfirmasi->bukti_pembayaran) ?>" class="img img-responsive" alt="">
                    <?php else: ?>
                        <h5 class="text-danger">Maaf Belum ada konfirmasi Pembayaran dari pihak terkait</h5>
                    <?php endif; ?>
                </div>
            </div>

       </div>
    </div>
</div>

<script>
    $('[name="status"]').change(function(){
        let status = $(this).val();

        $.ajax({
            url: "<?= base_url('reservasi/updateKonfirmasi/'.$reservasi->id) ?>",
            type: "POST",
            data: {status_pembayaran : status},
            dataType: "JSON",
            success:function(res)
            {
                console.log(res.status);
                if(res.status == "201")
                {
                    toastr.success('Data berhasil diubah');
                }
            }  
        });
    });
</script>


<!-- end row -->