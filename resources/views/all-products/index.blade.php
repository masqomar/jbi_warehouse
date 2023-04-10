@extends('layouts.app')

@section('title', trans('Products'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Products') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Below is a list of all products.') }}
                </p>
            </div>
            <x-breadcrumb>
                <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <x-alert></x-alert>

        @can('create category')
        <div class="d-flex justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i>
                {{ __('Create a new products') }}
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
                                        <th class="text-center">{{ __('No') }}</th>
                                        <th class="text-center">{{ __('Barcode') }}</th>
                                        <th class="text-center">{{ __('QR Code') }}</th>
                                        <th class="text-center">{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('Price') }}</th>
                                        <th class="text-center">{{ __('Quantity') }}</th>
                                        <th class="text-center">{{ __('Category') }}</th>
                                        <th class="text-center">{{ __('User') }}</th>
                                        <th class="text-center">{{ __('Image') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr data-entry-id="{{ $product->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->full_code, 'C39',1,33,array(1,1,1), true) }}" alt="{{$product->full_code}}" width="100" height="40">
                                        </td>
                                        <td class="text-center">
                                            {{QrCode::generate($product->full_code);}}
                                            <br><span class="badge bg-info"> {{$product->full_code}}</span>
                                        </td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">@rupiah ( $product->price )</td>
                                        <td class="text-center">{{ $product->quantity }} {{ $product->unit->name }}</td>
                                        <td class="text-center">{{ $product->category->name }}</td>
                                        <td class="text-center">{{ $product->user->name }}</td>


                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                                    </tr>
                                    @endforelse
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