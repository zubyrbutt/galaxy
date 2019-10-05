//for dataTable data
var InitTable = function () {

    var table = $('#table_data').DataTable({
        "pageLength": 50,
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
    //     initComplete: function () {
        //     //     this.api().columns().every(function () {
        //     //         var column = this;
        //     //         var input = document.createElement("input");
        //     //         $(input).appendTo($(column.footer()).empty())
        //     //             .on('change', function () {
        //     //                 column.search($(this).val(), false, false, true).draw();
        //     //             });
        //     //     });
        //     // },
        "scrollX": true,
        // "order": [[ 8, "asc" ]]
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
// console.log(formData);
// return;
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
        text: "You want to disable this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
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
        }
    });
});

function markAsCompleted(id) {
    $('#complete_sr_id').val(id);
}
$(document).on('submit', '#markascompletedform', function (event) {
    event.preventDefault();
    var formdata = $('#markascompletedform').serializeArray();
    $.ajax({
        url: activeRoute,
        method: "POST",
        data: formdata,
        success: function (response) {
            InitTable();
            $('.success').html(response);
            $('#markascompletedform')[0].reset();
            $('#changeStatusToCompleted').modal('hide');
            $('#success').show();
        },
        error: function () {
        },
    });
});
$(document).on('click', '.active', function () {
    swal({
        title: "Are you sure?",
        text: "You want to active this.!",
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


$(document).on('click', '#viewdetail', function ({}) {
    $('#staffrequiredStatusForm').show();
    var button = $(this);
    button.button('loading');
    var id = $(this).attr('data-id');
    $.ajax({
        "url": viewdetailroute,
        type: "POST",
        data: {'id': id, _token: token},
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('#job_position').text("Post: " + response.post_details.position);
            $('#job_department').text("Department: " + response.post_details.department.deptname);
            $('#job_createdby').text("Created By: " + response.post_details.user.fname + ' ' + response.post_details.user.lname);
            $('#job_salaryrang').text("Salary Range: " + response.post_details.salary_from + ' - ' + response.post_details.salary_to);
            $('#no_of_staff').text("Required Staff : " + response.post_details.number_of_staff);
            $('#job_created_at').text("Created At: " + response.post_details.created_at);
            $('#staffrequired_id').val(response.post_details.id);
            $('#rePosition').val(response.post_details.position);
            $('#staff_required_date').text("Required Date: " + response.post_details.required_date);
            if (response.post_details.status == "Pending") {
                $('#request_status').html('<span class="label label-warning">' + response.post_details.status + '</span>');
            } else if (response.post_details.status == "Fullfilled") {
                $('#request_status').html('<span class="label label-info">' + response.post_details.status + '</span>');
            } else if (response.post_details.status == "Rejected") {
                $('#request_status').html('<span class="label label-danger">' + response.post_details.status + '</span>');
            } else if (response.post_details.status == "Completed") {
                $('#staffrequiredStatusForm').hide();
                $('#request_status').html('<span class="label label-success">' + response.post_details.status + '</span>');
            } else if (response.post_details.status == "In Progress") {
                $('#request_status').html('<span class="label label-primary">' + response.post_details.status + '</span>');
            }
            $('#staff_description').text(response.post_details.job_desc);

            var html = '';
            $.each(response.status_details, function (index, value) {
                var status = '';
                if (value.status == 'Pending') {
                    status = '<span class="label label-warning">Pending</span>';
                } else if (value.status == 'In Progress') {
                    status = '<span class="label label-primary">In Progress</span>';
                } else if (value.status == 'Fullfilled') {
                    status = '<span class="label label-info">Fullfilled</span>';
                } else if (value.status == 'Completed') {
                    status = '<span class="label label-success">Completed</span>';
                } else if (value.status == 'Rejected') {
                    status = '<span class="label label-danger">Rejected</span>';
                }
                Date.shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                var ts = Date.parse(value.created_at);
                var d = new Date(ts);
                var month = Date.shortMonths[d.getMonth()];
                var yyyy = d.getFullYear();
                var dd = d.getDate();
                var fulldate = dd + ' ' + month + ' ' + yyyy;

                html += '<tr>\n' +
                    '    <td>' + status + '</td>\n' +
                    '    <td>' + value.description + '</td>\n' +
                    '    <td>' + value.updatedby.fname + ' ' + value.updatedby.lname + '</td>\n' +
                    '    <td>' + fulldate + '</td>\n' +
                    '  </tr>'
            });
            $('.status_content_here').html(html);

            $('#viewjobdetail').modal();
            button.button('reset');
        },
        error: function () {
        },
    });
});


$('#btnstaffrequiredstatus').on('click', function (e) {
    event.preventDefault();
    $('#btnstaffrequiredstatus').button('loading');
    var form = $('#staffrequiredStatusForm')[0];
    var formData = new FormData(form);
    $.ajax({
        data: formData,
        type: $('#staffrequiredStatusForm').attr('method'),
        url: $('#staffrequiredStatusForm').attr('action'),
        processData: false,
        contentType: false,
        success: function (response) {
            var errorsmesg = '';
            if (response.errors) {
                errorsmesg = '<ul>';
                errorsmesg += '<li>';
                errorsmesg += (response.errors.remarks[0]) ? response.errors.remarks[0] : "";
                errorsmesg += '</li>';
                errorsmesg += '<li>';
                errorsmesg += (response.errors.status[0]) ? response.errors.status[0] : "";
                errorsmesg += '</li>';
                errorsmesg += '<li>';
                errorsmesg += (response.errors.updated_date[0]) ? response.errors.updated_date[0] : "";
                errorsmesg += '</li>';
                errorsmesg += '</ul>';
                $('.errormessages').html(errorsmesg);
                return;
            }
            var html = '';
            var createdBy = $('.navbar').find('.hidden-xs').text();

            var status = '';
            if (response.status == 'Pending') {
                status = '<span class="label label-warning">Pending</span>';
            } else if (response.status == 'In Progress') {
                status = '<span class="label label-primary">In Progress</span>';
            } else if (response.status == 'Fullfilled') {
                status = '<span class="label label-info">Fullfilled</span>';
            } else if (response.status == 'Completed') {
                status = '<span class="label label-success">Completed</span>';
            } else if (response.status == 'Rejected') {
                status = '<span class="label label-danger">Rejected</span>';
            }
            Date.shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var ts = Date.parse(response.created_at);
            var d = new Date(ts);
            var month = Date.shortMonths[d.getMonth()];
            var yyyy = d.getFullYear();
            var dd = d.getDate();
            var fulldate = dd + ' ' + month + ' ' + yyyy;
            html += '<tr>\n' +
                '    <td>' + status + '</td>\n' +
                '    <td>' + response.description + '</td>\n' +
                '    <td>' + createdBy + '</td>\n' +
                '    <td>' + fulldate + '</td>\n' +
                '  </tr>';

            $('#staffrequiredStatusForm')[0].reset();
            $('.status_content_here').append(html);
            $('#btnstaffrequiredstatus').button('reset');
            InitTable();

        }
    });
});