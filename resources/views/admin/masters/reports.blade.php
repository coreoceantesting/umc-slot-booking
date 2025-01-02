<x-admin.layout>
    <x-slot name="title">Slot Booking Reports</x-slot>
    <x-slot name="heading">Slot Booking Reports</x-slot>
    <div class="card">
        <form method="POST" id="report-form">
            @csrf
            <div class="card-header">
                <h4 class="card-title">Slot Reports</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="from_date" class="col-form-label">From Date</label>
                        <input type="date" id="from_date" name="from_date" class="form-control" required>
                    </div>
    
                    <div class="col-md-3">
                        <label for="to_date" class="col-form-label">To Date</label>
                        <input type="date" id="to_date" name="to_date" class="form-control" required>
                    </div>
    
                    <div class="col-md-3">
                        <label for="status" class="col-form-label">Status</label>
                        <select id="status" class="form-control" style="width: 100%;left:0;margin:0;" name="status" >
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="approve">Approve</option>
                            <option value="return">Return</option>
                        </select>
                    </div>
    
                    <!-- Submit Button -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div id="report-results">
    </div>
</x-admin.layout>

<script>
    $(document).ready(function() {
        $('#report-form').on('submit', function(e) {
            e.preventDefault();  

            var formData = $(this).serialize();  

            $.ajax({
                    url: "{{ route('reportsearch') }}",
                    method: "POST",
                    data: formData, 
                    success: function(response) {
                        console.log(response);  

                        if (response.slotBookings.length > 0) {
                            var tableHTML = `
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
                                            </tr>
                                        </thead>
                                        <tbody>`;

                            $.each(response.slotBookings, function(index, booking) {
                                tableHTML += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${booking.slotapplicationid}</td>
                                        <td>${booking.Pname}</td>
                                        <td>${booking.fullname}</td>
                                        <td>${booking.mobileno}</td>
                                        <td>
                                            ${booking.citizentype == 1 ? 'General' : (booking.citizentype == 2 ? 'Senior Citizen' : 'Unknown')}
                                        </td>
                                        <td>${booking.SlotName}</td>
                                        <td>${booking.created_at}</td>
                                        <td>
                                            ${booking.activestatus == 'return' ? 
                                                '<span class="badge bg-secondary">Return</span>' : 
                                                (booking.activestatus == 'pending' ? 
                                                    '<span class="badge bg-danger">Pending</span>' : 
                                                    '<span class="badge bg-success">Approve</span>')}
                                        </td>
                                    </tr>`;
                            });

                            // Close the table structure
                            tableHTML += `</tbody></table></div>`;

                            // Insert the table into the DOM
                            $('#report-results').html(tableHTML);  

                        } else {
                            // If no results are found, show a message
                            $('#report-results').html('<p>No results found for the selected filters.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        // In case of error, show an alert
                        alert('An error occurred. Please try again.');
                    }
                });


        });
    });
</script>

