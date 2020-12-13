
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
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px"><?= date('Y/m/d', strtotime($reservasi->tgl_pesan)) ?></th>
                    </tr>   
                    <tr height="30px">
                        <th width="150px">DP</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px">Rp.<?= number_format($reservasi->dp) ?>,00</th>
                    </tr>
                    <tr height="30px">
                        <th width="150px">Status Reservasi</th>
                        <th style="border-bottom:1px solid #D1DBE0;" width="800px">
                            <select name="" class="form-control" id="">
                                <option value="belum" <?=$reservasi->status == 'belum' ? 'selected' : ''?>>Belum</option>
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
                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                        dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend
                        tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                        ac, enim.</p>
                    <p class="mb-0">Vakal text here dolor sit amet, consectetuer adipiscing
                        elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis
                        natoque penatibus et magnis dis parturient montes, nascetur
                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu,
                        pretium quis, sem. Nulla consequat massa quis enim.</p>
                </div>
            </div>

       </div>
    </div>
</div>


<!-- end row -->