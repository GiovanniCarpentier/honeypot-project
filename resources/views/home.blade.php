<?php session_start(); ?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @guest
            
        @else
        @auth
            <?php   
                $_SESSION["auth"] = Auth::user()-> id;
                $authGuard =Auth::guard(null);
                if (Auth::user()->hasRole("Admin")){
                    $_SESSION["role"] = "Admin";
                    
                }else{
                    $_SESSION["role"] = "Guest";
                }
                
                
            ?>
        @endauth
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        @endguest

    </div>
</div>
@endsection
