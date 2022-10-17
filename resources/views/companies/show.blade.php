@extends('layouts.app')

@section('title', trans('Detail of Companies'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Companies') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of company.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('companies.index') }}">{{ __('Companies') }}</a>
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
                                        <td>{{ isset($company->code) ? $company->code : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Name') }}</td>
                                        <td>{{ isset($company->name) ? $company->name : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Phone') }}</td>
                                        <td>{{ isset($company->phone) ? $company->phone : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Address') }}</td>
                                        <td>{{ isset($company->address) ? $company->address : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Statu') }}</td>
                                        <td>{{ $company->statu == 1 ? 'True' : 'False' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $company->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $company->updated_at->format('d/m/Y H:i') }}</td>
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
