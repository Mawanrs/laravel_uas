@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tambah_siswaa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tambah_siswaa.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.id') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nis') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->nis }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nama_siswaa') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->nama_siswaa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.jenis_kelamin') }}
                        </th>
                        <td>
                            {{ App\Models\tambah_siswaa::jenis_kelamin[$tambah_siswaa->jenis_kelamin]  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.kelas') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->kelas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.tempat_lahir') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->tempat_lahir }}
                        </td>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nama_orangtua') }}
                        </th>
                        <td>
                            {{ $tambah_siswaa->nama_orangtua }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tambah_siswaa.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection