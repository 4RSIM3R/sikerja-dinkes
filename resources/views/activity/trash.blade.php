@extends('layouts.app')

@section('content')
    <div class="h-screen w-full bg-white">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold">Kegiatan</h1>
                <p class="text-sm text-gray-400 mt-1">List kegiatan</p>
            </div>

            <a href="{{ route('activity.index') }}"
                class="flex items-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 focus:z-10">
                <box-icon class="h-4 w-4 mr-2" name='plus'></box-icon>
                Kembali ke kegiatan
            </a>
        </div>

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

        <div class="mt-4" id="grid"></div>
    </div>
@endsection

@push('scripts')
    <script>
        function weekCount(dateString) {
            const date = new Date(dateString);
            const oneJan = new Date(date.getUTCFullYear(), 0, 1);
            const numberOfDays = Math.floor((date - oneJan) / (24 * 60 * 60 * 1000));
            const weekNumber = Math.ceil((numberOfDays + oneJan.getUTCDay() + 1) / 7);
            return `Minggu ke-${weekNumber}`;
        }

        function dateFormat(dateString) {
            const date = new Date(dateString);
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];  

            // Get the day name
            const dayName = days[date.getUTCDay()];

            // Get the date, month, and year
            const day = date.getUTCDate();
            const month = months[date.getUTCMonth()];
            const year = date.getUTCFullYear();

            // Format the result
            return `${day} ${month} ${year}`;
        }

        new gridjs.Grid({
            columns: [
                'ID',
                'Pelaksanaan Tugas',
                'Rencana Hasil Kerja',
                {
                    name: 'Periode Pelaporan',
                    formatter: (cell, row) => gridjs.html(`
                        ${weekCount(row.cell(3).data)} <br />
                        ${dateFormat(row.cell(3).data)} - 
                        ${dateFormat(row.cell(4).data)}
                    `),
                },
                {
                    name: 'Actions',
                    formatter: (cell, row) => gridjs.html(`
                    <div class="flex gap-2">
                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 border border-gray-400"
                            href="/backoffice/activity/${row.cell(0).data}/report">
                            <box-icon class="h-4 w-4" name='down-arrow-circle'></box-icon>
                        </a>
                      <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-red-500 hover:bg-red-500/5 delete-btn border border-red-500"
                            data-id="${row.cell(0).data}" href="javascript:void(0)">
                            <i class='bx bx-trash' class="h-4 w-4"></i>
                        </a>
                    </div>
                `),
                },
            ],
            server: {
                url: '{{ route('activity.deletedData') }}',
                then: response => {
                    console.log(response.data.data);
                    return response.data.data.map(data => [
                        data.id,
                        data.execution_task,
                        data.result_plan,
                        data.report_period_start,
                        data.deleted_at
                    ]);
                },
                total: data => 10
            },
            pagination: {
                enabled: true,
                limit: 10,
                summary: true,
                url: (prev, page, limit) => `?page=${page}&perPage=${limit}`
            },
            search: {
                enabled: true,
                highlightMatches: true,
                server: {
                    url: (prev, keyword) => `${prev}?search=${keyword}`
                }
            },
            className: {
                table: 'w-full caption-bottom text-sm',
                thead: '[&_tr]:border-b',
                tbody: '[&_tr:last-child]:border-0',
                tr: 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted',
                th: 'h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0',
                td: 'p-4 align-middle [&:has([role=checkbox])]:pr-0',
                pagination: 'text-sm',
                input: 'text-sm'
            },
        }).render(document.getElementById('grid'));

        //event listener for delete buttons 
        document.addEventListener('click', function(event) {
            if (event.target.closest('.delete-btn')) {
                const button = event.target.closest('.delete-btn');
                const id = button.getAttribute('data-id');
                if (confirm('yakin hapus data?')) {
                    deleteActivity(id);
                }
            }
        });

        function deleteActivity(id) {
            const url = `{{ route('activity.destroy', ':id') }}`.replace(':id', id);

            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })

                .then(response => response.json())

                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload()
                    } else {
                        alert('gagal menghapus data!')
                    }
                })

                .catch(error => console.error('Error:', error));
        }
    </script>
@endpush
