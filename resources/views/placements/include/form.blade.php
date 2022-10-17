<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="placement_code">{{ __('placement_code') }}</label>
            <input type="text" name="placement_code" id="placement_code" class="form-control @error('placement_code') is-invalid @enderror" value="{{ $placementCode }}" placeholder="{{ __('Placement Code') }}" readonly />
            @error('placement_code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ isset($placement) && $placement->date ? $placement->date->format('Y-m-d') : old('date') }}" placeholder="{{ __('Date') }}" required />
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="room_id">{{ __('Room') }}</label>
            <select class="form-select" name="room_id" id="room_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select room') }} --</option>

                @foreach ($room as $ruang)
                <option value="{{ $ruang->id }}">
                    {{ $ruang->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="staff_id">{{ __('PIC') }}</label>
            <select class="form-select" name="staff_id" id="staff_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select PIC') }} --</option>

                @foreach ($pics as $pic)
                <option value="{{ $pic->id }}">
                    {{ $pic->name }} || {{ $pic->devision->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($placement) ? $placement->description : old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="status">{{ __('Asset') }}</label>
            <select class="choices form-select" multiple="multiple" name="asset_id[]" id="asset_id">

                @foreach($assetItems as $item)
                <option value="{!! $item['full_code'] !!}">{{ $item->asset->name}} || {{ $item->full_code }}</option>
                @endforeach

            </select>
        </div>
    </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/form-element-select.css">
@endpush

@push('js')
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
@endpush