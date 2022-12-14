@extends('layouts.app')

@section('title', trans('Detail of Assets'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Assets') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail of asset.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('assets.index') }}">{{ __('Assets') }}</a>
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
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ isset($asset->name) ? $asset->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Unit') }}</td>
                                    <td>{{ $asset->unit ? $asset->unit->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Specification') }}</td>
                                    <td>{{ isset($asset->specification) ? $asset->specification : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Stock') }}</td>
                                    <td>{{ isset($asset->stock) ? $asset->stock : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Description') }}</td>
                                    <td>{{ isset($asset->description) ? $asset->description : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Category') }}</td>
                                    <td>{{ $asset->category ? $asset->category->code : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Company') }}</td>
                                    <td>{{ $asset->company ? $asset->company->code : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $asset->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $asset->updated_at->format('d/m/Y H:i') }}</td>
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
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Condition</th>
                                        <th class="text-center">Note</th>
                                        <th class="text-center">Current Location</th>
                                        <th class="text-center">PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assetItems as $key => $assetItem)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{ $assetItem->full_code }}</td>
                                        @if ($assetItem->status === 'Tersedia')
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        @endif
                                        @if ($assetItem->status === 'Diservis')
                                        <td class="text-center">{{ $assetItem->status }}</td>
                                        <td class="text-center">Rusak</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        @endif
                                        @if ($assetItem->status === 'Dipinjam')
                                        <td class="text-center">{{ $assetItem->status }}</td>
                                        <td class="text-center">Rusak</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        @endif
                                        @foreach ($assetItem->placement_item as $placementItem)
                                        @if ($placementItem->status === 'Yes')
                                        <td class="text-center">{{ $placementItem->placement->type }}</td>
                                        <td class="text-center">{{ $placementItem->placement->condition }}</td>
                                        <td class="text-center">{{ $placementItem->placement->description }}</td>
                                        <td class="text-center">{{ $placementItem->placement->room->name }}</td>
                                        <td class="text-center">{{ $placementItem->staff->name }}</td>
                                        @endif
                                        @endforeach
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