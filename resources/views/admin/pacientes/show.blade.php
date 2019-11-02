@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paciente.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.id') }}
                        </th>
                        <td>
                            {{ $paciente->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.nome') }}
                        </th>
                        <td>
                            {{ $paciente->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.nascimento') }}
                        </th>
                        <td>
                            {{ $paciente->nascimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.sexo') }}
                        </th>
                        <td>
                            {{ App\Paciente::SEXO_RADIO[$paciente->sexo] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.email') }}
                        </th>
                        <td>
                            {{ $paciente->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.fone_pessoal') }}
                        </th>
                        <td>
                            {{ $paciente->fone_pessoal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.fone_comercial') }}
                        </th>
                        <td>
                            {{ $paciente->fone_comercial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.observacoes') }}
                        </th>
                        <td>
                            {!! $paciente->observacoes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.endereco') }}
                        </th>
                        <td>
                            {{ $paciente->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.bairro') }}
                        </th>
                        <td>
                            {{ $paciente->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.cidade') }}
                        </th>
                        <td>
                            {{ $paciente->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.cep') }}
                        </th>
                        <td>
                            {{ $paciente->cep }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.estado') }}
                        </th>
                        <td>
                            {{ $paciente->estado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paciente.fields.documento') }}
                        </th>
                        <td>
                            {{ $paciente->documento }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <br>
            <br>

            <h3>Observações</h3>

            <br>

            @comments(['model' => $paciente])

            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection