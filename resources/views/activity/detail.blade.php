@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-semibold">List Absensi Peserta</h1>
            <p class="text-sm text-gray-400 mt-1">List absensi perserta</p>
        </div>

    </div>

    {{-- show tables of attendances --}}


    <div class="relative overflow-x-auto my-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bukti
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->attendances as $attendance)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ $attendance->user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $attendance->status }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($attendance->image)
                                <img src="{{ $attendance->image[0] }}" alt="image" class="w-16 h-16 rounded-sm object-cover" />
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
