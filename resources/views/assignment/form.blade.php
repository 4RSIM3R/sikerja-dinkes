@extends('layouts.app')

@section('content')
    <form class="flex flex-col space-y-4" action="{{ route('assignment.store') }}" method="post"
        enctype="multipart/form-data">
        <div>
            <h1 class="text-xl font-semibold">Form Surat Tugas</h1>
            <p class="text-sm text-gray-400 mt-1">Buat surat tugas baru</p>
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
            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Surat
                Tugas</label>
            <input type="text" id="number" name="number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Nomor Surat Tugas" type="text" required />
            @error('number')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Surat
                Tugas</label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Nama Surat Tugas" type="text" required />
            @error('number')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('title') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Surat
                Tugas</label>
            <textarea id="description" name="description"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Surat Tugas" type="text" required></textarea>
            @error('description')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('description') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
            <input type="date" id="date" name="date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Tanggal Surat" type="text" required />
            @error('date')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('date') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="attachment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="file_input">Surat Tugas</label>
            <input name="attachment" id="attachment" accept="application/pdf"
                class="block w-full text-sm text-gray-900 border border-green-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none"
                aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500" id="file_input_help">PDF Max 5MB.</p>
        </div>



        <button type="submit"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Submit
        </button>
    </form>
@endsection

@push('scripts')
@endpush
