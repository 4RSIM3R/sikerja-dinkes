@extends('layouts.guest')

@section('content')
    <div class="h-screen mx-auto w-full max-w-sm lg:w-96 p-4 flex flex-col justify-center">
        <div class="flex flex-col justify-center items-center">
            <img class="h-24 w-24" src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Lambang_Kabupaten_Sumedang.png"
                alt="Your Company">
            <h2 class="mt-8 text-xl font-bold leading-9 tracking-tight text-gray-900 text-center">
                SIKERJA DINKES SUMEDANG
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-500 text-center">
                deskripsi disini
            </p>
        </div>

        <div class="mt-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" autocomplete="off" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        @error('email')
                            <p class="mt-1 text-xs italic text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" autocomplete="off" name="password" type="password"
                            autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                        @error('password')
                            <p class="mt-1 text-xs italic text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                        Signin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
