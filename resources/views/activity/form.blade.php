@extends('layouts.app')

@section('content')
    <form class="flex flex-col space-y-4" action="{{ route('user.create') }}" method="post">
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

        <div class="mb-5">
            <label for="assignment_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
            <select name="assignment_id" id="assignment_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md block w-full p-3">

            </select>
            @error('title')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('title') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nama Kegiatan
            </label>
            <input type="text" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Nama Kegiatan" type="text" required />
            @error('description')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('description') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Deskripsi Kegiatan
            </label>
            <textarea id="description" name="description"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('description')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('description') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Lokasi Kegiatan
            </label>
            <textarea id="location" name="location"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('location')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('location') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Tanggal Mulai" type="text" required />
            @error('start_date')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('start_date') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Selesai</label>
            <input type="date" id="end_date" name="end_date"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Tanggal Selesai" type="text" required />
            @error('date')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('end_date') }}
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#assignment_id').select2({
                minimumInputLength: 2,
                placeholder: 'Pilih Surat Tugas',
                ajax: {
                    url: '{{ route('assignment.grid') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function(response, params) {
                        console.log(response.data.data);
                        return {
                            results: response.data.data.map(res => {
                                return {
                                    text: `${res.number} - ${res.title}`,
                                    id: res.id
                                }
                            })
                        }
                    },
                    cache: true
                }
            })
        })
    </script>
@endpush
