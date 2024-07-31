@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.penilaians.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.penilaians.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tambah_siswaa_id">{{ trans('cruds.penilaian.fields.tambah_siswaa_id') }}</label>
                <input class="form-control {{ $errors->has('tambah_siswaa_id') ? 'is-invalid' : '' }}" type="number" name="tambah_siswaa_id" id="tambah_siswaa_id" value="{{ old('tambah_siswaa_id', '') }}" step="1">
                @if($errors->has('tambah_siswaa_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tambah_siswaa_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.tambah_siswaa_id_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prestasi">{{ trans('cruds.penilaian.fields.prestasi') }}</label>
                <input class="form-control {{ $errors->has('prestasi') ? 'is-invalid' : '' }}" type="text" name="prestasi" id="prestasi" value="{{ old('prestasi', '') }}">
                @if($errors->has('prestasi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prestasi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.prestasi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_displin">{{ trans('cruds.penilaian.fields.nilai_displin') }}</label>
                <input class="form-control {{ $errors->has('nilai_displin') ? 'is-invalid' : '' }}" type="number" name="nilai_displin" id="nilai_displin" value="{{ old('nilai_displin', '') }}">
                @if($errors->has('nilai_displin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_displin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_displin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_absensi">{{ trans('cruds.penilaian.fields.nilai_absensi') }}</label>
                <input class="form-control {{ $errors->has('nilai_absensi') ? 'is-invalid' : '' }}" type="number" name="nilai_absensi" id="nilai_absensi" value="{{ old('nilai_absensi', '') }}" step="1">
                @if($errors->has('nilai_absensi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_absensi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_absensi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nilai_mpe">{{ trans('cruds.penilaian.fields.nilai_mpe') }}</label>
                <input class="form-control {{ $errors->has('nilai_mpe') ? 'is-invalid' : '' }}" type="number" name="nilai_mpe" id="nilai_mpe" value="{{ old('nilai_mpe', '') }}">
                @if($errors->has('nilai_mpe'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nilai_mpe') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penilaian.fields.nilai_mpe_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.penilaian.fields.keterangan') }}</label>
                <select class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">
                    <option value disabled {{ old('keterangan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Penilaian::Keterangan as $key => $label)
                        <option value="{{ $key }}" {{ old('keterangan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
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
