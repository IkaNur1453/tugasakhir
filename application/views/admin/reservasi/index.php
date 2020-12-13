<div class="row">
	<div class="col-md-12 col-xl-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-stripped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
                            <th>Acara</th>
							<th>Tanggal Pesan</th>
                            <th>Kabupaten</th>
                            <th>Alamat</th>
                            <th>DP</th>
                            <th>Status</th>
                            <th>Aksi</th>
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

    table = $('.table').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"responsive": true,
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('reservasi/ajax_list')?>",
            "type": "POST"
        },

		 //Set column definition initialisation properties.
		 "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ], 
	});

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
</script>