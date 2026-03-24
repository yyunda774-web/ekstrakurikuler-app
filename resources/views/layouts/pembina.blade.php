<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pembina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --border: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--bg-primary) 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255,255,255,0.1);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            backdrop-filter: blur(10px);
            font-weight: 500;
        }

        /* Navigation */
        nav {
            background: var(--bg-secondary);
            padding: 1rem 0;
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(20px);
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--bg-primary), #f1f5f9);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-left a:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .logout-form {
            display: inline-block;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Card */
        .card {
            background: var(--bg-secondary);
            padding: 2rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        /* Title */
        .title {
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Search Box */
        .search-box {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            background: var(--bg-primary);
            padding: 1rem;
            border-radius: var(--radius);
            border: 2px solid var(--border);
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgb(99 102 241 / 0.1);
        }

        .search-box input {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 2px solid transparent;
            border-radius: 12px;
            background: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgb(99 102 241 / 0.1);
        }

        .search-btn {
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Filter Box */
        .filter-box {
            margin-bottom: 2rem;
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            background: var(--bg-primary);
            border: 2px solid var(--border);
            border-radius: 50px;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Table Wrapper */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: var(--bg-secondary);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            padding: 1.25rem 1rem;
            font-weight: 600;
            text-align: left;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        tr {
            transition: all 0.3s ease;
        }

        tr:hover {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            transform: scale(1.01);
        }

        /* Buttons */
        .btn {
            padding: 0.625rem 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-terima {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
        }

        .btn-terima:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-tolak {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }

        .btn-tolak:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Badge */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-pending { 
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white; 
        }

        .badge-diterima { 
            background: linear-gradient(135deg, var(--success), #059669);
            color: white; 
        }

        .badge-ditolak { 
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white; 
        }

        /* Text */
        .text-muted {
            color: var(--text-secondary) !important;
            font-size: 0.875rem;
        }

        /* Empty State */
        .empty {
            text-align: center;
            color: var(--text-secondary);
            padding: 4rem 2rem;
            background: var(--bg-primary);
            border-radius: var(--radius);
            border: 2px dashed var(--border);
        }

        .empty i {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content, .nav-content, .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .search-box {
                flex-direction: column;
            }
            
            .card {
                padding: 1.5rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card, .search-box, .filter-box {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-content">
            <div class="header-title">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard Pembina
            </div>
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                {{ auth()->user()->name }}
            </div>
        </div>
    </header>

    <nav>
        <div class="nav-content">
            <div class="nav-left">
                <a href="{{ route('pembina.dashboard') }}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-right">
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>