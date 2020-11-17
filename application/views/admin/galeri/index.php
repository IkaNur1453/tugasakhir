<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="text-right mb-1 mt-4 mr-3">
                <button type="button" onclick="addForm()" class="btn btn-primary">Tambah Galeri</button>
            </div>
            <div class="card-body">
            <table id="basic-datatable" class="table dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
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
            "url": "<?php echo site_url('galeri/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1, 0], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -3 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
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

    function addForm()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Galeri'); // Set Title to Bootstrap modal title
    
        $('#photo-preview').hide(); // hide photo preview modal
    
        $('#label-photo').text('Upload Photo'); // label photo upload
    }

    function editForm(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
    
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('galeri/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
    
                $('[name="id"]').val(data.id);
                $('[name="judul"]').val(data.judul);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah galeri'); // Set title to Bootstrap modal title

                $('#photo-preview').show(); // show photo preview modal
 
                if(data.file)
                {
                    $('#label-photo').text('Ganti Gambar'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'uploads/galeri/'+data.file+'" class="img-thumbnail"><br/>'); // show photo
                }
                else
                {
                    $('#label-photo').text('Upload Gambar'); // label photo upload
                    $('#photo-preview div').text('(Tidak ada Gambar)');
                }
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error get data from ajax!'
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
            url = "<?php echo site_url('galeri/ajax_add')?>";
        } else {
            url = "<?php echo site_url('galeri/ajax_update')?>";
        }
    
        // ajax adding data to database
    
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
    
                if(data.status) //if success close modal and reload ajax table
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Simpan',
                        text: 'data anda berhasil disimpan'
                    });
                    $('#modal_form').modal('hide');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ada kesalahan silahkan cek kembali'
                    });
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
    
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
    
            }
        });
    }

    function deleteData(id)
    {
        Swal.fire({
            title: 'Yakin menghapus data ini ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus saja!'
            }).then((result) => {
            if (result.isConfirmed) {
                 // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('galeri/ajax_soft_delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil dihapus',
                            text: 'data anda berhasil dihapus'
                        });
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        })
    }

</script>

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Judul</label>
                            <div class="col-md-12">
                                <input name="judul" placeholder="Judul" class="form-control" type="text">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deskripsi</label>
                            <div class="col-md-12">
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" cols="30" rows="10"></textarea>
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Gambar</label>
                            <div class="col-md-12">
                                (No photo)
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Photo </label>
                            <div class="col-md-9">
                                <input name="gambar" type="file">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
