<x-admin.layout>
    <x-slot name="title">Property</x-slot>
    <x-slot name="heading">Property</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Add Property</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <!-- Property Type Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertytypename">Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytype as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
                    
                                <!-- Property Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name">Property Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" pattern="[A-Za-z\s]+" type="text" placeholder="Enter Property Name" required>
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                    
                                <!-- Address -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="address">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" id="address" name="address" type="text"  placeholder="Enter Property Address" required>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-footer">
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <!-- Reset Button -->
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="POST" id="editForm">
                    @csrf
                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Property</h4>
                        </div>
                        <div class="card-body py-2">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertytypename">Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytype as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name"> Property Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" pattern="[A-Za-z\s]+" placeholder="Enter Property Name" required>
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="address">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" id="address" name="address" type="text" placeholder="Enter Property Address" required>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>PropertyType Name</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $pro)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pro->Pname }}</td>
                                            <td>{{$pro->name  }}</td>
                                            <td>{{$pro->address }}</td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit property" data-id="{{ $pro->id }}"><i data-feather="edit"></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete property" data-id="{{ $pro->id }}"><i data-feather="trash-2"></i></button>
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
            url: '{{ route('property.store') }}',
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
                            window.location.href = '{{ route('property.index') }}';
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
    var url = "{{ route('property.edit', ':model_id') }}";

    $.ajax({
        url: url.replace(':model_id', model_id),
        type: 'GET',
        data: {
            '_token': "{{ csrf_token() }}"
        },
        success: function(data, textStatus, jqXHR) {
            editFormBehaviour(); 
            if (!data.error) {
                $("#editForm input[name='edit_model_id']").val(data.property.id);
                $("#editForm select[name='propertytypename']").val(data.property.propertytypename); 
                $("#editForm input[name='name']").val(data.property.name);
                $("#editForm input[name='address']").val(data.property.address);
                $('#editContainer').show(); 
            } else {
                alert(data.error);
            }
        },
        error: function(error, jqXHR, textStatus, errorThrown) {
            alert("Something went wrong!");
        },
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
        var url = "{{ route('property.update', ':model_id') }}";
        
        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#editSubmit").prop('disabled', false);
                if (!data.error2) {
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('property.index') }}';
                    });
                } else {
                    swal("Error!", data.error2, "error");
                }
            },
            statusCode: {
                422: function(responseObject) {
                    $("#editSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function() {
                    $("#editSubmit").prop('disabled', false);
                    swal("Error occurred!", "Something went wrong, please try again", "error");
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
            title: "Are you sure to delete this property?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('property.destroy', ":model_id") }}";

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
