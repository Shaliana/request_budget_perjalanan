<div class="card-body">
    
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', (isset($isEdit) ? $items->name : '')) }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary float-end">
                    Back
                </a>
            </div>
        </div>
</div>