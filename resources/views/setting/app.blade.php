@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-xl font-semibold">Setting Backoffice</h1>
        <p class="text-sm text-gray-400 mt-1">Setting backoffice (web) </p>
    </div>

    <form class="flex flex-col space-y-4" action="{{ route('setting.app') }}" method="post">
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
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
            <input type="title" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Judul Website" type="text" value="{{ isset($setting) ? $setting->title : '' }}" required />
            @error('title')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('title') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea id="content" name="content"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Konten Website" type="text"  required>{{ isset($setting) ? $setting->content : '' }}</textarea>
            @error('content')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('content') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="banner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner</label>
            <input name="banner" id="banner" accept=".jpg, .jpeg, .png"
                class="block w-full text-sm text-gray-900 border border-green-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none"
                aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500" id="file_input_help">png, jpg, jpeg Max 1MB</p>
        </div>

        <button type="submit"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Submit
        </button>

    </form>
@endsection

@push('scripts')
@endpush
