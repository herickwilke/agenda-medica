@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h4> Informações do paciente {{$paciente->nome}}</h4>
    </div>


    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID do paciente
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
                        <th>
                            @if($paciente->documento)
                            @foreach($paciente->documento as $key => $media)
                            <a href="{{ $media->getUrl() }}" target="_blank">
                                {{ trans('global.view_file') }}
                            </a><br>
                            @endforeach
                            @endif
                        </th>
                    </tr>
                </tbody>
            </table>

            <br> <br>

            <h4>Observações</h4> 
            @comments(['model' => $paciente])
            
            {{-- IMPRIMIR TODOS OS ATENDIMENTOS --}}
            
            <br> 
            <hr> <h4>Imprimir relatório</h4> 
            <p>Ao clicar no botão abaixo, serão impressos os dados e atendimentos do paciente acima.</p>
            {{-- Botão imprimir --}}
            <input type="button" onclick="javascript:window.print();" value="Clique para imprimir">
            <br><br>


            <br> <br> 
            <hr>
            <h4>Todos os atendimentos</h4>
            
            
            @foreach (\App\Atendimento::all()->where('paciente_id', '=', $paciente->id) as $atendimento )
            
            
            
            <div class="card-body">
                <div class="mb-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    Identificador do atendimento
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
                                    {{ $atendimento->procedimento }}
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
                                    {{ $atendimento->duracao }}
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
                    
                    <h4>Observações</h4>
                    
                    <br>
                    
                    @comments(['model' => $atendimento])
                    
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                
                
            </div>
            @endforeach
            
            
            <hr>    
            
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