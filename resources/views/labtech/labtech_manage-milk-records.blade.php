@extends('layouts.labtech')

@section('title', 'Manage Milk Records')

@section('content')
<link rel="stylesheet" href="{{ asset('css/labtech_manage-milk-records.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">
    <div class="main-content">

        <div class="page-header">
            <h1>Milk Records Management</h1>
            <p>Milk Processing and Records</p>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Milk Processing and Records</h2>
                <div class="actions-header">
                    <button class="btn btn-search"><i class="fas fa-search"></i> Search</button>
                    <button class="btn btn-filter"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-more-options"><i class="fas fa-ellipsis-h"></i></button>
                </div>
            </div>

            <div class="records-list">
                <div class="record-header">
                    <span>MILK DONOR</span>
                    <span>CLINICAL STATUS</span>
                    <span>VOLUME</span>
                    <span>EXPIRATION DATE</span>
                    <span>ELIGIBILITY</span>
                    <span>ACTIONS</span>
                </div>

                @foreach ([
                    ['id' => 1, 'donor' => 'Sarah Ahmad Binti Fauzi', 'status' => 'Labelling', 'volume' => '5mL', 'expiry' => 'May 15, 2024', 'eligibility' => 'Passed'],
                    ['id' => 2, 'donor' => 'Maryam Binti Othman', 'status' => 'Storaging', 'volume' => '5mL', 'expiry' => 'May 14, 2024', 'eligibility' => 'Passed'],
                    ['id' => 3, 'donor' => 'Fatimah Az-zahra Binti Mohd Nor', 'status' => 'Screening', 'volume' => '5mL', 'expiry' => 'Jun 23, 2024', 'eligibility' => 'Passed'],
                    ['id' => 4, 'donor' => 'Aishah Radhi Binti Izzuddin', 'status' => 'Labelling', 'volume' => '5mL', 'expiry' => 'May 15, 2024', 'eligibility' => 'Passed'],
                    ['id' => 5, 'donor' => 'Nor Atiqah Humaira Binti Ishak', 'status' => 'Dispatching', 'volume' => '5mL', 'expiry' => 'Apr 28, 2024', 'eligibility' => 'Passed'],
                ] as $record)
                <div class="record-item">
                    <div class="milk-donor-info">
                        <div class="milk-icon-wrapper">
                            <i class="fas fa-bottle-droplet milk-icon"></i>
                        </div>
                        <div>
                            {{-- This div contains the vertically stacked elements, fixed in CSS --}}
                            <span class="milk-id">Milk ID #{{ $record['id'] }}</span>
                            <span class="donor-name">{{ $record['donor'] }}</span>
                        </div>
                    </div>

                    <div class="clinical-status">
                        <span class="status-tag status-{{ strtolower($record['status']) }}">{{ $record['status'] }}</span>
                    </div>

                    <div class="volume-data">{{ $record['volume'] }}</div>
                    <div class="expiry-date">{{ $record['expiry'] }}</div>

                    <div class="eligibility-status">
                        <span class="eligibility-tag eligibility-{{ strtolower($record['eligibility']) }}">{{ $record['eligibility'] }}</span>
                    </div>

                    <div class="actions">
                        <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
                        <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
                        <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Placeholder for Modal and Scripts --}}
{{-- <div id="editMilkModal" class="modal">...</div> --}}

<script>
    // Add script logic here for modal toggling, etc.
</script>
@endsection