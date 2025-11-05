@extends('layouts.donor')

@section('title', 'My Appointments')

@section('content')
<link rel="stylesheet" href="{{ asset('css/donor_my-appointments.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="main-content">
  <div class="page-header">
    <h1>My Appointments</h1>
    <p>View and manage your milk donation appointments.</p>
  </div>

  <div class="appointments-container">
    <table class="records-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Type</th>
          <th>Location</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>15.5.2025</td>
          <td>1000 ml</td>
          <td><span class="status verified">Verified</span></td>
          <td>Milk Drop Off</td>
          <td>Main Foyer</td>
          <td class="actions">
            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
          </td>
        </tr>
        <tr>
          <td>21.5.2025</td>
          <td>1000 ml</td>
          <td><span class="status pending">Pending</span></td>
          <td>Milk Drop Off</td>
          <td>Front Counter</td>
          <td class="actions">
            <button class="btn-view" title="View"><i class="fas fa-eye"></i></button>
            <button class="btn-delete" title="Delete"><i class="fas fa-trash"></i></button>
            <button class="btn-more" title="More"><i class="fas fa-ellipsis-v"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
