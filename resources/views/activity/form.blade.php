@extends('layouts.app')

@section('content')
    <form class="flex flex-col space-y-4" action="{{ route('user.create') }}" method="post" >
        <div>
            <h1 class="text-xl font-semibold">Form Kegiatan</h1>
            <p class="text-sm text-gray-400 mt-1">Buat kegiatan baru</p>
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
        
    </form>
@endsection

@push('scripts')
@endpush
