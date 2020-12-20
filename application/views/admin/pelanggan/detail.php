<script src="https://cdn.jsdelivr.net/npm/echarts@4.9.0/dist/echarts.js"></script>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center mt-3">
                    <img src="<?= base_url('assets/admin/assets/images/users/avatar-1.jpg') ?>" alt=""
                        class="avatar-lg rounded-circle" />
                    <h5 class="mt-2 mb-0"><?= $user->nama ?> - <?= $user->username ?></h5>
                    <h6 class="text-muted font-weight-normal mt-2 mb-0">Pelanggan
                    </h6>
                    <h6 class="text-muted font-weight-normal mt-1 mb-4"><?= $user->alamat ?></h6>
                </div>
                <div class="mt-3 pt-2 border-top">
                    <h4 class="mb-3 font-size-15">Informasi Kontak</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0 text-muted">
                            <tbody>
                                <tr>
                                    <th scope="row">Telepon</th>
                                    <td><?= $user->no_hp ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td><?= $user->alamat ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail</th>
                                    <td><?= $user->email ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->

    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-activity-tab" data-toggle="pill"
                            href="#pills-activity" role="tab" aria-controls="pills-activity"
                            aria-selected="true">
                            Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-messages-tab" data-toggle="pill"
                            href="#pills-messages" role="tab" aria-controls="pills-messages"
                            aria-selected="false">
                            Diagram Aktivitas
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-activity" role="tabpanel"
                        aria-labelledby="pills-activity-tab">
                        <div class="left-timeline mt-3 mb-3 pl-4">
                            <ul class="list-unstyled events mb-0">
                                <?php if($reservasi): ?>
                                    <?php foreach($reservasi as $row): ?>
                                    <li class="event-list">
                                        <div class="pb-4">
                                            <div class="media">
                                                <div class="event-date text-center mr-4">
                                                    <div
                                                        class="bg-soft-primary p-1 rounded text-primary font-size-14">
                                                        <?= date('d M Y', strtotime($row->timestamp)) ?></div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="font-size-15 mt-0 mb-1"><?= $row->acara ?> - <?= date('d M Y', strtotime($row->tgl_pesan)) ?></h6>
                                                    <p class="text-muted font-size-14">Rp. <?= number_format($row->dp) ?>,00 - <?= $row->status ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- messages -->
                    <div class="tab-pane" id="pills-messages" role="tabpanel"
                    aria-labelledby="pills-messages-tab">
                        <h5 class="mt-3">Messages</h5>
                        <div id="main" style="width: 700px;height:400px;"></div>
                    </div>
                </div>
        </div>
        <!-- end card -->
    </div>
</div>

<script>
    var myChart = echarts.init(document.getElementById('main'));

    option = {
        tooltip:{
            show: true,
            trigger: 'axis',
            axisPointer:{
                type: 'shadow',
                animation: true
            }
        },
        color: '#5bc0de',
        xAxis: {
            type: 'category',
            data: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: [820, 932, 901, 934, 1290, 1330, 1320],
            type: 'line',
        }]
    };

    myChart.setOption(option);
</script>
<!-- end row -->