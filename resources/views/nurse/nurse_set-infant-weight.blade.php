@extends('layouts.nurse')

@section('title', 'Infant Weight Setting')

@section('content')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/nurse_set-infant-weight.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="container">
        <div class="main-content">
            <div class="page-header">
                <h1>Infant Weight</h1>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>List of Infants</h2>
                    <div class="actions">
                        <button class="btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Search
                        </button>
                        <button class="btn">
                            <i class="fa-solid fa-filter"></i>
                            Filter
                        </button>
                        <button class="btn btn-more">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </div>
                </div>

                <table class="infants-table">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>NICU Cubicle No.</th>
                            <th>Last Updated</th>
                            <th>Current Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([
                            [
                                'id' => 'P001',
                                'name' => 'Sarah Ahmad Binti Fauzi',
                                'nicu' => 'A101',
                                'last_updated' => 'Jan 12, 2024',
                                'weight' => '2.0'
                            ],
                            [
                                'id' => 'P002',
                                'name' => 'Ahmad Jebon Bin Arif',
                                'nicu' => 'A102',
                                'last_updated' => 'Jan 12, 2024',
                                'weight' => '4.5'
                            ]
                        ] as $infant)
                            <tr>
                                <td>
                                    <div class="patient-info">
                                        <div class="patient-avatar">
                                            <i class="fa-solid fa-baby"></i>
                                        </div>
                                        <div class="patient-details">
                                            <strong>{{ $infant['id'] }}</strong>
                                            <span>{{ $infant['name'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $infant['nicu'] }}</td>
                                <td>{{ $infant['last_updated'] }}</td>
                                <td>
                                    <div class="weight-display">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        <span>{{ $infant['weight'] }} kg</span>
                                    </div>
                                </td>
                                <td class="actions">
                                    <button class="btn-view" title="View"><i class="fa-solid fa-eye"></i></button>
                                    <button class="btn-edit" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn-more" title="More"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Add this modal HTML before @endsection in your blade file --}}

<!-- Daily Weight Entry Modal -->
<div id="weightModal" class="weight-modal">
  <div class="weight-modal-overlay"></div>
  <div class="weight-modal-content">
    
    <!-- Modal Header -->
    <div class="weight-modal-header">
      <div>
        <h2>Daily Weight Entry</h2>
        <p>Record daily weight for NICU patients</p>
      </div>
      <button class="weight-modal-close" onclick="closeWeightModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="weight-modal-body">
      <form id="weightEntryForm">
        
        <!-- Select Patient -->
        <div class="weight-form-group">
          <label>Select Patient ID <span class="required">*</span></label>
          <select id="patientSelect" required onchange="updatePatientInfo()">
            <option value="">Select a patient...</option>
            <option value="P001" data-name="Sarah Ahmad Binti Fauzi" data-family="Ahmad Family" data-mrn="MRN-2024-001" data-dob="2024-01-01" data-diagnosis="Premature Birth - 32 weeks" data-cubicle="A101">P001 - Sarah Ahmad Binti Fauzi</option>
            <option value="P002" data-name="Ahmad Jebon Bin Arif" data-family="Jebon Family" data-mrn="MRN-2024-002" data-dob="2024-01-05" data-diagnosis="Low Birth Weight" data-cubicle="A102">P002 - Ahmad Jebon Bin Arif</option>
          </select>
        </div>

        <!-- Patient Information Section -->
        <div class="patient-info-section">
          <h3>Patient Information</h3>
          <div class="info-grid">
            
            <div class="info-item">
              <label>Patient Name</label>
              <div class="info-value" id="displayPatientName">-</div>
            </div>

            <div class="info-item">
              <label>Family</label>
              <div class="info-value" id="displayFamily">-</div>
            </div>

            <div class="info-item">
              <label>Medical Record Number</label>
              <div class="info-value" id="displayMRN">-</div>
            </div>

            <div class="info-item">
              <label>Date of Birth</label>
              <div class="info-value" id="displayDOB">-</div>
            </div>

            <div class="info-item">
              <label>Diagnosis</label>
              <div class="info-value" id="displayDiagnosis">-</div>
            </div>

            <div class="info-item">
              <label>Cubicle Number</label>
              <div class="info-value" id="displayCubicle">-</div>
            </div>

          </div>
        </div>

        <!-- Weight Entry -->
        <div class="weight-form-group">
          <label>Enter Today's Weight (kg) <span class="required">*</span></label>
          <input 
            type="number" 
            id="weightInput" 
            placeholder="e.g., 2.45" 
            step="0.01" 
            min="0"
            required>
        </div>

        <!-- Action Buttons -->
        <div class="weight-modal-footer">
          <button type="button" class="btn-cancel" onclick="closeWeightModal()">Cancel</button>
          <button type="submit" class="btn-save">Save Record</button>
        </div>

      </form>
    </div>

  </div>
</div>

<script>
// Open modal when Edit button is clicked
document.addEventListener('DOMContentLoaded', function() {
  const editButtons = document.querySelectorAll('.btn-edit');
  editButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const patientId = row.querySelector('.patient-details strong').textContent;
      
      // Open modal
      document.getElementById('weightModal').classList.add('active');
      document.body.style.overflow = 'hidden';
      
      // Pre-select patient
      const patientSelect = document.getElementById('patientSelect');
      patientSelect.value = patientId;
      updatePatientInfo();
    });
  });
});

// Update patient information display
function updatePatientInfo() {
  const select = document.getElementById('patientSelect');
  const selectedOption = select.options[select.selectedIndex];
  
  if (select.value) {
    document.getElementById('displayPatientName').textContent = selectedOption.dataset.name || '-';
    document.getElementById('displayFamily').textContent = selectedOption.dataset.family || '-';
    document.getElementById('displayMRN').textContent = selectedOption.dataset.mrn || '-';
    document.getElementById('displayDOB').textContent = selectedOption.dataset.dob || '-';
    document.getElementById('displayDiagnosis').textContent = selectedOption.dataset.diagnosis || '-';
    document.getElementById('displayCubicle').textContent = selectedOption.dataset.cubicle || '-';
  } else {
    // Reset all fields
    document.getElementById('displayPatientName').textContent = '-';
    document.getElementById('displayFamily').textContent = '-';
    document.getElementById('displayMRN').textContent = '-';
    document.getElementById('displayDOB').textContent = '-';
    document.getElementById('displayDiagnosis').textContent = '-';
    document.getElementById('displayCubicle').textContent = '-';
  }
}

// Close modal
function closeWeightModal() {
  document.getElementById('weightModal').classList.remove('active');
  document.body.style.overflow = 'auto';
  
  // Reset form
  document.getElementById('weightEntryForm').reset();
  updatePatientInfo();
}

// Close on overlay click
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('weight-modal-overlay')) {
    closeWeightModal();
  }
});

// Handle form submission
document.getElementById('weightEntryForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const patientId = document.getElementById('patientSelect').value;
  const weight = document.getElementById('weightInput').value;
  
  if (!patientId) {
    alert('Please select a patient');
    return;
  }
  
  if (!weight || weight <= 0) {
    alert('Please enter a valid weight');
    return;
  }
  
  // Here you would send the data to your Laravel backend
  console.log({
    patientId: patientId,
    weight: weight,
    date: new Date().toISOString().split('T')[0]
  });
  
  alert('Weight record saved successfully!');
  closeWeightModal();
});

// Escape key to close
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    const modal = document.getElementById('weightModal');
    if (modal.classList.contains('active')) {
      closeWeightModal();
    }
  }
});
</script>

<style>
/* ========== Weight Modal Styles ========== */
.weight-modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  align-items: center;
  justify-content: center;
}

.weight-modal.active {
  display: flex;
}

.weight-modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(4px);
}

.weight-modal-content {
  position: relative;
  background: white;
  border-radius: 16px;
  width: 90%;
  max-width: 800px;
  max-height: 90vh;
  overflow: hidden;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ========== Modal Header ========== */
.weight-modal-header {
  background: linear-gradient(135deg, #57A6A1 0%, #1A5F7A 100%);
  padding: 28px 32px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.weight-modal-header h2 {
  color: white;
  font-size: 22px;
  font-weight: 600;
  margin: 0 0 4px 0;
}

.weight-modal-header p {
  color: rgba(255, 255, 255, 0.9);
  font-size: 14px;
  margin: 0;
}

.weight-modal-close {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: white;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
  flex-shrink: 0;
}

.weight-modal-close:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: rotate(90deg);
}

/* ========== Modal Body ========== */
.weight-modal-body {
  padding: 32px;
  max-height: calc(90vh - 120px);
  overflow-y: auto;
}

/* ========== Form Styles ========== */
.weight-form-group {
  margin-bottom: 24px;
}

.weight-form-group label {
  display: block;
  color: #374151;
  font-weight: 600;
  margin-bottom: 8px;
  font-size: 14px;
}

.weight-form-group .required {
  color: #dc2626;
}

.weight-form-group input,
.weight-form-group select {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  color: #374151;
  transition: all 0.2s;
  font-family: 'Inter', sans-serif;
}

.weight-form-group input:focus,
.weight-form-group select:focus {
  outline: none;
  border-color: #57A6A1;
  box-shadow: 0 0 0 3px rgba(87, 166, 161, 0.1);
}

.weight-form-group select {
  cursor: pointer;
  background: white;
}

/* ========== Patient Information Section ========== */
.patient-info-section {
  margin-bottom: 28px;
  padding: 20px;
  background: #f9fafb;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
}

.patient-info-section h3 {
  color: #1f2937;
  font-size: 16px;
  font-weight: 600;
  margin: 0 0 16px 0;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

.info-item label {
  display: block;
  color: #6b7280;
  font-size: 12px;
  font-weight: 500;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.info-value {
  color: #1f2937;
  font-size: 14px;
  font-weight: 500;
  padding: 8px 12px;
  background: white;
  border-radius: 6px;
  border: 1px solid #e5e7eb;
}

/* ========== Modal Footer ========== */
.weight-modal-footer {
  display: flex;
  gap: 12px;
  justify-content: flex-end;
  margin-top: 32px;
  padding-top: 24px;
  border-top: 1px solid #e5e7eb;
}

.btn-cancel,
.btn-save {
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.2s;
  border: none;
}

.btn-cancel {
  background: #f3f4f6;
  color: #374151;
}

.btn-cancel:hover {
  background: #e5e7eb;
}

.btn-save {
  background: linear-gradient(135deg, #57A6A1 0%, #1A5F7A 100%);
  color: white;
  box-shadow: 0 4px 6px rgba(26, 95, 122, 0.2);
}

.btn-save:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(26, 95, 122, 0.3);
}

.btn-save:active {
  transform: translateY(0);
}

/* ========== Scrollbar Styling ========== */
.weight-modal-body::-webkit-scrollbar {
  width: 8px;
}

.weight-modal-body::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.weight-modal-body::-webkit-scrollbar-thumb {
  background: #57A6A1;
  border-radius: 10px;
}

.weight-modal-body::-webkit-scrollbar-thumb:hover {
  background: #1A5F7A;
}

/* ========== Responsive Design ========== */
@media (max-width: 768px) {
  .weight-modal-content {
    width: 95%;
    max-height: 95vh;
  }
  
  .weight-modal-body {
    padding: 24px 20px;
  }
  
  .weight-modal-header {
    padding: 20px;
  }
  
  .info-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  
  .weight-modal-footer {
    flex-direction: column-reverse;
  }
  
  .btn-cancel,
  .btn-save {
    width: 100%;
  }
}
</style>
@endsection
