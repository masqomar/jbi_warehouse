<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="placement_id">{{ __('Placement') }}</label>
            <select class="form-select" name="placement_id" id="placement_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select placement') }} --</option>
                
                @foreach ($placements as $placement)
                    <option value="{{ $placement->id }}" {{ isset($placementItem) && $placementItem->placement_id == $placement->id ? 'selected' : (old('placement_id') == $placement->id ? 'selected' : '') }}>
                        {{ $placement->placement_code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="asset_item_id">{{ __('AssetItem') }}</label>
            <select class="form-select" name="asset_item_id" id="asset_item_id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select assetitem') }} --</option>
                
                @foreach ($assetItems as $assetItem)
                    <option value="{{ $assetItem->id }}" {{ isset($placementItem) && $placementItem->asset_item_id == $assetItem->id ? 'selected' : (old('asset_item_id') == $assetItem->id ? 'selected' : '') }}>
                        {{ $assetItem->code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">{{ __('Status') }}</label>
            <select class="form-select" name="status" id="status" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select status') }} --</option>
                <option value="Yes" {{ isset($placementItem) && $placementItem->status == 'Yes' ? 'selected' : (old('status') == 'Yes' ? 'selected' : '') }}>Yes</option>
		<option value="No" {{ isset($placementItem) && $placementItem->status == 'No' ? 'selected' : (old('status') == 'No' ? 'selected' : '') }}>No</option>			
            </select>
        </div>
    </div>
</div>