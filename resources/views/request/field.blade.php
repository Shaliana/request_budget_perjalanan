<div class="card-body">
    
        <div class="row mb-3">
            <label for="item_id" class="col-md-4 col-form-label text-md-end">Item Request</label>

            <div class="col-md-6">
                <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror" required autofocus>
                    <option value="">-- select item --</option>
                    @foreach($items as $val => $key)
                    <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                </select>

                @error('item_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nominal" class="col-md-4 col-form-label text-md-end">Nominal</label>

            <div class="col-md-6">
                <input id="nominal" type="tel" class="form-control @error('nominal') is-invalid @enderror number_form" name="nominal" value="{{ old('nominal') }}" required>

                @error('nominal')
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
                <a href="{{ route('requests.index') }}" class="btn btn-secondary float-end">
                    Back
                </a>
            </div>
        </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        $('.number_form').on('change click keyup input paste', (function (event) {
              $(this).val(function (index, value) {
                  return value.replace(/(?!\,)\D/g, "")
                      .replace(/(?<=\,.*)\,/g, "")
                      .replace(/(?<=\,\d{2}).*/g, "")
                      .replace(/\B(?=(\d{3})+(?!\d)+(\,))/g, ".");
              });
          }));

          $('.number_form').on('focusout', function (event) {
              if ($(this).val() !== "" && $(this).val().indexOf(',') == -1 && $(this).val().indexOf('.') == -1) {
                  $(this).val(function (index, value) {
                      return value.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                  });

                  $(this).val(this.value);
              }
          });
    });
</script>
@endsection