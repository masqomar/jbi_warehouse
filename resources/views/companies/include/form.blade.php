<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="code">{{ __('Code') }}</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ isset($company) ? $company->code : old('code') }}" placeholder="{{ __('Code') }}" required />
            @error('code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($company) ? $company->name : old('name') }}" placeholder="{{ __('Name') }}" required />
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
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($company) ? $company->phone : old('phone') }}" placeholder="{{ __('Phone') }}" required />
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
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('Address') }}" required>{{ isset($company) ? $company->address : old('address') }}</textarea>
            @error('address')
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
                <option value="1" {{ isset($company) && $company->status == '0' ? 'selected' : (old('status') == '0' ? 'selected' : '') }}>{{ __('True') }}</option>
                <option value="0" {{ isset($company) && $company->status == '1' ? 'selected' : (old('status') == '1' ? 'selected' : '') }}>{{ __('False') }}</option>
            </select>
        </div>
    </div>
</div>