@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.penilaian.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.penilaians.update", [$penilaian->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- <div class="form-group">
                <label for="image">{{ trans('cruds.penilaiaan.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaiaan.fields.image_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="tambah_siswaa_id">{{ trans('cruds.product.fields.tambah_siswaa_id') }}</label>
                <input class="form-control {{ $errors->has('tambah_siswaa_id') ? 'is-invalid' : '' }}" type="number" name="tambah_siswaa_id" id="tambah_siswaa_id" value="{{ old('tambah_siswaa_id', '') }}" step="1">
                @if($errors->has('tambah_siswaa_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tambah_siswaa_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tambah_siswaa_id_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prestasi">{{ trans('cruds.penilaian.fields.prestasi') }}</label>
                <input class="form-control {{ $errors->has('prestasi') ? 'is-invalid' : '' }}" type="text" name="prestasi" id="prestasi" value="{{ old('prestasi', $penilaian->prestasi) }}">
                @if($errors->has('prestasi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prestasi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.prestasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_displin">{{ trans('cruds.penilaian.fields.nilai_displin') }}</label>
                <input class="form-control {{ $errors->has('nilai_displin') ? 'is-invalid' : '' }}" type="number" name="nilai_displin" id="nilai_displin" value="{{ old('nilai_displin', $penilaian->nilai_displin) }}" step="1">
                @if($errors->has('nilai_displin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_displin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_displin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_absensi">{{ trans('cruds.penilaian.fields.nilai_absensi') }}</label>
                <input class="form-control {{ $errors->has('nilai_absensi') ? 'is-invalid' : '' }}" type="text" name="nilai_absensi" id="nilai_absensi" value="{{ old('nilai_absensi', $penilaian->nilai_absensi) }}">
                @if($errors->has('nilai_absensi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_absensi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_absensi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_mpe">{{ trans('cruds.penilaian.fields.nilai_mpe') }}</label>
                <input class="form-control {{ $errors->has('nilai_mpe') ? 'is-invalid' : '' }}" type="text" name="nilai_mpe" id="nilai_mpe" value="{{ old('nilai_mpe', $penilaian->nilai_mpe) }}">
                @if($errors->has('nilai_mpe'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_MPE') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_mpe_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.penilaian.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', $penilaian->keterangan) }}">
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.keterangan_helper') }}</span>
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
    url: '{{ route('admin.penilaiaans.storeMedia') }}',
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
@if(isset($penilaiaan) && $penilaiaan->image)
      var file = {!! json_encode($penilaiaan->image) !!}
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