@extends('layouts.donor')

@section('title', 'Confirm Appointment')

@section('content')
<link rel="stylesheet" href="{{ asset('css/donor_confirm-appointment.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="confirm-appointment-page">
  <div class="page-header">
    <h1>Milk Donation Appointment Form</h1>
  </div>

  <div class="confirmation-container">
    <div class="confirmation-header">
      <h2>Confirm Your Appointment Details</h2>
      <p>Please review your appointment details carefully before submitting.<br>
      Our milk bank team will contact you shortly to confirm your schedule and provide further instructions.</p>
    </div>

    <form id="confirmAppointmentForm" method="POST" action="#">
      @csrf
      
      <div class="details-grid">
        <!-- Left Column -->
        <div class="details-column">
          <!-- Amount of Milk -->
          <div class="detail-item">
            <label>Amount of Milk to Donate (ml)</label>
            <div class="detail-value">
              {{ $appointment->milk_amount ?? '1000' }} ml
            </div>
            <input type="hidden" name="milk_amount" value="{{ $appointment->milk_amount ?? '1000' }}">
          </div>

          <!-- Milk Storage Condition -->
          <div class="detail-item">
            <label>Milk Storage Condition</label>
            <div class="detail-value">
              {{ ucfirst(str_replace('_', ' ', $appointment->storage_condition ?? 'Frozen')) }}
            </div>
            <input type="hidden" name="storage_condition" value="{{ $appointment->storage_condition ?? 'frozen' }}">
          </div>

          <!-- Container Type -->
          <div class="detail-item">
            <label>Container Type</label>
            <div class="detail-value">
              {{ ucfirst(str_replace('_', ' ', $appointment->container_type ?? 'Milk Storage Bag')) }}
            </div>
            <input type="hidden" name="container_type" value="{{ $appointment->container_type ?? 'milk_bag' }}">
          </div>
        </div>

        <!-- Right Column -->
        <div class="details-column">
          <!-- Donation Method -->
          <div class="detail-item">
            <label>Donation Method</label>
            <div class="detail-value">
              {{ ucfirst(str_replace('_', ' ', $appointment->delivery_method ?? 'Drop-off')) }}
            </div>
            <input type="hidden" name="delivery_method" value="{{ $appointment->delivery_method ?? 'drop_off' }}">
          </div>

          <!-- Preferred Date & Time -->
          <div class="detail-item">
            <label>Preferred Date & Time</label>
            <div class="detail-value">
              {{ $appointment->appointment_datetime ?? 'May 15, 2025 at 10:00 AM' }}
            </div>
            <input type="hidden" name="appointment_datetime" value="{{ $appointment->appointment_datetime ?? '' }}">
          </div>

          <!-- Preferred Location -->
          <div class="detail-item">
            <label>Preferred Location</label>
            <div class="detail-value">
              {{ ucfirst(str_replace('_', ' ', $appointment->location ?? 'Main Foyer')) }}
            </div>
            <input type="hidden" name="location" value="{{ $appointment->location ?? 'main_foyer' }}">
          </div>
        </div>
      </div>

      <!-- Remarks (Full Width) -->
      <div class="detail-item full-width">
        <label>Remarks</label>
        <div class="detail-value remarks-box">
          {{ $appointment->remarks ?? 'No additional remarks provided.' }}
        </div>
        <input type="hidden" name="remarks" value="{{ $appointment->remarks ?? '' }}">
      </div>

      <!-- Form Actions -->
      <div class="form-actions">
        <button type="button" class="btn-back" onclick="window.history.back()">
          <i class="fas fa-arrow-left"></i> Back to Edit
        </button>
        <button type="submit" class="btn-confirm">
          <i class="fas fa-check-circle"></i> Confirm Appointment
        </button>
      </div>
    </form>
  </div>
</div>

@endsection