@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-[90vh] w-screen md:h-[85vh]">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your account has been created. Wait for the admin to verify your account!
            </div>
        @endif
        @if (Session::has('login'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your account has been verified!
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-success" role="alert">
                <strong>Error!</strong> Credentials do not match!
            </div>
        @endif
        <div class="grid grid-cols-1 h-full w-full md:grid-cols-2 bg-sky-300">
            <div class="hidden md:flex justify-center items-center">
                <div class="hidden md:flex justify-content">
                    <img src="{{ asset('images/PalabaPH-Icon.png') }}" class="h-4/6 w-full" />
                </div>
            </div>
            <div class="flex justify-center space-y-5 h-full w-full">
                <form action="{{ route('login') }}" method="POST"
                    class="flex flex-col h-4/5 w-full items-center bg-white md:h-full">
                    @csrf
                    <img src="{{ asset('images/PalabaPH-name-DARK 1.png') }}" class="h-1/10 w-1/2 mt-10" />
                    <hr class="w-4/5 mt-4" style="height: 2px">
                    <div class="text-black text-xl font-bold mt-10">Login Your Account</div>
                    <input type="text" name="email" class="border-2 border-gray-400 h-10 rounded-md w-4/6 mt-10 px-2"
                        placeholder="Username or Email">
                    <input type="password" name="password" class="border-2 border-gray-400 h-10 rounded-md w-4/6 mt-10 px-2"
                        placeholder="Password">
                    <div class="flex flex-row space-x-2 mt-8 items-center">
                        <input type="checkbox" name="remember">
                        <div class="font-bold">Remember Me</div>
                    </div>
                    <div class="flex flex-row space-x-2 mt-6 items-center">
                        <button class="bg-yellow-300 border-2 rounded-lg w-24 h-12 font-bold text-xl">Login</button>
                        <a class="font-bold text-lg cursor-pointer" href="#">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
