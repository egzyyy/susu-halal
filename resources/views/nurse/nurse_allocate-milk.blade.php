@extends('layouts.nurse')

@section('title', 'Milk Request Records')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/nurse_allocate-milk.css') }}">

<div class="container">
  <div class="main-content">

    <div class="page-header">
      <h1>Milk Request Records</h1>
      <p>Milk Processing and Records</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Milk Processing and Records</h2>
        <div class="actions">
          <button class="btn"><i class="fas fa-search"></i> Search</button>
          <button class="btn"><i class="fas fa-filter"></i> Filter</button>
          <button class="btn"><i class="fas fa-ellipsis-h"></i></button>
        </div>
      </div>

      <table class="records-table">
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>NICU</th>
            <th>Date Requested</th>
            <th>Request Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ([
            ['id' => 'P001', 'name' => 'Sarah Ahmad Binti Fauzi', 'nicu' => '3B', 'date' => 'Jan 12, 2024', 'status' => 'approved'],
            ['id' => 'P002', 'name' => 'Maryam Binti Othman', 'nicu' => '2A', 'date' => 'Feb 05, 2024', 'status' => 'approved'],
            ['id' => 'P003', 'name' => 'Fatimah Az-zahra Binti Mohd Nor', 'nicu' => '1C', 'date' => 'May 10, 2024', 'status' => 'pending'],
            ['id' => 'P004', 'name' => 'Aishah Radhi Binti Izzuddin', 'nicu' => '4B', 'date' => 'Dec 18, 2023', 'status' => 'approved'],
            ['id' => 'P005', 'name' => 'Nor Atiqah Humaira Binti Ishak', 'nicu' => '2B', 'date' => 'Mar 22, 2024', 'status' => 'rejected']
          ] as $patient)
          <tr>
            <td>
              <div class="patient-info">
                <i class="fas fa-bottle-droplet milk-icon"></i>
                <div>
                  <strong>{{ $patient['id'] }}</strong><br>
                  <span>{{ $patient['name'] }}</span>
                </div>
              </div>
            </td>
            <td>{{ $patient['nicu'] }}</td>
            <td>{{ $patient['date'] }}</td>
            <td><span class="status {{ $patient['status'] }}">{{ ucfirst($patient['status']) }}</span></td>
            <td class="actions">
  <button class="btn-done" title="Done"><i class="fas fa-check"></i></button>
    <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
