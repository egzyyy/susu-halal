@extends('layouts.doctor')

@section('title', 'Donor Appointment Record')

@section('content')
<link rel="stylesheet" href="{{ asset('css/doctor_list-of-donor-appointments.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="container">

    <div class="main-content">
<div class="appointments-record-page">
  <div class="page-header">
    <h1>Donor Appointment Record</h1>
  </div>

  <!-- Milk Donation Appointment Section -->
  <div class="appointments-section">
    <div class="section-header">
      <h2>Milk Donation Appointment</h2>
      <div class="header-actions">
        <button class="btn-icon" title="Search">
          <i class="fas fa-search"></i> Search
        </button>
        <button class="btn-icon" title="Filter">
          <i class="fas fa-filter"></i> Filter
        </button>
      </div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
      <button class="tab active">All Appointment <span class="badge">69</span></button>
      <button class="tab">This Month <span class="badge">13</span></button>
      <button class="tab">Pending <span class="badge">11</span></button>
    </div>

    <!-- Milk Donation Table -->
    <div class="table-container">
      <table class="records-table">
        <thead>
          <tr>
            <th>DATE</th>
            <th>AMOUNT</th>
            <th>STATUS</th>
            <th>TYPE</th>
            <th>LOCATION</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>15.5.2024</td>
            <td>1000ml</td>
            <td><span class="status pending">Pending</span></td>
            <td>MILK DROP OFF</td>
            <td>Main Center</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
              <button class="btn-confirm" title="Confirm">Confirm</button>
            </td>
          </tr>
          <tr>
            <td>8.5.2025</td>
            <td>1000ml</td>
            <td><span class="status pending">Pending</span></td>
            <td>MILK DROP OFF</td>
            <td>North Branch</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
          <tr>
            <td>1.5.2024</td>
            <td>800ml</td>
            <td><span class="status pending">Pending</span></td>
            <td>COLLECTION</td>
            <td>Home</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
          <tr>
            <td>24.4.2024</td>
            <td>1000ml</td>
            <td><span class="status confirmed">Confirmed</span></td>
            <td>COLLECTION</td>
            <td>No.50 Kg Benuas</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
          <tr>
            <td>28.4.2024</td>
            <td>850ml</td>
            <td><span class="status confirmed">Confirmed</span></td>
            <td>COLLECTION</td>
            <td>No.60 Benuas Jaya</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pumping Kit Appointment Section -->
  <div class="appointments-section">
    <div class="section-header">
      <h2>Pumping Kit Appointment</h2>
      <div class="header-actions">
        <button class="btn-icon" title="Search">
          <i class="fas fa-search"></i> Search
        </button>
        <button class="btn-icon" title="Filter">
          <i class="fas fa-filter"></i> Filter
        </button>
      </div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
      <button class="tab active">All Appointment <span class="badge">69</span></button>
      <button class="tab">This Month <span class="badge">13</span></button>
      <button class="tab">Pending <span class="badge">11</span></button>
    </div>

    <!-- Pumping Kit Table -->
    <div class="table-container">
      <table class="records-table">
        <thead>
          <tr>
            <th>REFERENCE NO</th>
            <th>DONOR ID</th>
            <th>DATE</th>
            <th>STATUS</th>
            <th>LOCATION</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#MB-2025-0458</td>
            <td>#243</td>
            <td>15.5.2024</td>
            <td><span class="status pending">Pending</span></td>
            <td>Main Center</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
          <tr>
            <td>#MB-2025-0459</td>
            <td>#456</td>
            <td>8.5.2025</td>
            <td><span class="status confirmed">Confirmed</span></td>
            <td>North Branch</td>
            <td class="actions">
              <button class="btn-more" title="Actions"><i class="fas fa-ellipsis-v"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

@endsection