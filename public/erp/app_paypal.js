var pendingtotal = 0;
var completedtotal = 0;
//for dataTable data
var InitTable = function () {
    pendingtotal = 0;
    completedtotal = 0;
    var table = $('#table_data').DataTable({
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;

            $.each(data, function (index, value) {
                var status = data[index].status;
                status = status.replace(/<[^>]*>/g, '');
                if (status == 'Pending') {
                    pendingtotal = pendingtotal + parseFloat(data[index].amount);
                } else {
                    completedtotal = completedtotal + parseFloat(data[index].amount);
                }
            });
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            pageTotal = api
                .column(2, {page: 'current'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                'Total: ' + pageTotal + ' | Pending Total : ' + pendingtotal + ' | Completed Total: ' + completedtotal
            );
        },
        "pageLength": 100,
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": dataTableRoute,
            "dataType": "json",
            "type": "POST",
            "data": {_token: token, 'filterdata': filterdata}
        },
        "columns": data,
    });
}

// for Form insert data

$('#add-form-btn').on('click', function (e) {
    var data = $('#add-form').serializeArray();
    event.preventDefault();
    $.ajax({
        data: data,
        type: $('#add-form').attr('method'),
        url: $('#add-form').attr('action'),
        success: function (response) {
            if (response.errors) {
                $.each(response.errors, function (index, value) {
                    $("." + index).html(value);
                    $("." + index).fadeIn('slow', function () {
                        $("." + index).delay(3000).fadeOut();
                    });
                });
                var success = $("." + index);
                scrollTo(success, -100);
            } else {
                InitTable();
                $('.success').html(response);
                $('#success').show();
                $('#add-form')[0].reset();
                var succ = $('.success');
                scrollTo(succ, -100);
            }
        }
    });
});


// for edit form
$(document).on('click', '.edit', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        "url": editRoute,
        type: "POST",
        data: {'id': id, _token: token},
        dataType: "json",
        success: function (data) {
            $.each(data, function (index, value) {
                $('#edit_' + index).val(value);

            });
            var success = $('#add-form');
            scrollTo(success, -100);
        },
        error: function () {
        },
    });
});

// code for add form modal show
$(document).on('click', '.addModelbtn', function () {
    $('#addModel').modal('show');
    $('#add_form')[0].reset();
    $('#edit_id').val("");
});

//close alert message
$(document).on('click', '.close', function () {
    $('.alert').hide();
});

// code for add form
$('#add_form_btn').on('click', function (e) {
    event.preventDefault();
    var form = $('#add_form')[0];
    var formData = new FormData(form);
    var data = $('#add_form').serializeArray();

    $.ajax({
        data: formData,
        type: $('#add_form').attr('method'),
        url: $('#add_form').attr('action'),
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.errors) {
                $.each(response.errors, function (index, value) {
                    $("." + index).html(value);
                    $("." + index).fadeIn('slow', function () {
                        $("." + index).delay(3000).fadeOut();
                    });
                });
            } else {
                InitTable();
                $('.success').html(response);
                $('#success').show();
                $('#add_form')[0].reset();
                $('#addModel').modal('hide');
            }
        }
    });
});


$(document).on('click', '.edit_model', function () {

    var id = $(this).attr('data-id');
    $.ajax({
        "url": editRoute,
        type: "POST",
        data: {'id': id, _token: token},
        dataType: "json",
        success: function (data) {

            $.each(data, function (index, value) {
                $('#edit_' + index).val(value);
            });

            $('#addModel').modal('show');
        },
        error: function () {
        },
    });

});

$(document).on('click', '.edit_diff_model', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        "url": editRoute,
        type: "POST",
        data: {'id': id, _token: token},
        dataType: "json",
        success: function (data) {

            $.each(data, function (index, value) {
                $('#edit_' + index).val(value);
            });

            $('#edit_diff_model').modal('show');
        },
        error: function () {
        },
    });
});

// code for edit different model form
function EditDifferentModel(editDiffFormId, editDiffFormModel) {
    var data = $(editDiffFormId).serializeArray();
    event.preventDefault();
    $.ajax({
        data: data,
        type: $(editDiffFormId).attr('method'),
        url: $(editDiffFormId).attr('action'),
        success: function (response) {
            if (response.errors) {
                $.each(response.errors, function (index, value) {
                    $(".edit_" + index).html(value);
                    $(".edit_" + index).fadeIn('slow', function () {
                        $(".edit_" + index).delay(3000).fadeOut();
                    });
                });

            } else {
                InitTable();
                $('.success').html(response);
                $('#success').show();
                $(editDiffFormId)[0].reset();
                $(editDiffFormModel).modal('hide');

            }
        }
    });
}


// code for active and disable

$(document).on('click', '.disable', function () {
    swal({
        title: "Are you sure?",
        text: "Are you sure want to change the status to pending? It may effect your calculations.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": disableRoute,
                    type: "POST",
                    data: {'id': id, _token: token},
                    dataType: "json",
                    success: function (response) {
                        InitTable();
                        $('.delete').html(response);
                        $('#delete').show();
                    },
                    error: function () {
                    },
                });
            } else {
                //swal("Your data is safe!");
            }
        });
});

$(document).on('click', '.active', function () {

    swal({
        title: "Are you sure?",
        text: "Are you sure want to change the status to completed?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": activeRoute,
                    type: "POST",
                    data: {'id': id, _token: token},
                    dataType: "json",
                    success: function (response) {
                        InitTable();
                        $('.success').html(response);
                        $('#success').show();
                    },
                    error: function () {
                    },
                });
            } else {
                //swal("Your data is safe!");
            }
        });

});

$(document).on('click', '.delete', function () {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).attr('data-id');
                $.ajax({
                    "url": deleteRoute,
                    type: "POST",
                    data: {'id': id, _token: token},
                    dataType: "json",
                    success: function (response) {
                        InitTable();
                        $('.delete').html(response);
                        $('#delete').show();
                    },
                    error: function () {
                    },
                });
            } else {
                //swal("Your data is safe!");
            }
        });

});

