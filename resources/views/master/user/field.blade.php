<div class="card-body">
    
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', (isset($isEdit) ? $users->name : '')) }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', (isset($isEdit) ? $users->email : '')) }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        @if(!isset($isEdit))
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        @endif

        <div class="row mb-3">
            <label for="role_id" class="col-md-4 col-form-label text-md-end">Role</label>

            <div class="col-md-6">
                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                    <option value="">-- select role --</option>
                    @foreach($roles as $val => $key)
                    <option value="{{$key}}" @if($key == @$users->role_id) selected @endif>{{$val}}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="container-bank">
        <div class="row mb-3">
            <label for="bank_id" class="col-md-4 col-form-label text-md-end">Bank</label>

            <div class="col-md-6">
                <select name="bank_id" id="bank_id" class="form-control @error('bank_id') is-invalid @enderror" required>
                    <option value="">-- select bank --</option>
                    @foreach($banks as $val => $key)
                    <option value="{{$key}}" @if($key == @$users->bank_id) selected @endif>{{$val}}</option>
                    @endforeach
                </select>

                @error('bank_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="account_number" class="col-md-4 col-form-label text-md-end">No. Rekening</label>

            <div class="col-md-6">
                <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number', (isset($isEdit) ? $users->account_number : '')) }}" required autocomplete="name" autofocus>

                @error('account_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary float-end">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        if ("{{isset($isEdit)}}" && "{{@$users->role_id}}" == 1) {
            $(".container-bank").show();
        } else {
            $(".container-bank").hide();
        }
        $('#role_id').on('change', function (e) {
            let rID = $('#role_id').find(":selected").val();

            if (rID && rID == 1) {
                $(".container-bank").show();
            }else{
                $(".container-bank").hide();
            }
        });
    });
</script>
@endsection