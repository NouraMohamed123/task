@extends('layouts.dashboard.app')

@section('content')
<form method="POST" action="{{ route('dashboard.students.store') }}">
    @csrf
    @include('dashboard.partials._errors')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">

    </div>

    <div class="form-group">
        <label for="name">Username</label>
        <input type="text" name="username" value="{{ old('username') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email"  value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">phone</label>
        <input type="text" name="phone" alue="{{ old('phone') }}" class="form-control">
    </div>
    <div class="text-end">
        <button  class="px-20  mt-5 btn btn-primary btn-hover-rise me-5 fw-bolder">  create </button>
    </div>
</form>
@endsection
