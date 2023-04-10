@extends('layouts.app')

@section('title', trans('Inventory Report'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Inventory Report') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Below is a list of all I\inventory report.') }}
                </p>
            </div>
            <x-breadcrumb>
                <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Inventory Report') }}</li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <x-alert></x-alert>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nama Barang') }}</th>
                                        <th>{{ __('Satuan') }}</th>
                                        <th>{{ __('Kategori') }}</th>
                                        <th>{{ __('Harga Beli') }}</th>
                                        <th>{{ __('Masuk') }}</th>
                                        <th>{{ __('Keluar') }}</th>
                                        <th>{{ __('Saldo Akhir') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Biaya Barcet') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('reports.index') }}",
        dom: 'Blfrtip',
        buttons: [{
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] // Column index which needs to export
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] // Column index which needs to export
                }
            },
            {
                extend: 'excel',
            }
        ],
        columns: [{
                data: 'name',
                name: 'name',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'unit',
                name: 'unit.name'
            },
            {
                data: 'category',
                name: 'category.name'
            },
            {
                data: 'harga_beli',
                name: 'harga_beli',
            },
            {
                data: 'masuk',
                name: 'masuk',
            },
            {
                data: 'keluar',
                name: 'keluar',
            },
            {
                data: 'saldo_akhir',
                name: 'saldo_akhir',
            },
            {
                data: 'total',
                name: 'total',
            },
            {
                data: 'biaya_barcet',
                name: 'biaya_barcet',
            },
        ],

    });
</script>
@endpush