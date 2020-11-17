<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <table id="basic-datatable" class="table dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>E-mail</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>                            
                <tbody>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url();?>';

    var table = $("#basic-datatable").DataTable(
        {
            "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('user/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1, 0, -2], //last column
                "orderable": false, //set not orderable
            }
        ],
            language:{
                paginate:{
                    previous:"<i class='uil uil-angle-left'>",next:"<i class='uil uil-angle-right'>"
                    }
                },
                drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        }
    );
    
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
</script>
