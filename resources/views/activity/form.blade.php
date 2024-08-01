@extends('layouts.app')

@section('content')
    <form class="flex flex-col space-y-4" action="{{ route('activity.store') }}" method="post">
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
            @error('assignment_id')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('assignment_id') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="user_id[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Peserta</label>
            <select name="user_id[]" id="user_id" multiple="multiple" class="js-example-basic-multiple w-full p-0">

            </select>
            @error('user_id')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('user_id') }}
                    </div>
                </div>
            @enderror
            @error('user_id.*')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('user_id.*') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="report_period">
            <label for="report_period" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Periode Pelaporan
            </label>
            <input type="date" id="report_period" name="report_period"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Tanggal Mulai" type="text" required />
            @error('report_period')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('report_period') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="execution_task">
            <label for="execution_task" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Pelaksanaan Tugas
            </label>
            <textarea id="execution_task" name="execution_task"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('execution_task')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('execution_task') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="result_plan">
            <label for="result_plan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Rencana Hasil Kerja
            </label>
            <textarea id="result_plan" name="result_plan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('result_plan')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('result_plan') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="result_plan">
            <label for="action_plan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Rencana Aksi
            </label>
            <textarea id="action_plan" name="action_plan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('action_plan')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('action_plan') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="output">
            <label for="output" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Output
            </label>
            <textarea id="output" name="output"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('output')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('output') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="budget">
            <label for="budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Jumlah Budget
            </label>
            <input type="number" id="budget" name="budget"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Jumlah Budget" type="text" required />
            @error('budget')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('budget') }}
                    </div>
                </div>
            @enderror
        </div>

        <div class="mb-5" id="budget_source">
            <label for="budget_source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Sumber Budget
            </label>
            <textarea id="budget_source" name="budget_source"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Deskripsi Kegiatan" type="text" required></textarea>
            @error('budget_source')
                <div class="mt-2">
                    <div class="text-sm text-red-600">
                        {{ $errors->first('budget_source') }}
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

        $(document).ready(function() {
            $('#user_id').select2({
                minimumInputLength: 2,
                placeholder: 'Pilih Peserta',
                ajax: {
                    url: '{{ route('user.grid') }}',
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
                                    text: res.name,
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
