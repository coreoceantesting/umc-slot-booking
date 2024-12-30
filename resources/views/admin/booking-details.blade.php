<div>
    <div>
        <h3>Booking Details</h3>
        <table class="table">
           
            <tr>
                <th>Property Type</th>
                <td>{{ $booking->Pname }}</td>
            </tr>
            <tr>
                <th>Property Type Name</th>
                <td>{{ $booking->Prname }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $booking->address }}</td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td>{{ $booking->fullname }}</td>
            </tr>
            <tr>
                <th>Mobile No</th>
                <td>{{ $booking->mobileno }}</td>
            </tr>
            <tr>
                <th>Booking Purpose</th>
                <td>{{ $booking->bookingpurpose }}</td>
            </tr>
            <tr>
                <th>Booking Date</th>
                <td>{{ $booking->booking_date }}</td>
            </tr>
            <tr>
                <th>Citizen Type</th>
                <td>
                    @if($booking->citizentype == 1)
                        General
                    @elseif($booking->citizentype == 2)
                        Senior Citizen
                    @else
                        Unknown
                    @endif
                </td>
            </tr>
            <tr>
                <th>Slot</th>
                <td>{{ $booking->SlotName }}&nbsp;{{ $booking->fromtime }}-{{ $booking->totime }}</td>
            </tr>
            <tr>
                <th>SD Amount</th>
                <td>{{ $booking->sdamount }}</td>
            </tr>
            <tr>
                <th>SC Amount</th>
                <td>{{ $booking->scamount }}</td>
            </tr>
         
            @if($booking->citizentype == 2)
                <tr>
                    <th>Registration No</th>
                    <td>{{ $booking->registrationno }}</td>
                </tr>
                <tr>
                    <th>Files</th>
                    <td>
                        <a href="{{ asset('storage/registration_certificates/' . $booking->files) }}" target="_blank">
                            View Document
                        </a>
                    </td>
                </tr>
            @endif
            
    
</div>
</div>

<script>
//    $(document).ready(function() {
//     // Approve button click event
//     $('#approveBtn').click(function() {
//         var bookingId = $(this).data('booking-id'); 
//   console.log('model booking id ',bookingId);
//         if (!bookingId) {
//             alert("No booking ID found!");
//             return;
//         }

//         $.ajax({
//             url: '/approvedslot/' + bookingId, 
//             method: 'POST',
//             data: {
//                 _token: $('meta[name="csrf-token"]').attr('content'), 
//             },
//             success: function(response) {
//                 alert(response.message || 'Booking approved!');
//                 $('#viewDetailsModal').modal('hide');
//             },
//             error: function(xhr, status, error) {
//                 // Show error alert if something goes wrong
//                 alert("Error approving booking: " + error);
//             }
//         });
//     });

//     // Return button click event
//     $('#returnBtn').click(function() {
//         var bookingId = $(this).data('booking-id'); // Get the bookingId from the button

//         if (!bookingId) {
//             alert("No booking ID found!");
//             return;
//         }

//         $.ajax({
//             url: '/returnslot/' + bookingId, // API route for return
//             method: 'POST',
//             data: {
//                 _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
//             },
//             success: function(response) {
//                 // If the request is successful, alert the user and hide the modal
//                 alert(response.message || 'Booking returned!');
//                 $('#viewDetailsModal').modal('hide');
//             },
//             error: function(xhr, status, error) {
//                 // Show error alert if something goes wrong
//                 alert("Error returning booking: " + error);
//             }
//         });
//     });
// });

    </script>