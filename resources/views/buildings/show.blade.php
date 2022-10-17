@extends('layouts.app')

@section('title', trans('Detail of Buildings'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Buildings') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of building.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('buildings.index') }}">{{ __('Buildings') }}</a>
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
                                        <td>{{ isset($building->name) ? $building->name : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Phone') }}</td>
                                        <td>{{ isset($building->phone) ? $building->phone : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Address') }}</td>
                                        <td>{{ isset($building->address) ? $building->address : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Owner') }}</td>
                                        <td>{{ isset($building->owner) ? $building->owner : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Status') }}</td>
                                        <td>{{ $building->status == 1 ? 'True' : 'False' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Company') }}</td>
                                        <td>{{ $building->company ? $building->company->code : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $building->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $building->updated_at->format('d/m/Y H:i') }}</td>
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
