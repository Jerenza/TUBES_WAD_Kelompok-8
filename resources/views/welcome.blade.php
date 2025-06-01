<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TelkoMedika Staff Portal</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }
        header {
            background-color: #d90429;
            color: white;
            padding: 1em 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            height: 60px;
        }
        .hero {
        background-image: url('/images/hero-background.png'); 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover; 
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
}

        
        .hero h1 {
            font-size: 3em;
            margin-bottom: 0.5em;
        }
        .hero p {
            font-size: 1.2em;
            margin-bottom: 1em;
        }
        .hero button {
            padding: 10px 20px;
            background-color: #ef233c;
            border: none;
            color: white;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }
        .staff-list {
            padding: 2em;
            background-color: #fff;
        }
        .staff-card {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            padding: 1em;
            margin-bottom: 1em;
            border-radius: 10px;
        }
        footer {
            background-color: #d90429;
            color: white;
            padding: 1em;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <img src="/images/telkomedika-logo.png" alt="TelkoMedika Logo" class="logo">
        <h2>TelkoMedika - Connected Health Solution</h2>
    </header>

    <div class="hero">
        <h1>Welcome to TelkoMedika</h1>
        <p>Your health staff portal</p>
        <a href="{{ route('staff.index') }}">
    <button>Staff</button>
    </a>
    </div>  

    <section id="staff-section" class="staff-list">
        <h2>Staff List</h2>
        @foreach ($staffs as $staff)
            <div class="staff-card">
                <strong>Name:</strong> {{ $staff->nama }} <br>
                <strong>Username:</strong> {{ $staff->username }} <br>
                <strong>Email:</strong> {{ $staff->email }} <br>
                <strong>Role:</strong> {{ $staff->role }}
            </div>
        @endforeach
    </section>

    <footer>
        &copy; {{ date('Y') }} TelkoMedika. All rights reserved.
    </footer>
</body>
</html>
