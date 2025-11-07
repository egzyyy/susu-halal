@extends('layouts.donor')

@section('title', 'Milk Donation Appointment')

@section('content')
<link rel="stylesheet" href="{{ asset('css/donor_appointment-form.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="appointment-form-page">
  <div class="page-header">
    <h1>Milk Donation Appointment Form</h1>
  </div>

  <div class="form-container">
    <div class="form-header">
      <div>
        <h2>Book Your Milk Appointment</h2>
        <p>Please provide the following details to schedule your milk donation.</p>
      </div>
    </div>

    <form id="milkDonationForm" method="POST" action="#">
      @csrf
      
      <div class="form-grid">
        <!-- Left Column -->
        <div class="form-column">
          <!-- Amount of Milk -->
          <div class="form-group">
            <label for="milk_amount">Amount of Milk to Donate (ml)</label>
            <div class="input-with-unit">
              <input type="number" id="milk_amount" name="milk_amount" class="form-control" required min="1">
              <span class="unit-label">ml</span>
            </div>
          </div>

          <!-- Milk Storage Condition -->
          <div class="form-group">
            <label for="storage_condition">Milk Storage Condition</label>
            <select id="storage_condition" name="storage_condition" class="form-control" required>
              <option value="">Select storage condition</option>
              <option value="frozen">Frozen (-18°C or below)</option>
              <option value="refrigerated">Refrigerated (0-4°C)</option>
              <option value="room_temp">Room Temperature</option>
            </select>
          </div>

          <!-- Container Type -->
          <div class="form-group">
            <label for="container_type">Container Type</label>
            <select id="container_type" name="container_type" class="form-control" required>
              <option value="">Select container type</option>
              <option value="milk_bag">Milk Storage Bag</option>
              <option value="bottle">Sterilized Bottle</option>
              <option value="container">Food-Grade Container</option>
            </select>
          </div>
        </div>

        <!-- Right Column -->
        <div class="form-column">
          <!-- Preferred Date & Time -->
          <div class="form-group">
            <label for="appointment_datetime">Preferred Date & Time</label>
            <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" class="form-control" required>
          </div>

          <!-- Choose One Option -->
          <div class="form-group">
            <label>Choose one option:</label>
            <div class="radio-group">
              <label class="radio-label">
                <input type="radio" name="delivery_method" value="drop_off" required>
                <span>Drop off</span>
              </label>
              <label class="radio-label">
                <input type="radio" name="delivery_method" value="collection" required>
                <span>Collection</span>
              </label>
            </div>
          </div>

          <!-- Preferred Location -->
          <div class="form-group">
            <label for="location">Preferred Location</label>
            <select id="location" name="location" class="form-control" required>
              <option value="">Select location</option>
              <option value="main_foyer">Main Foyer</option>
              <option value="front_counter">Front Counter</option>
              <option value="reception">Reception Area</option>
              <option value="milk_bank">Milk Bank Office</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Remarks (Full Width) -->
      <div class="form-group full-width">
        <label for="remarks">Remarks</label>
        <textarea id="remarks" name="remarks" class="form-control" rows="5" placeholder="Add any additional information or special instructions..."></textarea>
      </div>

      <!-- Form Actions -->
      <div class="form-actions">
        <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
        <a href="{{ route('donor.confirm-appointment') }}" class="btn-submit">Continue</a>

      </div>
    </form>
  </div>
</div>

@endsection