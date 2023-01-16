<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Master Bank</h4>
                    <button class="btn btn-sm btn-add" onclick="add_data()"><i class="fa fa-plus"></i>
                        Add</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Bank
                                </th>
                                <th>
                                    Nama Cabang
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="defaultModalLabel">Master Bank</h4>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="recipient-name" name="nama">
                        <input type="hidden" name="id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save" onclick="save();">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
var table;
var save_method;
var sweet_loader = '<div class="sweet_loader"><div class="spinner-border text-primary"></div></div>';

function add_data() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal').modal('show'); // show bootstrap modal when complete loaded  
}

function edit_data(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('bank/getbank_byid/')?>" + id,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            Swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                onRender: function() {
                    // there will only ever be one sweet alert open.
                    $('.swal2-content').prepend(sweet_loader);
                }
            });
        },
        success: function(data) {
            Swal.close();
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('#modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Update bank'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.close();
            Swal.fire('Error!', 'Error get data from ajax', 'error');

        }
    });

    return false;
}

function save() {
    var url;
    if (save_method == 'add') {
        url = "<?php echo site_url('bank/bank_add')?>";
    } else {
        url = "<?php echo site_url('bank/bank_update')?>/" + $('input[name="id"]').val();
    }
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            // there will only ever be one sweet alert open.
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                success: function(data) {
                    Swal.close();
                    Swal.fire(
                        'Saved!',
                        'Your file has been saved.',
                        'success'
                    );

                    table.ajax.reload();
                    $('#modal').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //alert('Error adding / update data');
                    Swal.close();
                    Swal.fire(
                        'Error!',
                        jqXHR.responseText,
                        'error'
                    )
                }
            });

            //location.reload(); // for reload a page
            return false;
        }
    })


}

function delete_data(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?php echo site_url('bank/bank_delete/') ;?>" + id,
                type: "POST",
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        onRender: function() {
                            // there will only ever be one sweet alert open.
                            $('.swal2-content').prepend(sweet_loader);
                        }
                    });
                },
                success: function(data) {
                    Swal.close();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );


                    table.ajax.reload();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //alert('Error adding / update data');
                    Swal.fire(
                        'Error!',
                        jqXHR.responseText,
                        'error'
                    )
                }

            });
            //location.reload(); // for reload a page
            return false;
        }
    });
    return false;
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('branchbank/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],

    });

});
</script>