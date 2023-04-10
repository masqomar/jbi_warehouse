@extends('layouts.app')

@section('title', __('Detail of products'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('products') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail of product.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}">{{ __('products') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('Detail') }}
                </li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <td class="fw-bold">{{ __('Code') }}</td>
                                    <td>{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Current Stock') }}</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Danger Level') }}</td>
                                    <td>{{ $product->danger_level }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Unit') }}</td>
                                    <td>{{ $product->unit ? $product->unit->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Category') }}</td>
                                    <td>{{ $product->category ? $product->category->code : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Image') }}</td>
                                    <td>
                                        @if ($product->image == null)
                                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Image" class="rounded" width="200" height="150" style="object-fit: cover">
                                        @else
                                        <img src="{{$product->getFirstMediaUrl('product_image', 'thumb')}}" width="45px" height="45px" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Team') }}</td>
                                    <td>{{ $product->company ? $product->company->name : '' }}</td>
                                </tr>
                            </table>
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover table-bordered table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fifoStocks as $key => $fifoStock)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{ $fifoStock->product->name }}</td>
                                        <td class="text-center">{{ $fifoStock->quantity }}</td>
                                        <td class="text-center">@rupiah ($fifoStock->price)</td>
                                        <td class="text-center">@rupiah ($fifoStock->quantity * $fifoStock->price)</td>
                                        <td class="text-center">{{ $fifoStock->date->format('d-m-Y') }}</td>
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