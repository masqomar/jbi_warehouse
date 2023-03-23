<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="meter_number">{{ __('Meter Number') }}</label>
            <input type="text" name="meter_number" id="meter_number" class="form-control @error('meter_number') is-invalid @enderror" value="{{ isset($electricity) ? $electricity->meter_number : old('meter_number') }}" placeholder="{{ __('Meter Number') }}" required />
            @error('meter_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="building_id">{{ __('Building') }}</label>
            <select class="form-select" name="building_id" id="building_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select building') }} --</option>

                @foreach ($gedung as $building)
                <option value="{{ $building->id }}" {{ isset($electricity) && $electricity->building_id == $building->id ? 'selected' : (old('building_id') == $building->id ? 'selected' : '') }}>
                    {{ $building->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="amount">{{ __('Amount') }}</label>
            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ isset($electricity) ? $electricity->amount : old('amount') }}" placeholder="{{ __('Amount') }}" required />
            @error('amount')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="note">{{ __('Note') }}</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="{{ __('Note') }}">{{ isset($electricity) ? $electricity->note : old('note') }}</textarea>
            @error('note')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="extra_note">{{ __('Extra Note') }}</label>
            <textarea name="extra_note" id="extra_note" class="form-control @error('extra_note') is-invalid @enderror" placeholder="{{ __('Extra Note') }}">{{ isset($electricity) ? $electricity->extra_note : old('extra_note') }}</textarea>
            @error('extra_note')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>