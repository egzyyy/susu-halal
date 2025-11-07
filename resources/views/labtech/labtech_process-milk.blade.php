@extends('layouts.labtech')

@section('title', 'Milk Processing')

@section('content')
<link rel="stylesheet" href="{{ asset('css/labtech_process-milk.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">
  <div class="main-content">

    <div class="page-header">
      <h1>Add Record Details</h1>
      <button class="btn-back"><i class="fas fa-arrow-left"></i> Back</button>
    </div>

    {{-- === Tab Navigation === --}}
    <div class="stage-tabs">
      <button class="stage-tab active" data-stage="first">First Stage</button>
      <button class="stage-tab" data-stage="second">Second Stage</button>
      <button class="stage-tab" data-stage="third">Third Stage</button>
    </div>

    {{-- === First Stage === --}}
    <div class="process-card stage-content active" id="first-stage">
      <h2>First Stage</h2>
      <h3>Screening</h3>
      <img src="{{ asset('images/lab_screening.jpg') }}" alt="Screening" style="width: 270px; height: auto;">
      <div class="form-grid">
        <div>
          <label>Start Date</label>
          <input type="date" placeholder="Enter Date">
        </div>
        <div>
          <label>End Date</label>
          <input type="date" placeholder="Enter Date">
        </div>
        <div>
          <label>Start Time</label>
          <input type="time">
        </div>
        <div>
          <label>End Time</label>
          <input type="time">
        </div>
      </div>
      <p class="time-status completed">Time left: COMPLETED</p>
      
      {{-- Data Table --}}
      <div class="data-table-container">
        <div class="table-header-info">
          <span class="animals-selected">4 Animals Selected, 4 Data Lines</span>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Ctrl No</th>
              <th>Cow Name</th>
              <th>Daily Milk</th>
              <th>Fat</th>
              <th>Pro</th>
              <th>Scc</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2</td>
              <td>ANDROME</td>
              <td>2.4</td>
              <td>5.81</td>
              <td>4.78</td>
              <td>48</td>
            </tr>
            <tr>
              <td>9</td>
              <td>SIERRA</td>
              <td>2.6</td>
              <td>6.26</td>
              <td>4.62</td>
              <td>105</td>
            </tr>
            <tr>
              <td>10</td>
              <td>RASPBRY</td>
              <td>3.0</td>
              <td>6.24</td>
              <td>4.44</td>
              <td>45</td>
            </tr>
            <tr>
              <td>11</td>
              <td>MAYPOP</td>
              <td>3.0</td>
              <td>6.18</td>
              <td>4.03</td>
              <td>82</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="button-row">
        <button class="btn-back-nav"><i class="fas fa-arrow-left"></i> Back</button>
        <button class="btn-next" onclick="switchStage('second')">Next Stage <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    {{-- === Second Stage === --}}
    <div class="process-card stage-content" id="second-stage">
      <h2>Second Stage</h2>
      <h3>Collecting</h3>
      <img src="{{ asset('images/lab_collecting.jpg') }}" alt="Collecting" style="width: 270px; height: auto;">
      <div class="form-grid">
        <div>
          <label>Start Date</label>
          <input type="date">
        </div>
        <div>
          <label>End Date</label>
          <input type="date">
        </div>
        <div>
          <label>Start Time</label>
          <input type="time">
        </div>
        <div>
          <label>End Time</label>
          <input type="time">
        </div>
      </div>
      <p class="time-status active">Time left: 23:48:10</p>
      
      {{-- Data Table --}}
      <div class="data-table-container">
        <div class="table-header-info">
          <span class="animals-selected">4 Animals Selected, 4 Data Lines</span>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Ctrl No</th>
              <th>Cow Name</th>
              <th>Daily Milk</th>
              <th>Fat</th>
              <th>Pro</th>
              <th>Scc</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2</td>
              <td>ANDROME</td>
              <td>2.4</td>
              <td>5.81</td>
              <td>4.78</td>
              <td>48</td>
            </tr>
            <tr>
              <td>9</td>
              <td>SIERRA</td>
              <td>2.6</td>
              <td>6.26</td>
              <td>4.62</td>
              <td>105</td>
            </tr>
            <tr>
              <td>10</td>
              <td>RASPBRY</td>
              <td>3.0</td>
              <td>6.24</td>
              <td>4.44</td>
              <td>45</td>
            </tr>
            <tr>
              <td>11</td>
              <td>MAYPOP</td>
              <td>3.0</td>
              <td>6.18</td>
              <td>4.03</td>
              <td>82</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="button-row">
        <button class="btn-back-stage" onclick="switchStage('first')"><i class="fas fa-arrow-left"></i> Previous</button>
        <button class="btn-next" onclick="switchStage('third')">Next Stage <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    {{-- === Third Stage === --}}
    <div class="process-card stage-content" id="third-stage">
      <h2>Third Stage</h2>
      <h3>Pasteurizing</h3>
      <img src="{{ asset('images/lab_pasteurizing.jpg') }}" alt="Pasteurizing" style="width: 270px; height: auto;">
      <div class="form-grid">
        <div>
          <label>Start Date</label>
          <input type="date">
        </div>
        <div>
          <label>End Date</label>
          <input type="date">
        </div>
        <div>
          <label>Start Time</label>
          <input type="time">
        </div>
        <div>
          <label>End Time</label>
          <input type="time">
        </div>
      </div>
      <p class="time-status pending">Time left: NOT STARTED YET</p>
      
      {{-- Data Table --}}
      <div class="data-table-container">
        <div class="table-header-info">
          <span class="animals-selected">4 Animals Selected, 4 Data Lines</span>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Ctrl No</th>
              <th>Cow Name</th>
              <th>Daily Milk</th>
              <th>Fat</th>
              <th>Pro</th>
              <th>Scc</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2</td>
              <td>ANDROME</td>
              <td>2.4</td>
              <td>5.81</td>
              <td>4.78</td>
              <td>48</td>
            </tr>
            <tr>
              <td>9</td>
              <td>SIERRA</td>
              <td>2.6</td>
              <td>6.26</td>
              <td>4.62</td>
              <td>105</td>
            </tr>
            <tr>
              <td>10</td>
              <td>RASPBRY</td>
              <td>3.0</td>
              <td>6.24</td>
              <td>4.44</td>
              <td>45</td>
            </tr>
            <tr>
              <td>11</td>
              <td>MAYPOP</td>
              <td>3.0</td>
              <td>6.18</td>
              <td>4.03</td>
              <td>82</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="button-row">
        <button class="btn-back-stage" onclick="switchStage('second')"><i class="fas fa-arrow-left"></i> Previous</button>
        <a href="{{ route('labtech.manage-milk-records') }}" class="btn-next">
    Submit <i class="fas fa-check"></i>
</a>

      </div>
    </div>

  </div>
</div>

<script>
function switchStage(stage) {
  // Hide all stage contents
  document.querySelectorAll('.stage-content').forEach(content => {
    content.classList.remove('active');
  });
  
  // Remove active class from all tabs
  document.querySelectorAll('.stage-tab').forEach(tab => {
    tab.classList.remove('active');
  });
  
  // Show selected stage
  document.getElementById(stage + '-stage').classList.add('active');
  
  // Activate corresponding tab
  document.querySelector(`[data-stage="${stage}"]`).classList.add('active');
  
  // Scroll to top
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Tab click handlers
document.querySelectorAll('.stage-tab').forEach(tab => {
  tab.addEventListener('click', function() {
    const stage = this.getAttribute('data-stage');
    switchStage(stage);
  });
});
</script>

@endsection