@extends('layouts.app')

@section('title', trans('Detail of AssetMaintenances'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('AssetMaintenances') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of assetmaintenance.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('asset-maintenances.index') }}">{{ __('AssetMaintenances') }}</a>
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
                                        <td class="fw-bold">{{ __('Code') }}</td>
                                        <td>{{ isset($assetMaintenance->code) ? $assetMaintenance->code : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('AssetItem') }}</td>
                                        <td>{{ $assetMaintenance->asset_item ? $assetMaintenance->asset_item->code : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Initial Date') }}</td>
                                        <td>{{ isset($assetMaintenance->initial_date) ? $assetMaintenance->initial_date->format('d/m/Y') : '-'  }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Finish Date') }}</td>
                                        <td>{{ isset($assetMaintenance->finish_date) ? $assetMaintenance->finish_date->format('d/m/Y') : '-'  }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Finish Note') }}</td>
                                        <td>{{ isset($assetMaintenance->finish_note) ? $assetMaintenance->finish_note : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Description') }}</td>
                                        <td>{{ isset($assetMaintenance->description) ? $assetMaintenance->description : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Status') }}</td>
                                        <td>{{ isset($assetMaintenance->status) ? $assetMaintenance->status : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $assetMaintenance->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $assetMaintenance->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
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
