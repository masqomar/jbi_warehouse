<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="reg_number">{{ __('Reg Number') }}</label>
            <input type="number" name="reg_number" id="reg_number" onkeyup="isi_otomatis()" class="form-control @error('reg_number') is-invalid @enderror" value="{{ isset($member) ? $member->reg_number : old('reg_number') }}" placeholder="{{ __('Reg Number') }}" required />
            @error('reg_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($member) ? $member->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="period">{{ __('Period') }}</label>
            <input type="text" name="period" id="period" class="form-control @error('period') is-invalid @enderror" value="{{ isset($member) && $member->period ? $member->period->format('Y-m-d') : old('period') }}" placeholder="{{ __('Period') }}" required />
            @error('period')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="gender">{{ __('Gender') }}</label>
            <input type="text" name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ isset($member) ? $member->gender : old('gender') }}" placeholder="{{ __('Gender') }}" required />
            @error('gender')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="education">{{ __('Education') }}</label>
            <input type="text" name="education" id="education" class="form-control @error('education') is-invalid @enderror" value="{{ isset($member) ? $member->education : old('education') }}" placeholder="{{ __('Education') }}" />
            @error('education')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tshirt">{{ __('Tshirt') }}</label>
            <input type="text" name="tshirt" id="tshirt" class="form-control @error('tshirt') is-invalid @enderror" value="{{ isset($member) ? $member->tshirt : old('tshirt') }}" placeholder="{{ __('Tshirt') }}" required />
            @error('tshirt')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($member) ? $member->phone : old('phone') }}" placeholder="{{ __('Phone') }}" />
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="program">{{ __('Program') }}</label>
            <input type="text" name="program" id="program" class="form-control @error('program') is-invalid @enderror" value="{{ isset($member) ? $member->program : old('program') }}" placeholder="{{ __('Program') }}" required />
            @error('program')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('Address') }}">{{ isset($member) ? $member->address : old('address') }}</textarea>
            @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="program_id">{{ __('Toolkit') }}</label>
            <select class="form-select" class="form-control" name="program_id" id="program_id">
                <option value="">Select Program</option>
                @if(count($IDs) > 0)
                @foreach ($IDs as $id)
                <option value="{{$id->id}}">{{$id->name}}</option>
                @endforeach
                @endif

            </select>
            <br />

            <table>
                <thead>

                </thead>
                <tbody id="tbody"></tbody>

            </table>
            @error('program_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    function isi_otomatis() {
        var reg_number = $("#reg_number").val();
        $.ajax({
            url: 'https://bod.languagecenter.id/member/',
            data: {
                id: reg_number,
                key: 'lcokaok3no1'
            },
        }).success(function(data) {
            $('#name').val(data.name);
            $('#gender').val(data.gender);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#period').val(data.periode);
            $('#program ').val(data.course_name);
            $('#education ').val(data.education);
            $('#tshirt ').val(data.tshirt);
        });
    }
</script>
<script>
    $(document).ready(function() {
        $("#program_id").on('change', function() {
            var program_id = $(this).val();
            $.ajax({
                url: "{{ route('members.create') }}",
                type: "GET",
                data: {
                    'program_id': program_id
                },
                success: function(data) {
                    console.log(data);

                    var html = '';
                    $.each(data.product, function(i, product) {
                        html += '<tr>\
                                <td width="10%"><input type="text" readonly class="form-control" name="inventory_id[]" value="' + product.id + '"></td>\
                                <td width="50%"><input type="text" readonly class="form-control" name="product_name[]" value="' + product.name + '"></td>\
                                <td width="15%"><input type="text" readonly class="form-control" name="remaining_stock[]" value="' + product.quantity + '"></td>\
                                <td width="10%"><input type="text" class="form-control" name="quantity[]" value="1"></td>\
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