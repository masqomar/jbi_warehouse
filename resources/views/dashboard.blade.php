@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4>Hi 👋, {{ auth()->user()->name }}</h4>
                    <p>{{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Entitas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $companyCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Persediaan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $productCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="fa fa-database" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Inventaris</h6>
                                        <h6 class="font-extrabold mb-0">{{ $assetItemCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pengguna</h6>
                                        <h6 class="font-extrabold mb-0">{{ $userCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>PO Time</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Stock</th>
                                                <th>Entitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $poTimes as $poTime )
                                            @if ( $poTime->quantity < $poTime->danger_level)
                                                <tr>
                                                    <td class="col-3">
                                                        <p class="font-bold mb-0">{{ $poTime->full_code }}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0"> {{ $poTime->name }}</p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class="font-bold mb-0" style="background-color:red">
                                                            <font color="#FFFFFF"> {{ $poTime->quantity }}</font>
                                                        </p>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0"> {{ $poTime->company->name }}</p>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Transactions</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Date</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $latestTransactions as $latestTransaction )
                                            <tr>
                                                <td class="col-3">
                                                    <p class="font-bold mb-0">{{ $latestTransaction->transaction_code }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"> {{ $latestTransaction->date }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">@rupiah ( $latestTransaction->total_price )</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Coming Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $latestComingProducts as $latestComingProduct )
                                            <tr>
                                                <td class="col-3">
                                                    <p class="font-bold mb-0">{{ $latestComingProduct->code }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"> {{ $latestComingProduct->date }}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">@rupiah ( $latestComingProduct->price )</p>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Person In Charge (PIC)</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="picTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Asset</th>
                                                <th class="text-center">Code</th>
                                                <th class="text-center">Specification</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Condition</th>
                                                <th class="text-center">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($picAssets as $key => $item)
                                            <tr>
                                                <td class="text-center">{{$key+1}}</td>
                                                <td class="text-center">{{ $item->asset_item ? $item->asset_item->asset->name : '-' }}</td>
                                                <td class="text-center">{{ $item ? $item->asset_item_id : '-' }}</td>
                                                <td class="text-center">{{ $item->asset_item ? $item->asset_item->asset->specification : '-' }}</td>
                                                <td class="text-center">{{ $item->placement ? $item->placement->type : '-' }}</td>
                                                <td class="text-center">{{ $item->placement ? $item->placement->condition : '-' }}</td>
                                                <td class="text-center">{{ $item->placement ? $item->placement->description : '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    $(document).ready(function() {
        $('#picTable').DataTable();
    });
</script>
@endpush