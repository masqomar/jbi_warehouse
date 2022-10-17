<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="mutation_code">{{ __('Mutation Code') }}</label>
            <input type="text" name="mutation_code" id="mutation_code" class="form-control @error('mutation_code') is-invalid @enderror" value="{{ isset($mutation) ? $mutation->mutation_code : old('mutation_code') }}" placeholder="{{ __('Mutation Code') }}" required />
            @error('mutation_code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ isset($mutation) && $mutation->date ? $mutation->date->format('Y-m-d') : old('date') }}" placeholder="{{ __('Date') }}" required />
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="condition">{{ __('Condition') }}</label>
            <input type="text" name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror" value="{{ isset($mutation) ? $mutation->condition : old('condition') }}" placeholder="{{ __('Condition') }}" required />
            @error('condition')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}">{{ isset($mutation) ? $mutation->description : old('description') }}</textarea>
            @error('description')
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
    <div class="col-md-12">
        <div class="form-group">
            <label for="status">{{ __('Asset') }}</label>
            <select class="choices form-select" multiple="multiple" name="asset_id[]" id="asset_id">

                @foreach($placementAssets as $placementAsset)
                <option value="{{ $placementAsset->id }}">{{ $placementAsset->id }} || {{ $placementAsset->full_code }}</option>
                @endforeach

            </select>
        </div>
    </div>
</div>




@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/styles/css/choices.css" integrity="sha512-0bYNWBaGnMqLCuum81OA7oZo7/pIEjWb/ad3vdKuKlgTZXalLMDkRT3P4Z262/aQBnNuznUg3WpTb5Vgu11abw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js" integrity="sha512-7PQ3MLNFhvDn/IQy12+1+jKcc1A/Yx4KuL62Bn6+ztkiitRVW1T/7ikAh675pOs3I+8hyXuRknDpTteeptw4Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('mazer') }}/js/extensions/form-element-select.js"></script>
@endpush