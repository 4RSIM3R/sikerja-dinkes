@extends('layouts.app')

@section('content')
    <form class="flex flex-col space-y-4" action="{{ route('user.create') }}" method="post">

        <div>
            <h1 class="text-xl font-semibold">Form Pengguna</h1>
            <p class="text-sm text-gray-400 mt-1">Buat akun pengguna baru untuk aplikasi</p>
        </div>

        @csrf

        @if ($errors->any())
            <div class="mb-5">
                @foreach ($errors->all() as $error)
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="name@flowbite.com" type="email" required />
            @error('email')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('email') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
            <input type="name" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Sang Pengguna" type="text" required />
            @error('name')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
            <input type="password" id="password" name="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="*********" type="password" required />
            @error('password')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('password') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="*********" required />
            @error('password_confirmation')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                </div>
            @enderror
        </div>

        <button type="submit"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Submit
        </button>

    </form>
@endsection
