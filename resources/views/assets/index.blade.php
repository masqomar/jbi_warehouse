@extends('layouts.app')

@section('title', trans('Assets'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Assets') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Below is a list of all assets.') }}
                </p>
            </div>
            <x-breadcrumb>
                <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Assets') }}</li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <x-alert></x-alert>

        @can('create asset')
        <div class="d-flex justify-content-end">
            <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                {{ __('Create a new asset') }}
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
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Unit') }}</th>
                                        <th>{{ __('Specification') }}</th>
                                        <th>{{ __('Stock') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Company') }}</th>
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
        ajax: "{{ route('assets.index') }}",
        columns: [{
                data: 'asset_image',
                name: 'asset_image',
                render: function(data, type, full, meta) {
                    return data ? "<img src=\"" + data + "\" height=\"50\"/>" : '-';
                }
            },
            {
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
                data: 'specification',
                name: 'specification',
                render: function(data, type, full, meta) {
                    return data ? data : '-';
                }
            },
            {
                data: 'stock',
                name: 'stock',
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
                data: 'category',
                name: 'category.code'
            },
            {
                data: 'company',
                name: 'company.code'
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