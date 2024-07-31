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
<script>
    new gridjs.Grid({
        columns: [
            'Surat Tugas',
            'Judul',
            'Tanggal',
            'Jumlah Peserta',
            {
                name: 'Actions',
                formatter: (cell, row) => gridjs.html(`
                    <div class="flex gap-2">
                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 border border-gray-400"
                            href="/backoffice/master/student/${row.cell(0).data}/edit">
                            <box-icon class="h-4 w-4" name='detail'></box-icon>
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
            url: '{{ route('assignment.grid') }}',
            then: response => {
                return response.data.data.map(user => [user.id, user.name, user.email, user.roles, null]);
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
</script>
@endpush
