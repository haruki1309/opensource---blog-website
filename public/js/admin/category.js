var BASEURL =  window.location.origin+window.location.pathname;
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: BASEURL,
            type: 'GET',
        },
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false},
        ]
    });
 
    /*  When user click add user button */
    $('#create-new').click(function () {
        $('#id').val('');
        $('#infoform').trigger("reset");
        $('#ajax-modal').modal('show');
    });

    /* When click edit user */
    $('body').on('click', '.edit-row', function () {
        var id = $(this).data('id');

        $.get(BASEURL + '/'+ id +'/edit', function (data) {
            $('#name-error').hide();
            $('#ajax-modal').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
        })
    });

    $('body').on('click', '#delete-row', function () {

        var id = $(this).data("id");
        
        if(confirm("Bạn có chắc sẽ xóa chứ?")){
            $.ajax({
                type: "get",
                url: BASEURL + '/' + id + "/delete",
                success: function (data) {
                    if(data === 'error'){
                        alert('Dữ liệu có liên kết đến bảng khác, không thể xóa');
                    }
                    var oTable = $('#datatable').dataTable(); 
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    }); 
     
});
    
if ($("#infoform").length > 0) {
    $("#infoform").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            $.ajax({
                data: $('#infoform').serialize(),
                url: BASEURL + "/store",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#infoform').trigger("reset");
                    $('#ajax-modal').modal('hide');
                    $('#btn-save').html('Lưu');
                    var oTable = $('#datatable').dataTable();
                    oTable.fnDraw(false);
                         
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Lưu');
                }
            });
        }
    });
}
