<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($room) ? $room->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ __('Status') }}</label>
            <select class="form-select" name="status" id="status" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select status') }} --</option>
                <option value="0" {{ isset($room) && $room->status == '0' ? 'selected' : (old('status') == '0' ? 'selected' : '') }}>{{ __('True') }}</option>
				<option value="1" {{ isset($room) && $room->status == '1' ? 'selected' : (old('status') == '1' ? 'selected' : '') }}>{{ __('False') }}</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="building_id">{{ __('Building') }}</label>
            <select class="form-select" name="building_id" id="building_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select building') }} --</option>
                
                @foreach ($buildings as $building)
                    <option value="{{ $building->id }}" {{ isset($room) && $room->building_id == $building->id ? 'selected' : (old('building_id') == $building->id ? 'selected' : '') }}>
                        {{ $building->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">{{ __('Company') }}</label>
            <select class="form-select" name="company_id" id="company_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select company') }} --</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ isset($room) && $room->company_id == $company->id ? 'selected' : (old('company_id') == $company->id ? 'selected' : '') }}>
                        {{ $company->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>