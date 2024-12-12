<x-admin.layout>
    <x-slot name="title">Property Details</x-slot>
    <x-slot name="heading">Property Details</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Add Property Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertytypename">Select Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytype as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
                    
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertyname">Select Property Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertyname" id="propertyname" required>
                                        <option value="">--Select Property Name --</option>
                                        @foreach ($propertytypename as $propertytypenames)
                                            <option value="{{ $propertytypenames->id }}">{{ $propertytypenames->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertynames_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="slot">Select Slot Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="slot" id="slot" required>
                                        <option value="">--Select Slot Name --</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid slot_err"></span>
                                </div>
                    
                                <div class="col-md-4">
                                    <label class="col-form-label" for="gamount">General Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="gamount" name="gamount" type="text" placeholder="Enter General Amount" required>
                                    <span class="text-danger is-invalid gamount_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="sdamount">General(SD) Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="sdamount" name="sdamount" type="text" placeholder="Enter General(SD) Amount" required>
                                    <span class="text-danger is-invalid sdamount_err"></span>
                                </div>
                                 <div class="col-md-4">
                                    <label class="col-form-label" for="citizenamount">Citizen Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="citizenamount" name="citizenamount" type="text" placeholder="Enter Citizen Amount" required>
                                    <span class="text-danger is-invalid citizenamount_err"></span>
                                </div>
                                  <div class="col-md-4">
                                    <label class="col-form-label" for="citizensdamount">Citizen(SD) Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="citizensdamount" name="citizensdamount" type="text" placeholder="Enter Citizen(SD) Amount" required>
                                    <span class="text-danger is-invalid citizensdamount_err"></span>
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
                                    <label class="col-form-label" for="propertytypename">Select Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytype as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertyname">Select Property Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertyname" id="propertyname" required>
                                        <option value="">--Select Property Name --</option>
                                        @foreach ($propertytypename as $propertytypenames)
                                            <option value="{{ $propertytypenames->id }}">{{ $propertytypenames->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertynames_err"></span>
                                </div>
        
                                <div class="col-md-4">
                                    <label class="col-form-label" for="slot">Select Slot Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="slot" id="slot" required>
                                        <option value="">--Select Slot Name --</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid slot_err"></span>
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="gamount">General Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="gamount" name="gamount" type="text" placeholder="Enter General Amount" required>
                                    <span class="text-danger is-invalid gamount_err"></span>
                                </div>
        
                                <div class="col-md-4">
                                    <label class="col-form-label" for="sdamount">General(SD) Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="sdamount" name="sdamount" type="text" placeholder="Enter General(SD) Amount" required>
                                    <span class="text-danger is-invalid sdamount_err"></span>
                                </div>
        
                                <div class="col-md-4">
                                    <label class="col-form-label" for="citizenamount">Citizen Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="citizenamount" name="citizenamount" type="text" placeholder="Enter Citizen Amount" required>
                                    <span class="text-danger is-invalid citizenamount_err"></span>
                                </div>
                            </div>
        
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="citizensdamount">Citizen(SD) Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="citizensdamount" name="citizensdamount" type="text" placeholder="Enter Citizen(SD) Amount" required>
                                    <span class="text-danger is-invalid citizensdamount_err"></span>
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
                                <button id="addToTable" class="btn btn-primary" type="button">Add <i class="fa fa-plus"></i></button>
                                <button id="btnCancel" class="btn btn-danger" type="button" style="display:none;">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Property Type Name</th>
                                        <th>Property Name</th>
                                        <th>Slot Name</th>
                                        <th>General Amount</th>
                                        <th>General(SD)</th>
                                        <th>Citizen Amount</th>
                                        <th>Citizen(SD)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pro)
                                        <tr>
                                            <td>{{ $pro->Pname }}</td>
                                            <td>{{ $pro->PropertyName }}</td>
                                            <td>{{ $pro->SlotName }}</td>
                                            <td>{{ $pro->gamount }}</td>
                                            <td>{{ $pro->sdamount }}</td>
                                            <td>{{ $pro->citizenamount }}</td>
                                            <td>{{ $pro->citizensdamount }}</td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit propertydetails" data-id="{{ $pro->id }}" type="button"><i data-feather="edit"></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete propertydetails" data-id="{{ $pro->id }}" type="button"><i data-feather="trash-2"></i></button>
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
            url: '{{ route('propertydetails.store') }}',
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
                            window.location.href = '{{ route('propertydetails.index') }}';
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
        var url = "{{ route('propertydetails.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour(); 
                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.propertydetail.id);
                    $("#editForm select[name='propertytypename']").val(data.propertydetail.propertytypename);
                    $("#editForm select[name='propertyname']").val(data.propertydetail.propertyname);
                    $("#editForm select[name='slot']").val(data.propertydetail.slot);
                    $("#editForm input[name='gamount']").val(data.propertydetail.gamount);
                    $("#editForm input[name='sdamount']").val(data.propertydetail.sdamount);
                    $("#editForm input[name='citizenamount']").val(data.propertydetail.citizenamount);
                    $("#editForm input[name='citizensdamount']").val(data.propertydetail.citizensdamount);
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
            var url = "{{ route('propertydetails.update', ':model_id') }}";
            
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
                            window.location.href = '{{ route('propertydetails.index') }}';
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
            title: "Are you sure to delete this propertydetails?",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('propertydetails.destroy', ":model_id") }}";

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
