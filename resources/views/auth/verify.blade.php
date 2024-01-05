@extends('layouts.auth')
@section('title', 'Verify Email')

@section('content')
    <div class="page-error">
        <div class="page-inner">
            <h2>Please Verify Your Email</h2>
            <div class="page-description">
                Click this button if you didn't receive an email.
                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg mt-2" id="resend-btn">
                        Resend Verification Email
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="simple-footer mt-5">
        Copyright &copy; Stisla 2018
    </div>
@endsection
