@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center;margin-top: 100px;">
        <div
            style="height: 60%; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
            <div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/BMW.svg" width="80" alt="Logo"
                    style="margin-bottom: 20px;">
            </div>
            <h3 style="margin-bottom: 20px; color: #333;">Employee Data Master</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div style="margin-bottom: 15px;">
                    <input type="email" name="email" placeholder="Enter Your Email" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <input type="password" name="password" placeholder="Enter Your Password" class="form-control"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" required>
                </div>
                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 10px; background-color: #007bff; border: none; border-radius: 5px; color: white; font-weight: bold;">
                    Log In
                </button>
            </form>
        </div>
    </div>
@endsection
