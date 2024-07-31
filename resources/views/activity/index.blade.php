@extends('layouts.app')

@section('content')
    <div class="h-screen w-full bg-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold">Kegiatan</h1>
                <p class="text-sm text-gray-400 mt-1">List kegiatan</p>
            </div>

            <a href="{{ route('user.create') }}"
                class="flex items-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10">
                <box-icon class="h-4 w-4 mr-2" name='plus'></box-icon>
                Tambah Kegiatan
            </a>

        </div>

        <div class="mt-4" id="grid"></div>
    </div>
@endsection

@push('scripts')
    
@endpush
