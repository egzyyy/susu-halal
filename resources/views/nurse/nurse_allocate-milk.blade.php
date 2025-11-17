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

    <!-- ==========================
      VIEW DETAILS POPUP MODAL
=========================== -->
<div id="viewModal" class="modal-overlay" style="display:none;">
  <div class="modal-box">
    
    <div class="modal-header">
      <h3>Milk Request Details</h3>
      <button class="modal-close">&times;</button>
    </div>

    <div class="modal-body">

      <!-- Patient Details -->
      <div class="modal-section">
        <h4>Patient Information</h4>
        <p><strong>ID:</strong> <span id="modalPatientId"></span></p>
        <p><strong>Name:</strong> <span id="modalPatientName"></span></p>
        <p><strong>NICU:</strong> <span id="modalPatientNicu"></span></p>
        <p><strong>Date Requested:</strong> <span id="modalPatientDate"></span></p>
      </div>

      <hr>

      <!-- Allocated Milk IDs -->
      <div class="modal-section">
        <h4>Allocated Milk</h4>

        <div id="milkListContainer">
          <!-- Dynamic rows added via JS -->
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button class="save-btn">Save Changes</button>
      <button class="modal-close cancel-btn">Cancel</button>
    </div>

  </div>
</div>


  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const viewButtons = document.querySelectorAll(".btn-view");
    const modal = document.getElementById("viewModal");
    const closeButtons = document.querySelectorAll(".modal-close");

    viewButtons.forEach(btn => {
        btn.addEventListener("click", function () {

            // Example data — replace with your actual DB data later
            const patient = {
                id: "P001",
                name: "Sarah Ahmad Binti Fauzi",
                nicu: "3B",
                date: "Jan 12, 2024",
                milk_ids: ["MILK001", "MILK002", "MILK003"]
            };

            // Insert patient info
            document.getElementById("modalPatientId").textContent = patient.id;
            document.getElementById("modalPatientName").textContent = patient.name;
            document.getElementById("modalPatientNicu").textContent = patient.nicu;
            document.getElementById("modalPatientDate").textContent = patient.date;

            // Generate milk rows
            const container = document.getElementById("milkListContainer");
            container.innerHTML = "";

            patient.milk_ids.forEach(id => {
                const row = document.createElement("div");
                row.className = "milk-row";
                row.innerHTML = `
                    <input type="checkbox" class="milk-check" data-id="${id}">
                    <span><strong>${id}</strong></span>
                    <input type="datetime-local" class="milk-datetime">
                `;
                container.appendChild(row);
            });

            // Show date/time input only when ticked
            container.querySelectorAll(".milk-check").forEach(check => {
                check.addEventListener("change", function() {
                    const dt = this.parentElement.querySelector(".milk-datetime");
                    dt.style.display = this.checked ? "block" : "none";
                });
            });

            modal.style.display = "flex";
        });
    });

    closeButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            modal.style.display = "none";
        });
    });

});
</script>

@endsection
