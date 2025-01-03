<x-admin.layout>
    <x-slot name="title">AadharCard Master</x-slot>
    <x-slot name="heading">AadharCard Master</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf
        
                        <div class="card-header">
                            <h4 class="card-title">Add Aadhar Card</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" pattern="[A-Za-z\s]+" type="text" placeholder="Enter Name" required>
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="citizen_type">Citizen Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="citizen_type" name="citizen_type" required>
                                        <option value="">Select Citizen Type</option>
                                        <option value="General">General</option>
                                        <option value="Senior Citizen">Senior Citizen</option>
                                    </select>
                                    <span class="text-danger is-invalid citizen_type_err"></span>
                                </div>
        
                                <div class="col-md-3">
                                    <label class="col-form-label" for="image">Upload Image/File <span class="text-danger">*</span></label>
                                    <input class="form-control" id="image" name="image" type="file" accept="image/*,application/pdf" required>
                                    <span class="text-danger is-invalid image_err"></span>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-form-label" for="is_required">Is Required</label>
                                    <input class="form-check-input" id="is_required" name="is_required" type="checkbox" checked>
                                </div>
                            </div>
        
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="editForm" id="editForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
        
                        <div class="card-header">
                            <h4 class="card-title">Edit Aadhar Card</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" pattern="[A-Za-z\s]+" type="text" placeholder="Enter Name" required>
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="citizen_type">Citizen Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="citizen_type" name="citizen_type" required>
                                        <option value="">Select Citizen Type</option>
                                        <option value="General">General</option>
                                        <option value="Senior Citizen">Senior Citizen</option>
                                    </select>
                                    <span class="text-danger is-invalid citizen_type_err"></span>
                                </div>
        
                                <div class="col-md-3">
                                    <label class="col-form-label" for="image">Upload Image/File <span class="text-danger">*</span></label>
                                    <input class="form-control" id="image" name="image" type="file" accept="image/*,application/pdf">
                                    <a  id="file-view-link" class="file-view-link" target="_blank">View Document</a>
                                    <span class="text-danger is-invalid image_err"></span>
                                </div>

                                <div class="col-md-2">
                                    <label class="col-form-label" for="is_required">Is Required</label>
                                    <input class="form-check-input" id="is_required" name="is_required" type="checkbox" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="editSubmit">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Citizen Type</th>
                                        <th>Image</th>
                                        <th>Is Required</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aadharcard as $index => $aadhar)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $aadhar->name }}</td>
                                            <td>{{ $aadhar->citizen_type }}</td>
                                            <td>
                                                @if($aadhar->image_path)
                                                @php
                                                    $fileExtension = pathinfo($aadhar->image_path, PATHINFO_EXTENSION);
                                                @endphp

                                                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                                    <a href="{{ asset('storage/'.$aadhar->image_path) }}" target="_blank">
                                                        <img src="{{ asset('storage/'.$aadhar->image_path) }}" alt="Image" style="max-width: 100px; max-height: 50px;">
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/'.$aadhar->image_path) }}" target="_blank">
                                                        <i class="fa fa-file-pdf"></i> View Document
                                                    </a>
                                                @endif
                                            @else
                                                No Image or Document
                                            @endif

                                            </td>
                                            <td>
                                                <span class="badge {{ $aadhar->is_required ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $aadhar->is_required ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit Aadhar Card" data-id="{{ $aadhar->id }}">
                                                    <i data-feather="edit"></i>
                                                </button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete Aadhar Card" data-id="{{ $aadhar->id }}">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        




</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('adhaardetail.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('adhaardetail.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
  $("#buttons-datatables").on("click", ".edit-element", function(e) {
    e.preventDefault();
    var model_id = $(this).attr("data-id");
    var url = "{{ route('adhaardetail.edit', ':model_id') }}";

    $.ajax({
        url: url.replace(':model_id', model_id),
        type: 'GET',
        data: {
            '_token': "{{ csrf_token() }}"
        },
        success: function(data, textStatus, jqXHR) {
            console.log(data);
            editFormBehaviour();

            if (!data.error) {
                $("#editForm input[name='edit_model_id']").val(data.aadhar.id);
                $("#editForm input[name='name']").val(data.aadhar.name);
                $("#editForm select[name='citizen_type']").val(data.aadhar.citizen_type);
                $("#editForm .file-view-link").attr("href", "/storage/" + data.aadhar.image_path);
                if (data.aadhar.is_required) {
                    $("#editForm input[name='is_required']").prop('checked', true); 
                } else {
                    $("#editForm input[name='is_required']").prop('checked', false);
                }
            } else {
                alert(data.error);
            }
        },
        error: function(error, jqXHR, textStatus, errorThrown) {
            alert("Something went wrong");
        }
    });
});

</script>


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('adhaardetail.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('adhaardetail.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this department?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('adhaardetail.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>
