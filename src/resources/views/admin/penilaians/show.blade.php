@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.penilaian.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.penilaians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penilaian.fields.id') }}
                        </th>
                        <td>
                            {{ $penilaians->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penilaian.fields.tambah_siswaa_id') }}
                        </th>
                        <td>
                            {{ $penilaians->tambahSiswaa->nama_siswaa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penilaian.fields.prestasi') }}
                        </th>
                        <td>
                            {{ $penilaians->prestasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_displin') }}
                        </th>
                        <td>
                            {{ $penilaians->nilai_displin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_absensi') }}
                        </th>
                        <td>
                            {{ $penilaians->nilai_absensi }}
                        </td>
                        <th>
                            {{ trans('cruds.penilaian.fields.nilai_mpe') }}
                        </th>
                        <td>
                            {{ $penilaians->nilai_mpe }}
                        </td>
                        <th>
                            {{ trans('cruds.penilaian.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $penilaians->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.penilaians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
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