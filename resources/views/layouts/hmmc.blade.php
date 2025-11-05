<!-- resources/views/layouts/doctor.blade.php -->
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Doctor Dashboard')</title>
  <link rel="stylesheet" href="{{ asset('css/hmmc_sidebar.css') }}">
  <!-- Font Awesome CDN -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  integrity="sha512-xh6O/z3OJU5yExlqQxFJZrVfdkY3ZzA5C4lX2pB2VVDzE1d1ZVnVNQ6mvdx4+hIY1Y1DOfZ1f2k+LhFhSkk5Xg=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>

</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <h2>HMMC</h2>
      </div>

      <div class="sidebar-section">
        <h4>HMMC</h4>
        <ul>
          <li><a href="#">Dashboard</a></li>
          <li class="{{ request()->routeIs('doctor.milk-request-form') ? 'active' : '' }}">
      <a href="{{ route('doctor.milk-request-form') }}">Request Milk Form</a>
    </li>
          <li><a href="#">Reports</a></li>
        </ul>
      </div>

      <div class="sidebar-section">
        <h4>Management</h4>
        <ul>
          <li><a href="#">Request</a></li>
          <li><a href="#">Recipient</a></li>
          <li><a href="#">Settings</a></li>
          <li class="{{ request()->routeIs('doctor.list-milk-request') ? 'active' : '' }}">
      <a href="{{ route('doctor.list-milk-request') }}">Request List</a>
    </li>
        </ul>
      </div>

      <div class="sidebar-section">
        <h4>Explore</h4>
        <ul>
          <li><a href="#">Audit Logs</a></li>
          <li><a href="#">Activity Monitor</a></li>
        </ul>
      </div>
    </aside>

    <main class="main-content">
      @yield('content')
    </main>
  </div>
</body>
</html>
