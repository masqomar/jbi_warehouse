@extends('layouts.app')

@section('title', trans('Members'))

@section('content')
<form action="{{ route('mutation-assets.store') }}" method="POST">
    @csrf
    @method('POST')

    <div class="col-md-6">
        <div class="form-group">
            <label for="toolkit">{{ __('Toolkit') }}</label>
            <select class="form-select" class="form-control" name="asset_item_id" id="asset_item_id">
                <option value="">Select Program</option>
                @if(count($IDs) > 0)
                @foreach ($IDs as $id)
                <option value="{{$id->id}}">{{$id->asset->name}} || {{$id->full_code}}</option>
                @endforeach
                @endif

            </select>
            <br />

            <table>
                <thead>

                </thead>
                <tbody id="tbody"></tbody>

            </table>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
</form>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#asset_item_id").on('change', function() {
            var asset_item_id = $(this).val();
            $.ajax({
                url: "{{ route('mutation-assets.create') }}",
                type: "GET",
                data: {
                    'asset_item_id': asset_item_id
                },
                success: function(data) {
                    console.log(data);

                    var html = '';
                    $.each(data, function(i, placement) {
                        html += '<tr>\
                                <td width="10%"><input type="text" readonly class="form-control" name="placement_id" value="' + placement.id + '"></td>\
                                <td width="10%"><input type="text" readonly class="form-control" name="placement_id" value="' + placement.type + '"></td>\
                                </tr>\
                                ';
                    })
                    $("#tbody").html(html);
                }
            })
        });
    });
</script>

@endpush