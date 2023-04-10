@extends('layouts.app')

@section('title', trans('Detail Transaction'))

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div>
                <p style="float: left;">{{ __('List Transaction') }}</p>
                <p style="float: right">
                    <a href="{{ route('transactions.index') }}" class="btn btn-dark float-right">
                        <span class="text">{{ __('Go Back') }}</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="card-body">
            <div class="card-responsive">
                <table class="table mt-3 table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Purpose</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaction->transaction_details as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $transaction->purpose ? $transaction->purpose : '-' }}</td>
                            <td>{{ $transaction->description ? $transaction->description : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Order item not found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right">

            <button class="btn btn-success" onclick="notaKecil('{{ route('transactions.print_struck', $transaction->id) }}', 'print_struck')">Print Nota</button>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    // tambahkan untuk delete cookie innerHeight terlebih dahulu
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    function notaKecil(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title,
            `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
@endpush