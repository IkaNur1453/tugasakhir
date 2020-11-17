<div class="row">
	<div class="col-md-12 col-xl-12">
		<div class="card">
			<div class="text-right mb-1 mt-4 mr-3">
                <button type="button" onclick="addForm()" class="btn btn-primary">Tambah Layanan</button>
            </div>
			<div class="card-body">
				<table class="table table-hover table-stripped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Layanan</th>
                            <th>Harga</th>
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

<!-- model form -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="form-horizontal" id="form">
				<div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
				</div>

				<div class="modal-body">
					<input type="hidden" id="id"  name="id_layanan">
                    <div class="form-group">
                        <label for="nama" class="col-md-3 control-label">layanan</label>
                        <div class="col-md-12">
                            <input id="layanan" required type="text" name="layanan" autofocus="autofocus" placeholder="layanan" class="form-control" maxlength="100" required="required">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga" class="col-md-3 control-label">Harga</label>
                        <div class="col-md-12">
                            <input id="harga" required type="texts" name="harga" autofocus="autofocus" placeholder="Harga" class="form-control" maxlength="100" required="required">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<button type="button" onclick="save()" class="btn btn-primary btn-save"><i class="fa fa-floopy-o"></i>Save</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
				</div>
			</form>
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
            "url": "<?php echo site_url('layanan/ajax_list')?>",
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

    function addForm(){
        save_method = "add";
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();             
        $('.modal-title').text('Tambah layanan');
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function editForm(id)
    {
        save_method = 'update';
        $('#modal-form form')[0].reset();
        $('#modal-form').modal('show');
        $('.modal-title').text('Ubah layanan');       
       

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('layanan/ajax_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
    
                $('[name="id_layanan"]').val(data.id_layanan);
                $('[name="layanan"]').val(data.nama_layanan);
                $('[name="harga"]').val(data.harga);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah layanan'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error get Data from ajax!'
            });
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;
     
        if(save_method == 'add') {
            url = "<?php echo site_url('layanan/ajax_add')?>";
        } else {
            url = "<?php echo site_url('layanan/ajax_update')?>";
        }
     
        // ajax adding data to database
        if($("#layanan").val() == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Mohon Isi layanan</a>'
            });

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
        else{
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(resp)
                {
                    $('#modal-form').modal('hide');
                    if(resp.msg == "fail"){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Maaf, layanan sudah pernah diinputkan'
                        });
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Disimpan !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                   
                    reload_table();
                   
                   
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Terjadi Masalah!',
                    });
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
         
                }
            });
        }

    }

    function deleteData(id){
        swal.fire({
            title: 'Are you sure to delete this ?',
            text: "you can't restore this after delete!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Delete this!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : "<?php echo site_url('layanan/ajax_soft_delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'layanan Berhasil Terhapus',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }
</script>