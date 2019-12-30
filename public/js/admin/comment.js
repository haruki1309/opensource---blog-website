var BASEURL =  window.location.origin+window.location.pathname;
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#dataTable1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: BASEURL + "/unmoderated",
            type: 'GET',
        },
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            {data: 'posttitle'},
            {data: 'username'},
            {data: 'comment'},
            {data: 'action', name: 'action', orderable: false},
        ]
    });

    $('#dataTable2').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: BASEURL + "/moderated",
            type: 'GET',
        },
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            {data: 'posttitle'},
            {data: 'username'},
            {data: 'comment'},
        ]
    });
 

    /* When click edit user */
    $('body').on('click', '.edit-row', function () {
        var id = $(this).data('id');

        $.ajax({
            type: "get",
            url: BASEURL + '/' + id + "/edit",
            success: function (data) {
                var oTable1 = $('#dataTable1').dataTable(); 
                oTable1.fnDraw(false);

                var oTable2 = $('#dataTable2').dataTable(); 
                oTable2.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '#delete-row', function () {

        var id = $(this).data("id");
        
        if(confirm("Bạn có chắc sẽ xóa chứ?")){
            $.ajax({
                type: "get",
                url: BASEURL + '/' + id + "/delete",
                success: function (data) {
                    var oTable = $('#dataTable1').dataTable(); 
                    oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    }); 
     
});

