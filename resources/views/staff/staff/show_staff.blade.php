@extends('staff.layouts.app')

@section('title', 'Staff Details')

@section('content')
    <h1>Staff Details</h1>
    <p><strong>Name:</strong> {{ $staff->nama }}</p>
    <p><strong>Username:</strong> {{ $staff->username }}</p>
    <p><strong>Email:</strong> {{ $staff->email }}</p>
    <p><strong>Role:</strong> {{ $staff->role }}</p>
    <a href="{{ route('staff.staff.index_staff') }}">Back to List</a>
@endsection
