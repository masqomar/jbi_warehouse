@extends('layouts.app')

@section('title', trans('Detail of Placements'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Placements') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail of placement.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('placements.index') }}">{{ __('Placements') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('Detail') }}
                </li>
            </x-breadcrumb>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <td class="fw-bold">{{ __('Placement Code') }}</td>
                                    <td>{{ isset($placement->placement_code) ? $placement->placement_code : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Date') }}</td>
                                    <td>{{ isset($placement->date) ? $placement->date->format('d/m/Y') : '-'  }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Room') }}</td>
                                    <td>{{ $placement->room ? $placement->room->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Description') }}</td>
                                    <td>{{ isset($placement->description) ? $placement->description : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Type') }}</td>
                                    <td>{{ isset($placement->type) ? $placement->type : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('User') }}</td>
                                    <td>{{ $placement->user ? $placement->user->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Company') }}</td>
                                    <td>{{ $placement->company ? $placement->company->code : '' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Asset</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($placementItems as $key => $item)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{ $placement->room->name}}</td>
                                        <td class="text-center">{{ $item->asset_item->full_code}}</td>
                                        <td class="text-center">{{ $item->status}}</td>
                                        <td class="text-center">{{ $item->staff->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
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