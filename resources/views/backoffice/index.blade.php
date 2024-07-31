@extends('layouts.app')

@section('content')
    <div class="h-screen w-full bg-white">
        <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    20
                </h3>
                <p class="mt-5" >Jumlah Pengguna</p>
            </div>
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    11
                </h3>
                <p class="mt-5" >Jumlah Aktifitas</p>
            </div>
            <div class="col-span-1 bg-white rounded-lg shadow-md px-4 py-5 sm:px-6">
                <h3 class="text-3xl leading-6 font-semibold text-gray-900">
                    17
                </h3>
                <p class="mt-5" >Jumlah Reimbursement</p>
            </div>
        </div>
    </div>
@endsection
