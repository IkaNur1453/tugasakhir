<section class="faculty-area section-gap">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12 text-center content-align-center">
                <div class="wow fadeIn" data-wow-duration="1s">
                    <p>
                        <h1>Form Pendaftaran Reservasi</h1>
                    </p>
                    <form method="POST" action="<?= base_url('reservasi/create') ?>">
                        <div class="card text-center p-3" style="opacity:0.7">
                            <h3>Form Pendaftaran Reservasi</h3>
                            <div class="row">
                                <div class="text-left col-xs-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" readonly value="<?= $user->nama ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>No Telepon</label>
                                            <input type="text" class="form-control" readonly value="<?= $user->no_hp ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="text" class="form-control" readonly value="<?= $user->email ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Acara</label>
                                            <input type="text" class="form-control" name="acara" placeholder="Acara">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Reservasi</label>
                                            <input type="date" name="tanggal_reservasi" class="form-control" min="<?= date('Y-m-d') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten</label>
                                            <select id="kabupaten" onchange="getKabupatenById()" name="kabupaten" class="form-control">
                                                <option value="">--- PILIH KABUPATEN ---</option>
                                                <?php foreach($kabupaten as $kabupaten): ?>
                                                    <option data-price="<?= $kabupaten->harga ?>" value="<?=$kabupaten->id_kabupaten?>"><?=$kabupaten->nama_kabupaten?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php echo form_error('kabupaten'); ?>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat Acara" cols="30" rows="10"></textarea>
                                        </div>
                                        <?php echo form_error('alamat'); ?>
                                </div>
                                <div class="text-left col-xs-4 col-md-4 col-lg-4">
                                    <table class="table mt-2 tbl-bordered tbl-hover">
                                        <thead>
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($layanan as $layanan): ?>
                                            <tr>
                                                <td><input type="checkbox" name="layanan[]" id="layanan" class="layanan" value="<?=$layanan->id_layanan?>"> <?= $layanan->nama_layanan ?></td>
                                                <td>Rp. <?= number_format($layanan->harga)?>,00</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>