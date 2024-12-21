<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<x-admin.layout>
    <x-slot name="title">Slots</x-slot>
    <x-slot name="heading">Slots</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf
        
                        <div class="card-header">
                            <h4 class="card-title">Add Slots</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="name">Slots Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" pattern="[A-Za-z\s]+" placeholder="Enter Slot Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="initial">Initial <span class="text-danger">*</span></label>
                                    <input class="form-control" id="initial" name="initial" type="text" pattern="[A-Za-z]+" placeholder="Enter Slot Initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                                <!-- Replace the Hours field with Time Picker -->
                                <div class="col-md-3">
                                    <label class="col-form-label" for="fromtime">From Time <span class="text-danger">*</span></label>
                                    <input class="form-control" id=fromtime name="fromtime" type="text" placeholder="Select Time">
                                    <span class="text-danger is-invalid fromtime_err"></span>
                                </div>

                                <div class="col-md-3">
                                    <label class="col-form-label" for="totime">To Time <span class="text-danger">*</span></label>
                                    <input class="form-control" id="totime" name="totime" type="text" placeholder="Select Time">
                                    <span class="text-danger is-invalid totime_err"></span>
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
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Slots</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="name">Slots Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" pattern="[A-Za-z\s]+" placeholder="Slot Name">
                                    <span class="text-danger is-invalid name_err"></span>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="initial">Initial <span class="text-danger">*</span></label>
                                    <input class="form-control" id="initial" name="initial" type="text" pattern="[A-Za-z]+" placeholder="Enter Slots Initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="fromtime">From Time <span class="text-danger">*</span></label>
                                    <input class="form-control" id=fromtime name="fromtime" type="text" placeholder="Select Time">
                                    <span class="text-danger is-invalid fromtime_err"></span>
                                </div>

                                <div class="col-md-3">
                                    <label class="col-form-label" for="totime">To Time <span class="text-danger">*</span></label>
                                    <input class="form-control" id="totime" name="totime" type="text" placeholder="Select Time">
                                    <span class="text-danger is-invalid totime_err"></span>
                                </div>
                                {{-- <div class="col-md-4">
                                    <label class="col-form-label" for="hours">Hours <span class="text-danger">*</span></label>
                                    <input class="form-control" id="hours" name="hours" type="number" placeholder="Enter hours ">
                                    <span class="text-danger is-invalid hours_err"></span>
                                </div> --}}
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
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
                                        <th>Slots Name</th>
                                        <th>Slots From Time</th>
                                        <th>Slots To Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slots as $index => $slot)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $slot->name }}</td>
                                            <td>{{ $slot->fromtime }}</td>
                                            <td>{{ $slot->totime }}</td>
                                            <td>
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit slot" data-id="{{ $slot->id }}"><i data-feather="edit"></i></button>
                                                <button class="btn text-danger rem-element px-2 py-1" title="Delete slot" data-id="{{ $slot->id }}"><i data-feather="trash-2"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</x-admin.layout>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('slot.store') }}',
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
                            window.location.href = '{{ route('slot.index') }}';
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
        var url = "{{ route('slot.edit', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error)
                {
                    $("#editForm input[name='edit_model_id']").val(data.slot.id);
                    $("#editForm input[name='name']").val(data.slot.name);
                    $("#editForm input[name='initial']").val(data.slot.initial);
                    $("#editForm input[name='fromtime']").val(data.slot.fromtime);
                    $("#editForm input[name='totime']").val(data.slot.totime);
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
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
            var url = "{{ route('slot.update', ":model_id") }}";
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
                                window.location.href = '{{ route('slot.index') }}';
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
            title: "Are you sure to delete this slot?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('slot.destroy', ":model_id") }}";

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
   flatpickr("#fromtime", {
        enableTime: true,        
        noCalendar: true,      
        dateFormat: "h:i K",    
        time_24hr: false,         
    });

    flatpickr("#totime", {
        enableTime: true,        
        noCalendar: true,         
        dateFormat: "h:i K",     
        time_24hr: false,        
    });
</script>

