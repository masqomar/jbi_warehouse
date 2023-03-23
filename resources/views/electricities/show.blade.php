@extends('layouts.app')

@section('title', trans('Detail of Electricities'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Electricities') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of electricity.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('electricities.index') }}">{{ __('Electricities') }}</a>
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
                                        <td class="fw-bold">{{ __('Meter Number') }}</td>
                                        <td>{{ isset($electricity->meter_number) ? $electricity->meter_number : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Building') }}</td>
                                        <td>{{ $electricity->building ? $electricity->building->name : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Amount') }}</td>
                                        <td>{{ isset($electricity->amount) ? $electricity->amount : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Note') }}</td>
                                        <td>{{ isset($electricity->note) ? $electricity->note : '-' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Extra Note') }}</td>
                                        <td>{{ isset($electricity->extra_note) ? $electricity->extra_note : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $electricity->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $electricity->updated_at->format('d/m/Y H:i') }}</td>
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
