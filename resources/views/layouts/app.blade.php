<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link.active {
            font-weight: bold;
            color: #0d6efd !important;
        }
        .sidebar-nav a {
            margin-right: 15px;

        }
        .content-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('employees.index') }}">HR SYSTEM</a>
            <div class="d-flex">
                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">Employees</a>
<a href="{{ route('departments.index') }}" class="nav-link ms-3 {{ request()->routeIs('departments.*') ? 'active' : '' }}">Departments</a>            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="container content-container">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
