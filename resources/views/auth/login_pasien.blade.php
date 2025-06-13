@extends('layouts.app')

@section('content')
<style>
    :root {
        --telkomedika-red: #E4002B;
        --telkomedika-gray-dark: #343a40;
        --telkomedika-gray-light: #f8f9fa;
        --telkomedika-gray-border: #dee2e6;
    }
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background-color: var(--telkomedika-gray-light);
        color: var(--telkomedika-gray-dark);
    }
    .auth-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 400px;
        margin: 40px auto;
        border-top: 8px solid var(--telkomedika-red);
    }
    .auth-title {
        color: var(--telkomedika-red);
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.3rem;
        color: var(--telkomedika-gray-dark);
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1px solid var(--telkomedika-gray-border);
        border-radius: 6px;
        margin-bottom: 1.1rem;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .auth-btn {
        background: var(--telkomedika-red);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 0.75rem;
        font-weight: bold;
        width: 100%;
        margin-top: 0.5rem;
        transition: background 0.2s;
        font-size: 1.1rem;
    }
    .auth-btn:hover {
        background: #c70025;
    }
    .alert-error {
        background:#ffeaea;
        color:#e4002b;
        border:1px solid #e4002b;
        border-radius:6px;
        padding:10px 15px;
        margin-bottom:18px;
    }
    .forgot-link {
        color: var(--telkomedika-red);
        font-size: 0.95rem;
        text-decoration: underline;
        float: right;
        margin-bottom: 1rem;
    }
    .auth-link {
        color: var(--telkomedika-red);
        text-decoration: underline;
        font-weight: 500;
        display: block;
        text-align: center;
        margin-top: 1.2rem;
    }
</style>
<div class="auth-card">
    <div class="auth-title">Login Pasien</div>
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom:2px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('pasien.login') }}" method="POST">
        @csrf
        <div>
            <label class="form-label" for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required value="{{ old('username') }}">
        </div>
        <div>
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <a href="#" class="forgot-link">Forgot password?</a>
        <button type="submit" class="auth-btn">Login</button>
    </form>
    <a href="{{ route('pasien.create') }}" class="auth-link">Signup</a>
</div>
@endsection 