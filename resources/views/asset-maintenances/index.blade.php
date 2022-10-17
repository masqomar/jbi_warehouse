@extends('layouts.app')

@section('title', trans('AssetMaintenances'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('AssetMaintenances') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Below is a list of all assetmaintenances.') }}
                </p>
            </div>
            <x-breadcrumb>
                <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('AssetMaintenances') }}</li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <x-alert></x-alert>

        @can('create assetmaintenance')
        <div class="d-flex justify-content-end">
            <a href="{{ route('asset-maintenances.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                {{ __('Create a new assetmaintenance') }}
            </a>
        </div>
        @endcan

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-striped" id="data-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('AssetItem') }}</th>
                                        <th>{{ __('Initial Date') }}</th>
                                        <th>{{ __('Finish Date') }}</th>
                                        <th>{{ __('Finish Note') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
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
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
<script>
    $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('asset-maintenances.index') }}",
        columns: [{
                data: 'code',
                name: 'code',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'asset_item',
                name: 'asset_item.code'
            },
            {
                data: 'initial_date',
                name: 'initial_date',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'finish_date',
                name: 'finish_date',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'finish_note',
                name: 'finish_note',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'description',
                name: 'description',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });
</script>
@endpush