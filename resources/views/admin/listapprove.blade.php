<style>
    .badge {
    line-height: 1.95;
    font-size: small;
}
</style>
<x-admin.layout>
    <x-slot name="title">Approve Slot</x-slot>
    <x-slot name="heading">Approve Slot</x-slot>
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
                                        {{-- <th>Action</th> --}}
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
                                            {{-- <td>
                                                <button type="submit" class="btn btn-primary" id="approve">Approve</button>
                                            </td> --}}
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


