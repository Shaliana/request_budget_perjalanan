        <div class="row mb-3">
            <label for="item_id" class="col-md-4 col-form-label text-md-end">Bukti Transfer</label>

            <div class="col-md-6">
                <input type="file" name="bukti_transfer" class="form-control @error('bukti_transfer') is-invalid @enderror" accept="image/*" required autofocus>

                @error('bukti_transfer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="information" class="col-md-4 col-form-label text-md-end">Keterangan</label>

            <div class="col-md-6">
                <textarea name="information" id="information" cols="8" rows="5" class="form-control @error('information') is-invalid @enderror">{{ old('information') }}</textarea>

                @error('information')
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
                <a href="{{ route('requests_finance.index') }}" class="btn btn-secondary float-end">
                    Back
                </a>
            </div>
        </div>