<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ isset($user) ? $user->name : old('name') }}" required autofocus>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ isset($user) ? $user->email : old('email') }}" required>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" {{ empty($user) ? 'required' : '' }}>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="password-confirmation">{{ __('Password Confirmation') }}</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" {{ empty($user) ? 'required' : '' }}>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="company_id">{{ __('Company') }}</label>
            <select name="company_id" id="company_id" class="form-control">
                <option value="">-- Select Company --</option>

                @foreach ($companies as $id)
                <option value="{{$id->id}}">{{$id->name}}</option>
                @endforeach

            </select>
            @error('company_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="devision_id">{{ __('Devision') }}</label>
            <select id="devision-dropdown" name="devision_id" class="form-control">
            </select>

            @error('devision_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    @empty($user)
    <div class="col-md-6">
        <div class="form-group">
            <label for="role">{{ __('Role') }}</label>
            <select class="form-select" name="role" id="role" class="form-control">
                <option value="" selected disabled>-- Select Role --</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
                @error('role')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="avatar">{{ __('Avatar') }}</label>
            <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    @endempty

    @isset($user)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role">{{ __('Role') }}</label>
                <select class="form-select" name="role" id="role" class="form-control">
                    <option value="" selected disabled>{{ __('-- Select role --') }}</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->getRoleNames()->toArray() !== [] && $user->getRoleNames()[0] == $role->name ? 'selected' : '-' }}>
                        {{ $role->name }}
                    </option>
                    @endforeach
                </select>
                @error('role')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-md-1 text-center">
            <div class="avatar avatar-xl">
                @if ($user->avatar == null)
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}&s=500" alt="avatar">
                @else
                <img src="{{ asset("uploads/images/avatars/$user->avatar") }}" alt="avatar">
                @endif
            </div>
        </div>

        <div class="col-md-5 me-0 pe-0">
            <div class="form-group">
                <label for="avatar">{{ __('Avatar') }}</label>
                <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
                @error('avatar')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    @endisset
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#company_id").on('change', function() {
            var company_id = $(this).val();
            $.ajax({
                url: "{{ route('users.create') }}",
                type: "GET",
                data: {
                    'company_id': company_id
                },
                success: function(data) {
                    console.log(data);

                    $('#devision-dropdown').html('<option value="">-- Select Devision --</option>');
                    $.each(data.devisions, function(key, value) {
                        $("#devision-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endpush