@extends('layouts.admin')
@section('content')
@can('penilaian_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.penilaians.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.penilaian.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.penilaian.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-penilaian">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.tambah_siswaa_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.prestasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_displin') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_absensi') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_mpe') }}
                        </th>
                        <th>
                            {{ trans('cruds.penilaian.fields.keterangan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penilaian as $key => $penilaian)
                        <tr data-entry-id="{{ $penilaian->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penilaian->id ?? '' }}
                            </td>
                            <td>
                                {{ $penilaian->tambahSiswaa->nama_siswaa ?? '' }}
                            </td>
                            <td>
                                {{ $penilaian->prestasi ?? '' }}
                            </td>
                            <td>
                                {{ $penilaian->nilai_displin ?? '' }}
                            </td>
                            <td>
                                {{ $penilaian->nilai_absensi ?? '' }}
                            </td>
                            <td>
                                {{ $penilaian->nilai_mpe ?? '' }}
                            </td>
                            <td>
                                {{ array_key_exists($penilaian->keterangan, App\Models\Penilaian::Keterangan) ? App\Models\Penilaian::Keterangan[$penilaian->keterangan] : ' '}}
                            </td>
                            <td>
                                @can('penilaian_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.penilaians.show', $penilaian->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('penilaian_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.penilaians.edit', $penilaian->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('penilaian_delete')
                                    <form action="{{ route('admin.penilaians.destroy', $penilaian->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        @can('penilaian_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.penilaians.massDestroy') }}",
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
                        headers: {'x-csrf-token': '{{ csrf_token() }}'},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' },
                    })
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
        let table = $('.datatable-penilaian:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>

@endsection