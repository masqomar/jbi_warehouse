@extends('layouts.app')

@section('title', trans('Detail of Members'))

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-8 order-md-1 order-last">
                <h3>{{ __('Members') }}</h3>
                <p class="text-subtitle text-muted">
                    {{ __('Detail of member.') }}
                </p>
            </div>

            <x-breadcrumb>
                <li class="breadcrumb-item">
                    <a href="/">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('members.index') }}">{{ __('Members') }}</a>
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
                                    <td class="fw-bold">{{ __('Reg Number') }}</td>
                                    <td>{{ isset($member->reg_number) ? $member->reg_number : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Name') }}</td>
                                    <td>{{ isset($member->name) ? $member->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Gender') }}</td>
                                    <td>{{ isset($member->gender) ? $member->gender : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Phone') }}</td>
                                    <td>{{ isset($member->phone) ? $member->phone : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Address') }}</td>
                                    <td>{{ isset($member->address) ? $member->address : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Period') }}</td>
                                    <td>{{ isset($member->period) ? $member->period->format('d/m/Y') : '-'  }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Program') }}</td>
                                    <td>{{ isset($member->program) ? $member->program : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Education') }}</td>
                                    <td>{{ isset($member->education) ? $member->education : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Tshirt') }}</td>
                                    <td>{{ isset($member->tshirt) ? $member->tshirt : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('User') }}</td>
                                    <td>{{ $member->user ? $member->user->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Company') }}</td>
                                    <td>{{ $member->company ? $member->company->code : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Created at') }}</td>
                                    <td>{{ $member->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">{{ __('Updated at') }}</td>
                                    <td>{{ $member->updated_at->format('d/m/Y H:i') }}</td>
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
                                        <th class="text-center">Toolkit</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Taken Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($toolkitItems as $key => $item)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ $item->toolkit->taken_date }}</td>
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