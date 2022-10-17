<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($building) ? $building->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($building) ? $building->phone : old('phone') }}" placeholder="{{ __('Phone') }}" />
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('Address') }}">{{ isset($building) ? $building->address : old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="owner">{{ __('Owner') }}</label>
            <input type="text" name="owner" id="owner" class="form-control @error('owner') is-invalid @enderror" value="{{ isset($building) ? $building->owner : old('owner') }}" placeholder="{{ __('Owner') }}" />
            @error('owner')
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
                <option value="0" {{ isset($building) && $building->status == '0' ? 'selected' : (old('status') == '0' ? 'selected' : '') }}>{{ __('True') }}</option>
				<option value="1" {{ isset($building) && $building->status == '1' ? 'selected' : (old('status') == '1' ? 'selected' : '') }}>{{ __('False') }}</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">{{ __('Company') }}</label>
            <select class="form-select" name="company_id" id="company_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select company') }} --</option>
                
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ isset($building) && $building->company_id == $company->id ? 'selected' : (old('company_id') == $company->id ? 'selected' : '') }}>
                        {{ $company->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>