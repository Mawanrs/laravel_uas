@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tambah_siswaa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tambah_siswaa.update", [$tambah_siswaa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nis">{{ trans('cruds.tambah_siswaa.fields.nis') }}</label>
                <input class="form-control {{ $errors->has('nis') ? 'is-invalid' : '' }}" type="text" nis="nis" id="nis" value="{{ old('nis', $tambah_siswaa->nis) }}">
                @if($errors->has('nis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.nis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_siswaa">{{ trans('cruds.tambah_siswaa.fields.nama_siswaa') }}</label>
                <input class="form-control {{ $errors->has('nama_siswaa') ? 'is-invalid' : '' }}" type="text" name="nama_siswaa" id="nama_siswaa" value="{{ old('nama_siswaa', $tambah_siswaa->nama_siswaa) }}">
                @if($errors->has('nama_siswaa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_siswaa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.nama_siswaa_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tambah_siswaa.fields.jenis_kelamin') }}</label>
                <select class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" name="jenis_kelamin" id="jenis_kelamin">
                    <option value disabled {{ old('jenis_kelamin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Tambah_siswaa::jenis_kelamin as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_kelamin', $tambah_siswaa->jenis_kelamin) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_kelamin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_kelamin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.jenis_kelamin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kelas">{{ trans('cruds.tambah_siswaa.fields.kelas') }}</label>
                <input class="form-control {{ $errors->has('kelas') ? 'is-invalid' : '' }}" type="number" name="kelas" id="kelas" value="{{ old('kelas', $tambah_siswaa->kelas) }}" step="1">
                @if($errors->has('kelas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kelas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.kelas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">{{ trans('cruds.tambah_siswaa.fields.tempat_lahir') }}</label>
                <input class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $tambah_siswaa->tempat_lahir) }}">
                @if($errors->has('tempat_lahir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tempat_lahir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.tempat_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">{{ trans('cruds.tambah_siswaa.fields.tanggal_lahir') }}</label>
                <input class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $tambah_siswaa->tanggal_lahir) }}">
                @if($errors->has('tanggal_lahir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggal_lahir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.tanggal_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_orangtua">{{ trans('cruds.tambah_siswaa.fields.nama_orangtua') }}</label>
                <input class="form-control {{ $errors->has('nama_orangtua') ? 'is-invalid' : '' }}" type="text" name="nama_orangtua" id="nama_orangtua" value="{{ old('nama_orangtua', $tambah_siswaa->nama_orangtua) }}">
                @if($errors->has('nama_orangtua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_orangtua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tambah_siswaa.fields.nama_orangtua_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

{{-- @section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.tambah_siswaas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($tambah_siswaa) && $tambah_siswaa->image)
      var file = {!! json_encode($tambah_siswaa->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection --}}