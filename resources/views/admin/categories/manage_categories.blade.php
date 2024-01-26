@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Categories </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Categories </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" data-toggle="modal" data-target="#add_modalbox">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Category
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="manage_tbl" class="table table-striped table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Title</th>
                                    <th>Parent Category</th>
                                    <th>Creation Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($categories as $item)
                                <tr class="gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        {{$item->parentCategory->title ?? 'N/A'}}
                                    </td>
                                    <td>{{ date_formated($item->created_at)}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn_cat_edit" data-id="{{$item->id}}" type="button"><i class="fa-solid fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="{{$item->id}}" data-text="This action will delete this category." type="button" data-placement="top" title="Delete">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal show fade" id="add_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add Category</h5>
            </div>
            <div class="modal-body">
                <form id="add_cat_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Title</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" placeholder="Category Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Parent Category</strong></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="parent">
                                <option selected value="">None</option>
                                {!! parent_category_options() !!}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Image</strong></label>
                        <div class="col-sm-8">
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_cat_button"> Submit </button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal show fade" id="edit_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY" id="edit_modalbox_body">
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#manage_tbl').dataTable({
        "paging": true,
        "searching": true,
        "bInfo": true,
        "responsive": true,
        "pageLength": 50,
        "columnDefs": [{
                "responsivePriority": 1,
                "targets": 0
            },
            {
                "responsivePriority": 2,
                "targets": -1
            },
            {
                "responsivePriority": 3,
                "targets": -2
            },
        ]
    });

    // $(document).on("click", ".btn_update_status", function() {
    //     var id = $(this).attr('data-id');
    //     var status = $(this).attr('data-status');
    //     var show_text = $(this).attr('data-text');
    //     swal({
    //             title: "Are you sure?",
    //             text: show_text,
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#DD6B55",
    //             confirmButtonText: "Yes, Please!",
    //             cancelButtonText: "No, Cancel Please!",
    //             closeOnConfirm: false,
    //             closeOnCancel: true
    //         },
    //         function(isConfirm) {
    //             if (isConfirm) {
    //                 $(".confirm").prop("disabled", true);
    //                 $.ajax({
    //                     url: "{{ url('admin/categories/update_statuses') }}",
    //                     type: 'post',
    //                     data: {
    //                         "_token": "{{ csrf_token() }}",
    //                         'id': id,
    //                         'status': status
    //                     },
    //                     dataType: 'json',
    //                     success: function(status) {
    //                         $(".confirm").prop("disabled", false);
    //                         if (status.msg == 'success') {
    //                             swal({
    //                                     title: "Success!",
    //                                     text: status.response,
    //                                     type: "success"
    //                                 },
    //                                 function(data) {
    //                                     location.reload();
    //                                 });
    //                         } else if (status.msg == 'error') {
    //                             swal("Error", status.response, "error");
    //                         }
    //                     }
    //                 });
    //             } else {
    //                 swal("Cancelled", "", "error");
    //             }
    //         });
    // });
    $(document).on("click", "#save_cat_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#add_cat_form")[0]);
        $.ajax({
            url: "{{ url('admin/categories/store') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });

    $(document).on("click", ".btn_cat_edit", function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('admin/categories/category-show') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(status) {
                $("#edit_modalbox_body").html(status.response);
                $("#edit_modalbox").modal('show');
            }
        });
    });

    $(document).on("change", "#cat_img_input", function() {
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            toastr.error("Invalid image file type. Please select a valid image file.", "Error");
            $("#cat_img_input").val('');
            $("#previewImage").attr('src', '');
            return false;
        }
        if (file.size > 2097152) {
            toastr.error("Image file size is too big. Please select a image file less than 2MB.", "Error");
            $("#cat_img_input").val('');
            $("#previewImage").attr('src', '');
            return false;
        }
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#previewImage").attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
    $(document).on("click", "#update_cat_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#edit_cat_form")[0]);
        $.ajax({
            url: "{{ url('admin/categories/update-category') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
    $(document).on("click", ".btn_delete", function() {
        var id = $(this).attr('data-id');
        swal({
                title: "Are you sure?",
                text: "You want to delete this category!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, please!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $(".confirm").prop("disabled", true);
                    $.ajax({
                        url: "{{ url('admin/categories/delete-category') }}",
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': id,
                        },
                        dataType: 'json',
                        success: function(status) {
                            $(".confirm").prop("disabled", false);
                            if (status.msg == 'success') {
                                swal({
                                        title: "Success!",
                                        text: status.response,
                                        type: "success"
                                    },
                                    function(data) {
                                        location.reload();
                                    });
                            } else if (status.msg == 'error') {
                                swal("Error", status.response, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "", "error");
                }
            });
    });
</script>
@endpush