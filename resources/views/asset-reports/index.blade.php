@extends('layouts.app')

@section('title', trans('Asset Report'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Programs') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Below is a list of all programs.') }}
                </p>
            </div>
            <x-breadcrumb>
                <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Programs') }}</li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <x-alert></x-alert>

        @can('create program')
        <div class="d-flex justify-content-end">
            <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                {{ __('Create a new program') }}
            </a>
        </div>
        @endcan

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover table-bordered table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('No.') }}</th>
                                        <th class="text-center">{{ __('Nama Inventaris') }}</th>
                                        <th class="text-center">{{ __('Kode') }}</th>
                                        <th class="text-center">{{ __('Kategori') }}</th>
                                        <th class="text-center">{{ __('Status') }}</th>
                                        <th class="text-center">{{ __('PIC') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($assetItems as $key => $assetItem)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{ $assetItem->asset->name }}</td>
                                        <td>{{ $assetItem->full_code }}</td>
                                        <td>{{ $assetItem->category->name }}</td>
                                        <td>{{ $assetItem->status }}</td>
                                        <td>
                                            @foreach($assetItem->placement_item as $product)
                                            @if ($product->status == 'Yes')
                                            <li> {{ $product->staff->name }} </li>
                                            @endif
                                            @endforeach
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
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
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endpush