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
                                        <th>PropertyType</th>
                                        <th>Fullname</th>
                                        <th>Mobile</th>
                                        <th>BookingDate</th>
                                        <th>Citizentype</th>
                                        <th>Slot</th>
                                        <th>ActiveStatus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $pro)
                                        <tr data-id="{{ $pro->id }}"> 
                                            <td>{{ $index + 1 }}</td>
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
                                            <td><span class="badge bg-danger activestatus">{{$pro->activestatus}}</span></td>
                                            <td>
                                                <button type="button" class="btn btn-primary approve-btn" value="{{ $pro->id }}">Approve</button>
                                                <button type="button" class="btn btn-danger return-btn" value="{{ $pro->id }}">Return</button>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.min.js"></script>

<script>
$('.approve-btn').click(function(e) {
    e.preventDefault(); 
    var row = $(this).closest('tr'); 
    var bookingId = row.data('id'); 
    console.log(bookingId); 

    $.ajax({
        url: '{{ route('approvedslot') }}', 
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', 
            booking_id: bookingId
        },
        success: function(response) {
            if (response.success) {
                row.find('.activestatus').text('approved');
                row.find('.badge').removeClass('bg-danger').addClass('bg-success');
                
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Slot approved successfully!',
                    showConfirmButton: false,
                    timer: 3000
                });
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
            let errorMessage = 'An error occurred: ' + error;
            if (xhr.status == 422) {
                errorMessage = 'Validation error occurred.';
            } else if (xhr.status == 500) {
                errorMessage = 'Internal server error.';
            }

            Swal.fire({
                position: 'center',
                icon: 'error',
                title: errorMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});


$('.return-btn').click(function(e) {
    e.preventDefault(); 
    var row = $(this).closest('tr'); 
    var bookingId = $(this).val(); 
    console.log(bookingId); 

    $.ajax({
        url: '{{ route('returnslot') }}', 
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', 
            booking_id: bookingId,  
        },
        success: function(response) {
            if (response.success) {
                row.find('.activestatus').text('return');  
                row.find('.badge').removeClass('bg-success').addClass('bg-danger'); 
                
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Slot returned successfully!',
                    showConfirmButton: false,
                    timer: 3000
                });
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
});


</script>




