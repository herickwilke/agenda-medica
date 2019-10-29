@extends('layouts.admin')
@section('content')
@can('atendimento_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.atendimentos.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.atendimento.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.atendimento.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Atendimento">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.paciente') }}
                        </th>
                        <th>
                            {{ trans('cruds.paciente.fields.observacoes') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.procedimento') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.data') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.hora') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.duracao') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.observacoes') }}
                        </th>
                        <th>
                            {{ trans('cruds.atendimento.fields.documento') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atendimentos as $key => $atendimento)
                        <tr data-entry-id="{{ $atendimento->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $atendimento->id ?? '' }}
                            </td>
                            <td>
                                {{ $atendimento->paciente->nome ?? '' }}
                            </td>
                            <td>
                                {{ $atendimento->paciente->observacoes ?? '' }}
                            </td>
                            <td>
                                {{ App\Atendimento::PROCEDIMENTO_SELECT[$atendimento->procedimento] ?? '' }}
                            </td>
                            <td>
                                {{ $atendimento->data ?? '' }}
                            </td>
                            <td>
                                {{ $atendimento->hora ?? '' }}
                            </td>
                            <td>
                                {{ App\Atendimento::DURACAO_SELECT[$atendimento->duracao] ?? '' }}
                            </td>
                            <td>
                                {{ $atendimento->observacoes ?? '' }}
                            </td>
                            <td>
                                @if($atendimento->documento)
                                    @foreach($atendimento->documento as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('atendimento_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.atendimentos.show', $atendimento->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('atendimento_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.atendimentos.edit', $atendimento->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('atendimento_delete')
                                    <form action="{{ route('admin.atendimentos.destroy', $atendimento->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('atendimento_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.atendimentos.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Atendimento:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection