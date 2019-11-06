@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atendimento.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.id') }}
                        </th>
                        <td>
                            {{ $atendimento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.paciente') }}
                        </th>
                        <td>
                            {{ $atendimento->paciente->nome ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.procedimento') }}
                        </th>
                        <td>
                            {{ App\Atendimento::PROCEDIMENTO_SELECT[$atendimento->procedimento] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.data') }}
                        </th>
                        <td>
                            {{ $atendimento->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.hora') }}
                        </th>
                        <td>
                            {{ $atendimento->hora }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.duracao') }}
                        </th>
                        <td>
                            {{ App\Atendimento::DURACAO_SELECT[$atendimento->duracao] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.observacoes') }}
                        </th>
                        <td>
                            {!! $atendimento->observacoes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atendimento.fields.documento') }}
                        </th>
                        <th>
                        @if($atendimento->documento)
                                    @foreach($atendimento->documento as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                        </a><br>
                                    @endforeach
                                @endif
                        </th>
                    </tr>
                </tbody>
            </table>

            <br>
            <br>

            <h3>Observações</h3>

            <br>

            @comments(['model' => $atendimento])

            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection