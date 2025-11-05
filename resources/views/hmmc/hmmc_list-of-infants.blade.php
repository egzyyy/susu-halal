@extends('layouts.hmmc')

@section('title', 'List of Infants')

@section('content')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/hmmc_list-of-infants.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container">
        <div class="main-content">
            
            <div class="page-header">
                <h1>List of All Infants</h1>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Recently Registered</h2>
                    <div class="actions">
                        <button class="btn"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                        <button class="btn"><i class="fa-solid fa-filter"></i> Filter</button>
                        <button class="btn btn-more"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    </div>
                </div>

                <table class="infants-table records-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Donor ID</th>
                            <th>Volume</th>
                            <th>Date Requested</th>
                            <th>Date Time to Allocate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([
                            ['request_id'=>'REQ-001','donor_id'=>'D-001','volume'=>'250ml','date_requested'=>'May 15, 2024','date_allocate'=>'May 15, 2024 • 03:30 PM','status'=>'waiting'],
                            ['request_id'=>'REQ-002','donor_id'=>'D-002','volume'=>'250ml','date_requested'=>'May 15, 2024','date_allocate'=>'May 15, 2024 • 03:30 PM','status'=>'approved'],
                            ['request_id'=>'REQ-003','donor_id'=>'D-003','volume'=>'250ml','date_requested'=>'May 15, 2024','date_allocate'=>'May 15, 2024 • 03:30 PM','status'=>'allocated'],
                            ['request_id'=>'REQ-004','donor_id'=>'D-004','volume'=>'250ml','date_requested'=>'May 15, 2024','date_allocate'=>'May 15, 2024 • 03:30 PM','status'=>'canceled']
                        ] as $request)
                            <tr>
                                <td data-label="Request ID">{{ $request['request_id'] }}</td>
                                <td data-label="Donor ID">{{ $request['donor_id'] }}</td>
                                <td data-label="Volume">{{ $request['volume'] }}</td>
                                <td data-label="Date Requested">{{ $request['date_requested'] }}</td>
                                <td data-label="Date Time to Allocate">{{ $request['date_allocate'] }}</td>
                                <td data-label="Status">
                                    <span class="status-badge {{ $request['status'] }}">{{ ucfirst($request['status']) }}</span>
                                </td>
                                <td class="actions" data-label="Actions">
                                    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                                    @if($request['status'] !== 'canceled')
                                        <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    @endif
                                    <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
