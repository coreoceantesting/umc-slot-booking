<x-admin.layout>
    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .blink {
            animation: blink 1s infinite;
        }
        canvas#slotPieChart {
        width: 458px !important;
        height: 345px !important;
        }

    </style>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard (डॅशबोर्ड) </x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    {{-- new dashboard --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-xl-3 col-md-3">
                        <div class="card card-animate" id="totalSlipsCardNew">
                            <div class="card-body" style="background: linear-gradient(165deg, #482668, #ffffff);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b style="color:#fff;">Total Register Slot</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" style="color:#fff;" data-target="{{$slotbooking}}">{{$slotbooking}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="award" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    
                    <div class="col-xl-3 col-md-3">
                        <!-- card -->
                        <div class="card card-animate" id="yearlySlipsCardNew">
                            <div class="card-body" style="background: linear-gradient(160deg, #482668, #ffffff);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b style="color:#fff;">Total Approve Slot</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" style="color:#fff;" data-target="{{$approveSlotCount}}">{{$approveSlotCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                0.24 %
                                            </span>
                                            vs. previous month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="list" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
        
                    <div class="col-xl-3 col-md-3" style="border-radius:10px;">
                        {{-- card --}}
                        <div class="card card-animate" id="actiontakenSlipsNew" style="background: linear-gradient(160deg, #ff0058ad, #482668);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b style="color:#fff;">Total Pending Slot</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" style="color:#fff;" data-target="{{$pendingSlotCount}}">{{$pendingSlotCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    
                    <div class="col-xl-3 col-md-3">
                        <!-- card -->
                        <div class="card card-animate" id="vardiahavalSlipsCardNew">
                            <div class="card-body" style="background: linear-gradient(160deg, #8c68cd, #482668);">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b style="color:#fff;">Total Return Slot</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" style="color:#fff;" data-target="{{$returnSlotCount}}">{{$returnSlotCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="file-text" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                </div><!--end row-->
            </div>
        </div><!--end col-->
        
    
        <div class="col-xl-6">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1"> Pending List</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('slotbooking.index') }}" class="btn btn-soft-primary btn-sm">
                            View All
                        </a>
                    </div>
                </div><!-- end card header -->
                <!-- card body -->
                <div class="card-body">
                 
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="todaysListNew" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>slotapplicationid</th>
                                    <th>fullname</th>
                                    <th>mobileno</th>
                                    <th>booking_date</th>
                                    <th>citizentype</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todaysSlotList as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->slotapplicationid }}</td>
                                        <td>{{ $list->fullname }}</td>
                                        <td>{{ $list->mobileno }}</td>
                                        <td>{{ $list->booking_date }}</td>
                                        <td>
                                        @if($list->citizentype == 1)
                                        General
                                        @elseif($list->citizentype == 2)
                                            Senior Citizen
                                        @else
                                            Unknown
                                        @endif
                                        </td>
                                        <td>
                                            @if ($list->activestatus == 'return')
                                            <span class="badge bg-secondary">{{ ucfirst($list->activestatus) }}</span>
                                            @elseif ($list->activestatus == 'pending')
                                                <span class="badge bg-danger">{{ ucfirst($list->activestatus) }}</span>
                                            @else
                                                <span class="badge bg-success">{{ ucfirst($list->activestatus) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div> <!-- .card-->
        </div><!--end col-->

        <div class="col-xl-6">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                          Return List 
                    </h4>
                    <div>
                        <a href="{{ route('returnlist') }}" class="btn btn-soft-secondary btn-sm">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="stockDetailsNew" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>slotapplicationid</th>
                                    <th>fullname</th>
                                    <th>mobileno</th>
                                    <th>booking_date</th>
                                    <th>citizentype</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returnSlotList as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->slotapplicationid }}</td>
                                        <td>{{ $list->fullname }}</td>
                                        <td>{{ $list->mobileno }}</td>
                                        <td>{{ $list->booking_date }}</td>
                                        <td>
                                        @if($list->citizentype == 1)
                                        General
                                        @elseif($list->citizentype == 2)
                                            Senior Citizen
                                        @else
                                            Unknown
                                        @endif
                                        </td>
                                        <td>
                                            @if ($list->activestatus == 'return')
                                            <span class="badge bg-secondary">{{ ucfirst($list->activestatus) }}</span>
                                            @elseif ($list->activestatus == 'pending')
                                                <span class="badge bg-danger">{{ ucfirst($list->activestatus) }}</span>
                                            @else
                                                <span class="badge bg-success">{{ ucfirst($list->activestatus) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div><!--end col-->

        
        <!--end col-->
        
        {{-- pie chart --}}
        {{-- <div class="col-xl-6">
            <canvas id="slotPieChart" width="150" height="150"></canvas>
        </div> --}}
        
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var data = {
                labels: ["Approve Slot", "Return Slot", "Pending Slot", "All Register Slot"],
                datasets: [{
                    data: [25, 35, 20, 50], 
                    backgroundColor: [
                        '#ffefd5', 
                        '#d2c343', 
                        '#b066a0', 
                        '#689fc7' 
                    ],
                    hoverBackgroundColor: [
                        '#45a049',
                        '#e94f3b',
                        '#f1d74b',
                        '#1e88e5'
                    ]
                }]
            };
        
            var config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    aspectRatio: 1,  // Optional: Adjust aspect ratio
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                                }
                            }
                        }
                    }
                }
            };
        
            var ctx = document.getElementById('slotPieChart').getContext('2d');
            var slotPieChart = new Chart(ctx, config);  
        </script> --}}
        
    

    {{-- @push('scripts')
    <script>
        $(document).ready(function() {

            $('#todaySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('todays_list') }}";
            });

            $('#monthlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('monthly_list') }}";
            });

            $('#yearlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('yearly_list') }}";
            });

            $('#actiontakenSlipsNew').on('click', function() {
                window.location.href = "{{ route('action_taken_list') }}";
            });

            $('#vardiahavalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('vardi_ahaval_list') }}";
            });

            $('#totalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('slips_list') }}";
            });

            $('#todaysListNew,#stockDetailsNew,#vehicledetails').dataTable({searching: false, paging: false, info: false});

        });
    </script> --}}

    {{-- for pdf --}}
    {{-- <script>
        $(document).ready(function() {
            $("#buttons-datatables").on("click", ".download-pdf", function(e) {
                e.preventDefault();
                var pdfFileName = $(this).data("pdf-file-name");
                var pdfUrl = "{{ url('/slips/') }}/" + pdfFileName;

                window.open(pdfUrl, '_blank');
            });
        });
    </script> --}}


    {{-- blink date if documents expire within 10 days --}}
    {{-- <script>
        $(document).ready(function() {
            var currentDate = new Date();

            $('#vehicledetails tbody tr').each(function() {
                var pucEndDate = new Date($(this).find('td:nth-child(4)').text()); 

                var timeDiff = pucEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(4)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); 
                }
            });

            $('#vehicledetails tbody tr').each(function() {
                var insuranceEndDate = new Date($(this).find('td:nth-child(5)').text()); 

                var timeDiff = insuranceEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(5)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); 
                }
            });

            $('#vehicledetails tbody tr').each(function() {
                var fitnessEndDate = new Date($(this).find('td:nth-child(6)').text());

                var timeDiff = fitnessEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                console.log(fitnessEndDate);

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(6)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink');
                }
            });

        });
    </script> --}}



    {{-- @endpush --}}

</x-admin.layout>