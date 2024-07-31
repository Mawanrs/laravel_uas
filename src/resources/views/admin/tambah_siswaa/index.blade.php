@extends('layouts.admin')
@section('content')
@can('tambah_siswaa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tambah_siswaa.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tambah_siswaa.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tambah_siswaa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-tambah_siswaa">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nis') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nama_siswaa') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.jenis_kelamin') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.kelas') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.tempat_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.tanggal_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.tambah_siswaa.fields.nama_orangtua') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tambah_siswaas as $key => $tambah_siswaa)
                        <tr data-entry-id="{{ $tambah_siswaa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tambah_siswaa->id ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->nis ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->nama_siswaa ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Tambah_siswaa::jenis_kelamin[$tambah_siswaa->jenis_kelamin] ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->kelas ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->tempat_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->tanggal_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $tambah_siswaa->nama_orangtua ?? '' }}
                            </td>
                            <td>
                                @can('tambah_siswaa_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tambah_siswaa.show', $tambah_siswaa->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tambah_siswaa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tambah_siswaa.edit', $tambah_siswaa->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tambah_siswaa_delete')
                                    <form action="{{ route('admin.tambah_siswaa.destroy', $tambah_siswaa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tambah_siswaa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tambah_siswaa.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-tambah_siswaa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection