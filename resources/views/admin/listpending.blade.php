<style>
    .badge {
    line-height: 1.95;
    font-size: small;
}
</style>
<x-admin.layout>
    <x-slot name="title">Pending Slot</x-slot>
    <x-slot name="heading">Pending Slot</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        
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
                                        <th>BookingDate</th>
                                        <th>Citizentype</th>
                                        <th>Slot</th>
                                        <th>Time</th>
                                        <th>ActiveStatus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $pro)
                                        <tr data-id="{{ $pro->id }}"> 
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pro->slotapplicationid }}</td>
                                            <td>{{ $pro->Pname }}</td>
                                            <td>{{ $pro->fullname }}</td>
                                            <td>{{ $pro->mobileno }}</td>
                                            <td>{{ $pro->booking_date }}</td>
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
                                            <td>{{$pro->fromtime }}-{{$pro->totime}}</td>
                                            <td>
                                                @if ($pro->activestatus == 'return')
                                                <span class="badge bg-secondary">{{$pro->activestatus}}</span>
                                                @elseif ($pro->activestatus == 'pending')
                                                <span class="badge bg-danger ">{{$pro->activestatus}}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $pro->activestatus }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary view-btn" value="{{ $pro->id }}">View</button>
                                                {{-- <button type="button" class="btn btn-primary approve-btn" value="{{ $pro->id }}">Approve</button>
                                                <button type="button" class="btn btn-danger return-btn" value="{{ $pro->id }}">Return</button> --}}
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

        <div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewDetailsModalLabel">Slot Booking Details</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                            {{-- <span aria-hidden="true">&times;</span> --}}
                        {{-- </button> --}}
                    </div>
                    <div class="modal-body" id="view-details-content">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeBtn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="approveBtn">Approve</button>
                        <button type="button" class="btn btn-danger" id="returnBtn">Return</button>
                    </div>
                </div>
            </div>
        </div>
        

</x-admin.layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>

<script>
// When the 'View' button is clicked
$('.view-btn').click(function(e) {
    e.preventDefault(); 

    var bookingId = $(this).val(); 
    console.log("Booking ID:", bookingId);

    $.ajax({
        url: '/get-slot-details/' + bookingId, 
        method: 'GET',
        success: function(response) {
            if (response.details) {
                $('#view-details-content').html(response.details);
                
           
                $('#viewDetailsModal').modal('show');
              
                $('#approveBtn').data('booking-id', bookingId);  
                $('#returnBtn').data('booking-id', bookingId);  

                console.log("Booking ID set for Approve: ", bookingId);
                console.log("Booking ID set for Return: ", bookingId);
            } else {
                alert('Error: Unable to fetch details.');
            }
        },
        error: function(xhr, status, error) {
            alert("Error fetching details: " + error);
        }
    });
});

// Approve Slot
$('#approveBtn').click(function(e) {
    e.preventDefault(); 
    var bookingId = $(this).data('booking-id'); 
    console.log("Booking ID for approve:", bookingId);
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to approve this slot.',
        icon: 'warning',
        showCancelButton: true, 
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true 
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '{{ route('approvedslot') }}', 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    booking_id: bookingId
                },
                success: function(response) {
                    if (response.success) {
                        var row = $('tr[data-id="' + bookingId + '"]');
                        row.find('.activestatus').text('approved');
                        row.find('.badge').removeClass('bg-danger').addClass('bg-success');
                        
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Slot approved successfully!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        window.location.reload();
                        $('#viewDetailsModal').modal('hide');
                    } else if (response.error) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'An error occurred: ' + error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Approval action cancelled.',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
});


$('#returnBtn').click(function(e) {
    e.preventDefault(); 
    var bookingId = $(this).data('booking-id'); 
    console.log("Booking ID for return:", bookingId);

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to return this slot.',
        icon: 'warning',
        showCancelButton: true,  
        confirmButtonText: 'Yes, return it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true 
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('returnslot') }}', 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    booking_id: bookingId
                },
                success: function(response) {
                    if (response.success) {
                        var row = $('tr[data-id="' + bookingId + '"]');
                        row.find('.activestatus').text('return');
                        row.find('.badge').removeClass('bg-success').addClass('bg-danger');
                        
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Slot returned successfully!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        window.location.reload();
                        $('#viewDetailsModal').modal('hide');
                    } else if (response.error) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'An error occurred: ' + error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Return action cancelled.',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
});


document.getElementById('closeBtn').onclick = function() {
    var modal = document.getElementById('viewDetailsModal');
    var modalInstance = bootstrap.Modal.getInstance(modal); 
    modalInstance.hide(); 
  };

</script>




