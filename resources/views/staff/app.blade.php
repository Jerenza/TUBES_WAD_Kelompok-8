@extends('welcome') 

@section('title', 'Welcome')

@section('content')
<div class="hero-section" style="background-image: url('/images/banner-telkomedika.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: white;">
    <h1 style="font-size: 3em; margin: 0;">Welcome to TelkoMedika</h1>
    <p style="font-size: 1.2em; margin-top: 10px;">Your health staff portal</p>
    <a href="{{ url('/staff') }}" class="btn-danger">See Our Staff</a>
</div>

<section class="staff-list">
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
@endsection