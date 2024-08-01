@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-semibold">List Absensi Peserta</h1>
            <p class="text-sm text-gray-400 mt-1">List absensi perserta</p>
        </div>

        <a href="{{ route('activity.create') }}"
            class="flex items-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10">
            <box-icon class="h-4 w-4 mr-2" name='plus'></box-icon>
            Cetak Report
        </a>

    </div>

    <div>
        <div>
            <h1 class="text-xl font-semibold">Reimburse Peserta</h1>
            <p class="text-sm text-gray-400 mt-1">List reimburse peserta</p>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
