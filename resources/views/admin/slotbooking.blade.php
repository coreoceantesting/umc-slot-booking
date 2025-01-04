<style>
    .badge {
    line-height: 1.95;
    font-size: small;
}


</style>
<x-admin.layout>
    <x-slot name="title">Slot Booking</x-slot>
    <x-slot name="heading">Slot Booking</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Add Slot Booking</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <!-- Property Type Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertytypename">Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytypes as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
                    
                                <!-- Property Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="propertyname">Property Name</label>
                                    <select class="form-control" name="propertyname" id="propertyname" required disabled>
                                        <option value="">--Select Property--</option>
                                    </select>
                                    <span class="text-danger is-invalid propertyname_err"></span>
                                </div>
                    
                                <!-- Address -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="address">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" id="address" name="address" type="text" placeholder="Enter Property Address" required readonly>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="fullname">FullName <span class="text-danger">*</span></label>
                                    <input class="form-control" id="fullname" name="fullname" value="{{$user->name}}" type="text"  placeholder="Enter fullname" required readonly>
                                    <span class="text-danger is-invalid fullname_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="mobileno">Mobile<span class="text-danger">*</span></label>
                                    <input class="form-control" id="mobileno" name="mobileno" type="number"  value={{$user->mobile}} placeholder="Enter mobileno" required readonly>
                                    <span class="text-danger is-invalid mobileno_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="booking_date">Booking Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="booking_date" name="booking_date" type="date" required>
                                    <span class="text-danger is-invalid booking_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="bookingpurpose">Booking Purpose <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="bookingpurpose" name="bookingpurpose" type="text"  placeholder="Enter booking purpose" required></textarea>
                                    <span class="text-danger is-invalid bookingpurpose_err"></span>
                                </div>
                          
                                <div class="col-md-4">
                                    <label for="citizentype" class="form-label">Select Citizen <span class="text-danger">*</span></label>
                                    <select id="signupcitizenType" name="citizentype" class="form-select" required>
                                        <option value="">--Select Citizen Type --</option>
                                        <option value="1">General</option>
                                        <option value="2">Senior Citizen</option>
                                    </select>
                                    <span class="text-danger is-invalid citizentype_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="slot">Select Slot <span class="text-danger">*</span></label>
                                    <select class="form-control" name="slot" id="slot" required >
                                        <option value="">--Select slot --</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->name }}[{{ $slot->fromtime }}-{{$slot->totime}}]</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid slot_err"></span>
                                </div>

                                <div class="col-md-4" id="sdamount-container" style="display: none;">
                                    <label class="col-form-label" for="sdamount">Security Deposit Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="sdamount" name="sdamount" type="text" placeholder="Enter SD Amount" readonly>
                                    <span class="text-danger is-invalid sdamount_err"></span>
                                </div>
                                

                                <div class="col-md-4" id="scamount-container" style="display: none;">
                                    <label class="col-form-label" for="scamount">Booking Charges  <span class="text-danger">*</span></label>
                                    <input class="form-control" id="scamount" name="scamount" type="text" placeholder="Enter SC Amount" readonly>
                                    <span class="text-danger is-invalid scamount_err"></span>
                                </div>

                                <div class="col-md-4" id="registrationno-container" style="display: none;">
                                    <label class="col-form-label" for="registrationno">Registration No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="registrationno" name="registrationno" type="text" placeholder="Enter Registration No" >
                                    <span class="text-danger is-invalid registrationno_err"></span>
                                </div>

                                <div class="col-md-4" id="files-container" style="display: none;">
                                    <label for="files" class="col-form-label">Upload Reg. Certificate <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="files" accept="files/*" name="files" >
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
            <div class="col">
                <form class="form-horizontal form-bordered" method="POST" id="editForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Slot Booking</h4>
                        </div>
                        <div class="card-body py-2">
                            <div class="mb-3 row">
                                <!-- Property Type Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_propertytypename">Property Type Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="propertytypename" id="edit_propertytypename" required>
                                        <option value="">--Select Property Type--</option>
                                        @foreach ($propertytypes as $property)
                                            <option value="{{ $property->id }}" id="property_{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid propertytypename_err"></span>
                                </div>
        
                                <!-- Property Name -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_propertyname">Property Name</label>
                                    <select class="form-control" name="propertyname" id="edit_propertyname" placeholder="Select Property Name" required>
                                    </select>
                                    <span class="text-danger is-invalid propertyname_err"></span>
                                </div>
        
                                <!-- Address -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_address">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_address" name="address" type="text" placeholder="Enter Property Address" required readonly>
                                    <span class="text-danger is-invalid address_err"></span>
                                </div>
        
                                <!-- FullName -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_fullname">FullName <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_fullname" name="fullname" type="text" value="{{$user->name}}" required readonly>
                                    <span class="text-danger is-invalid fullname_err"></span>
                                </div>
        
                                <!-- Mobile -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_mobileno">Mobile <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_mobileno" name="mobileno" type="number" value="{{$user->mobile}}" required readonly>
                                    <span class="text-danger is-invalid mobileno_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_booking_date">Booking Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_booking_date" name="booking_date" type="date" required>
                                    <span class="text-danger is-invalid booking_date_err"></span>
                                </div>
                                
        
                                <!-- Booking Purpose -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_bookingpurpose">Booking Purpose <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="edit_bookingpurpose" name="bookingpurpose" placeholder="Enter booking purpose" required></textarea>
                                    <span class="text-danger is-invalid bookingpurpose_err"></span>
                                </div>
        
                                <!-- Citizen Type -->
                                <div class="col-md-4">
                                    <label for="edit_citizentype" class="form-label">Select Citizen <span class="text-danger">*</span></label>
                                    <select id="edit_citizentype" name="citizentype" class="form-select">
                                        <option value="">--Select Citizen Type --</option>
                                        <option value="1">General</option>
                                        <option value="2">Senior Citizen</option>
                                    </select>
                                    <span class="text-danger is-invalid citizentype_err"></span>
                                </div>
        
                                <!-- Slot Selection -->
                                <div class="col-md-4">
                                    <label class="col-form-label" for="edit_slot">Select Slot <span class="text-danger">*</span></label>
                                    <select class="form-control" name="slot" id="edit_slot" required>
                                        <option value="">--Select slot --</option>
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot->id }}">{{ $slot->name }}[{{$slot->fromtime}}-{{$slot->totime}}]</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger is-invalid slot_err"></span>
                                </div>
        
                                <!-- SD Amount -->
                                <div class="col-md-4" id="sdamount-container" style="display: none;">
                                    <label class="col-form-label" for="edit_sdamount">Security Deposit Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_sdamount" name="sdamount" type="text" placeholder="Enter SD Amount" readonly>
                                    <span class="text-danger is-invalid sdamount_err"></span>
                                </div>
        
                                <!-- SC Amount -->
                                <div class="col-md-4" id="scamount-container" style="display: none;">
                                    <label class="col-form-label" for="edit_scamount">Booking Charges <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_scamount" name="scamount" type="text" placeholder="Enter SC Amount" readonly>
                                    <span class="text-danger is-invalid scamount_err"></span>
                                </div>
        
                                
                                <!-- Registration No -->
                                <div class="col-md-4" id="registrationno-container" style="display: none;">
                                    <label class="col-form-label" for="edit_registrationno">Registration No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit_registrationno" name="registrationno" type="text" placeholder="Enter Registration No">
                                    <span class="text-danger is-invalid registrationno_err"></span>
                                </div>
        
                                <!-- File Upload -->
                                <div class="col-md-4" id="files-container" style="display: none;">
                                    <label for="edit_files" class="col-form-label">Upload Reg. Certificate <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="edit_files" accept="files/*" name="files">
                                    <a  id="file-view-link" class="file-view-link" target="_blank">View Reg. Certificate</a>
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
                                        <th>Application ID</th>
                                        <th>PropertyType</th>
                                        <th>Fullname</th>
                                        <th>Mobile</th>
                                        <th>Citizentype</th>
                                        <th>Slot</th>
                                        <th>Time</th>
                                        <th>ActiveStatus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $pro)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pro->slotapplicationid }}</td>
                                            <td>{{ $pro->Pname }}</td>
                                            <td>{{ $pro->fullname }}</td>
                                            <td>{{ $pro->mobileno }}</td>
                                            <td>
                                                @if($pro->citizentype == 1)
                                                    General
                                                @elseif($pro->citizentype == 2)
                                                    Senior Citizen
                                                @else
                                                    Unknown
                                                @endif
                                            </td>
                                            
                                            <td>{{$pro->SlotName }}</td>
                                            <td>{{$pro->fromtime }}-{{$pro->totime }}</td>
                                            <td>
                                                @if ($pro->activestatus == 'return')
                                                    <span class="badge bg-secondary">{{ ucfirst($pro->activestatus) }}</span>
                                                @elseif ($pro->activestatus == 'pending')
                                                    <span class="badge bg-danger">{{ ucfirst($pro->activestatus) }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ ucfirst($pro->activestatus) }}</span>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if ($pro->activestatus != 'approve')
                                                    <button class="edit-element btn text-secondary px-2 py-1 " title="Edit slotbooking" data-id="{{ $pro->id }}"><i data-feather="edit"></i></button>
                                                    <button class="btn text-danger rem-element px-2 py-1 " title="Delete slotbooking" data-id="{{ $pro->id }}"><i data-feather="trash-2"></i></button>
                                                @else
                                                    <button class="edit-element btn text-secondary px-2 py-1 d-none" title="Edit slotbooking" data-id="{{ $pro->id }}" disabled><i data-feather="edit"></i></button>
                                                    <button class="btn text-danger rem-element px-2 py-1 d-none" title="Delete slotbooking" data-id="{{ $pro->id }}" disabled><i data-feather="trash-2"></i></button>
                                                @endif
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

<link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
{{-- Add --}}
<script>
  $("#addForm").submit(function(e) {
    e.preventDefault();
    $("#addSubmit").prop('disabled', true);

    var formdata = new FormData(this);
    $.ajax({
        url: '{{ route('slotbooking.store') }}',
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#addSubmit").prop('disabled', false);
            
            if (!data.error2) {
                swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('slotbooking.index') }}';
                    });
            } else {
                swal("Error!", data.error2, "error");
            }
        },
        statusCode: {
            422: function(responseObject, textStatus, jqXHR) {
                $("#addSubmit").prop('disabled', false);
                resetErrors();
                printErrMsg(responseObject.responseJSON.errors);
            },
            500: function(responseObject, textStatus, errorThrown) {
                $("#addSubmit").prop('disabled', false);
                swal("Error occurred!", "Something went wrong, please try again.", "error");
            }
        },
        error: function(xhr, status, error) {
            $("#addSubmit").prop('disabled', false);
            swal("Error!", "This slot is already booked for the selected date. Please choose another slot or Date.", "error");
        }
    });
});

</script>


<!-- Edit -->
<script>
$(document).ready(function() {
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('slotbooking.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.slotbooking.id);
                    $("#editForm select[name='propertyname']").val(data.slotbooking.propertytypename);
                    $("#editForm select[name='propertytypename']").val(data.slotbooking.propertytype);
                    $("#editForm input[name='address']").val(data.slotbooking.address);
                    $("#editForm textarea[name='bookingpurpose']").val(data.slotbooking.bookingpurpose);
                    $("#editForm select[name='citizentype']").val(data.slotbooking.citizentype);
                    $("#editForm input[name='sdamount']").val(data.slotbooking.sdamount);
                    $("#editForm input[name='scamount']").val(data.slotbooking.scamount);
                    $("#editForm select[name='slot']").val(data.slotbooking.slot);
                    $("#editForm input[name='registrationno']").val(data.slotbooking.registrationno);
                    $("#editForm input[name='booking_date']").val(data.slotbooking.booking_date);
                    $("#editForm input[name='files']").val('');
                    if (data.slotbooking.files) {
                    $("#editForm .file-name").text(data.slotbooking.files);
                    $("#editForm .file-view-link").attr("href", "/storage/registration_certificates/" + data.slotbooking.files);
                    $("#files-container").show();
                }

                    $('#editContainer').show();
                    $('#editForm select[name="propertytypename"]').trigger('change');
                    $('#editForm select[name="propertyname"]').val(data.slotbooking.propertyname).trigger('change');

                    handleCitizenTypeChange(data.slotbooking.citizentype);

                    $('#editContainer #edit_citizentype').change(function() {
                        var citizenType = $(this).val();
                        handleCitizenTypeChange(citizenType);
                    });

                } else {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Something went wrong!");
            },
        });

        $('#editForm select[name="propertytypename"]').change(function() {
            var propertyTypeId = $(this).val(); 
            if (propertyTypeId) {
                $.ajax({
                    url: '{{ route("fetchproperty") }}', 
                    type: 'GET',
                    data: {
                        propertytypename: propertyTypeId  
                    },
                    success: function(response) {
                        $('#editForm select[name="propertyname"]').prop('disabled', false);
                        $('#editForm select[name="propertyname"]').empty();

                        $.each(response.properties, function(index, property) {
                            $('#editForm select[name="propertyname"]').append('<option value="'+property.id+'">'+property.name+'</option>');
                        });

                        var propertyname = $("#editForm select[name='propertyname']").val();
                        if (propertyname) {
                            $('#editForm select[name="propertyname"]').trigger('change');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching properties.');
                    }
                });
            } else {
                $('#editForm select[name="propertyname"]').prop('disabled', true);
                $('#editForm select[name="propertyname"]').empty();
                $('#editForm select[name="propertyname"]').append('<option value="">--Select Property--</option>');
            }
        });

        function handleCitizenTypeChange(citizenType) {
            $('#editContainer #sdamount-container').hide();
            $('#editContainer #scamount-container').hide();
            $('#editContainer #registrationno-container').hide();
            $('#editContainer #files-container').hide();
            if (citizenType === '2') {
                $('#editContainer #sdamount-container').show();
                $('#editContainer #scamount-container').show();
                $('#editContainer #registrationno-container').show();
                $('#editContainer #files-container').show();
            } else if (citizenType === '1') {
                $('#editContainer #sdamount-container').show();
                $('#editContainer #scamount-container').show();
                $('#editContainer #registrationno-container').hide();
                $('#editContainer #files-container').hide();
            }
        }
    });

    


    $('#editForm select[name="propertyname"]').change(function() {
        var propertyId = $(this).val();
        if (propertyId) {
            $.ajax({
                url: '{{ route("fetchaddress") }}',
                type: 'GET',
                data: {
                    propertyname: propertyId
                },
                success: function(response) {
                    $('#editForm input[name="address"]').val(response.address);
                },
                error: function(xhr, status, error) {
                    alert('Error fetching address.');
                }
            });
        } else {
            $('#editForm input[name="address"]').val('');
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
        var url = "{{ route('slotbooking.update', ':model_id') }}";
        
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
                        window.location.href = '{{ route('slotbooking.index') }}';
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
                var url = "{{ route('slotbooking.destroy', ":model_id") }}";

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

<script>
     $(document).ready(function() {
        $('#propertytypename').change(function() {
            var propertyTypeId = $(this).val(); 
            
            if (propertyTypeId) {
                $.ajax({
                    url: '{{ route("fetchproperty") }}',  
                    type: 'GET',
                    data: {
                        propertytypename: propertyTypeId 
                    },
                    success: function(response) {
                        $('#propertyname').prop('disabled', false);
                        $('#propertyname').empty(); 
                        $('#propertyname').append('<option value="">--Select Property--</option>');  

                        $.each(response.properties, function(index, property) {
                            $('#propertyname').append('<option value="'+property.id+'">'+property.name+'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching properties.');
                    }
                });
            } else {
                $('#propertyname').prop('disabled', true);
                $('#propertyname').empty();
                $('#propertyname').append('<option value="">--Select Property--</option>');
            }
        });

        $('#propertyname').change(function() {
            var propertyId = $(this).val(); 

            if (propertyId) {
                $.ajax({
                    url: '{{ route("fetchaddress") }}', 
                    type: 'GET',
                    data: {
                        propertyname: propertyId 
                    },
                    success: function(response) {
                        $('#address').val(response.address);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching address.');
                    }
                });
            } else {
                $('#address').val('');
            }
        });
    });

    $(document).ready(function() {
    $('#signupcitizenType').change(function() {
        var citizenType = $(this).val();
        
        $('#scamount-container').hide();
        $('#sdamount-container').hide();
        $('#registrationno-container').hide();
        $('#files-container').hide();

        if (citizenType === '2') {
            $('#scamount-container').show();
            $('#registrationno-container').show();
            $('#files-container').show();
            $('#sdamount-container').show();

            $('#scamount').prop('required', true);
            $('#sdamount').prop('required', true);
            $('#registrationno').prop('required', true);
            $('#files').prop('required', true);
            
        } else if (citizenType === '1') { 
            $('#scamount-container').show();
            $('#sdamount-container').show();
            $('#registrationno-container').hide();
            $('#files-container').hide();


        }
    });

    if ($('#addContainer').is(':visible')) {
        $('#signupcitizenType').trigger('change');
    }
});

$("#nextButton").click(function() {
    $("#files-container").toggle();

    if (data.slotbooking && data.slotbooking.files) {
        $("#file-info").show();
        $("#file-name").text(data.slotbooking.files);
        $("#file-view-link").attr("href", "public/registration_certificates/" + data.slotbooking.files);
    } else {
        $("#file-info").hide(); 
    }
});

$("#edit_files").change(function() {
    var file = $(this)[0].files[0];
    if (file) {
        $("#file-info").show();
        $("#file-name").text(file.name);
        $("#file-view-link").attr("href", URL.createObjectURL(file)).text("View File");
    }
});


$('#propertyname').change(function() {
    var propertyId = $(this).val(); 
    if (propertyId) {
        $.ajax({
            url: '{{ route("fetchamount") }}', 
            type: 'GET',
            data: {
                propertyname: propertyId 
            },
            success: function(response) {
                $("#addForm select[name='slot']").val(response.slot);
                $('#signupcitizenType').change(function() {
                    var citizenType = $(this).val();
                    if (citizenType === '1') {
                        $('#scamount').val(response.gamount);
                        $('#sdamount').val(response.sdamount);
                    } else if (citizenType === '2') {
                        $('#scamount').val(response.citizenamount);
                        $('#sdamount').val(response.citizensdamount);
                    }
                });
            },
            error: function(xhr, status, error) {
                alert('Error fetching address.');
            }
        });
    } else {
        $('#address').val('');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0]; 

    const bookingDateInput = document.getElementById('booking_date');
    const editBookingDateInput = document.getElementById('edit_booking_date');

    bookingDateInput.setAttribute('min', formattedDate);

    bookingDateInput.addEventListener('input', function() {
        const selectedDate = bookingDateInput.value;
        const selectedYear = selectedDate.split('-')[0]; 

        if (selectedYear.length !== 4 || isNaN(selectedYear)) {
            document.querySelector('.booking_date_err').textContent = "Please enter a valid 4-digit year.";
            bookingDateInput.classList.add("is-invalid"); 
        } else {
            document.querySelector('.booking_date_err').textContent = "";  
            bookingDateInput.classList.remove("is-invalid");  
        }
    });
});

</script>
