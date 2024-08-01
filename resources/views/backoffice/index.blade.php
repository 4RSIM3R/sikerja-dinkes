@extends('layouts.app')

@section('content')
    <div class="h-screen w-full bg-white">
        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    {{ $user }}
                </h3>
                <p class="mt-5" >Jumlah Pengguna</p>
            </div>
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    {{ $activity }}
                </h3>
                <p class="mt-5" >Jumlah Aktifitas</p>
            </div>
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    {{ $assignment }}
                </h3>
                <p class="mt-5" >Jumlah Surat Tugas</p>
            </div>
        </div>
    </div>
@endsection
