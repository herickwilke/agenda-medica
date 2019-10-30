@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paciente.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.pacientes.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                <label for="nome">{{ trans('cruds.paciente.fields.nome') }}*</label>
                <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome', isset($paciente) ? $paciente->nome : '') }}" required>
                @if($errors->has('nome'))
                    <p class="help-block">
                        {{ $errors->first('nome') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.nome_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('nascimento') ? 'has-error' : '' }}">
                <label for="nascimento">{{ trans('cruds.paciente.fields.nascimento') }}*</label>
                <input type="text" id="nascimento" name="nascimento" class="form-control date" value="{{ old('nascimento', isset($paciente) ? $paciente->nascimento : '') }}" required>
                @if($errors->has('nascimento'))
                    <p class="help-block">
                        {{ $errors->first('nascimento') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.nascimento_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('sexo') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.paciente.fields.sexo') }}*</label>
                @foreach(App\Paciente::SEXO_RADIO as $key => $label)
                    <div>
                        <input id="sexo_{{ $key }}" name="sexo" type="radio" value="{{ $key }}" {{ old('sexo', null) === (string)$key ? 'checked' : '' }} required>
                        <label for="sexo_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('sexo'))
                    <p class="help-block">
                        {{ $errors->first('sexo') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.paciente.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($paciente) ? $paciente->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('fone_pessoal') ? 'has-error' : '' }}">
                <label for="fone_pessoal">{{ trans('cruds.paciente.fields.fone_pessoal') }}*</label>
                <input type="text" id="fone_pessoal" name="fone_pessoal" class="form-control" value="{{ old('fone_pessoal', isset($paciente) ? $paciente->fone_pessoal : '') }}" required>
                @if($errors->has('fone_pessoal'))
                    <p class="help-block">
                        {{ $errors->first('fone_pessoal') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.fone_pessoal_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('fone_comercial') ? 'has-error' : '' }}">
                <label for="fone_comercial">{{ trans('cruds.paciente.fields.fone_comercial') }}</label>
                <input type="text" id="fone_comercial" name="fone_comercial" class="form-control" value="{{ old('fone_comercial', isset($paciente) ? $paciente->fone_comercial : '') }}">
                @if($errors->has('fone_comercial'))
                    <p class="help-block">
                        {{ $errors->first('fone_comercial') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.fone_comercial_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('observacoes') ? 'has-error' : '' }}">
                <label for="observacoes">{{ trans('cruds.paciente.fields.observacoes') }}</label>
                <textarea id="observacoes" name="observacoes" class="form-control ckeditor">{{ old('observacoes', isset($paciente) ? $paciente->observacoes : '') }}</textarea>
                @if($errors->has('observacoes'))
                    <p class="help-block">
                        {{ $errors->first('observacoes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.observacoes_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('endereco') ? 'has-error' : '' }}">
                <label for="endereco">{{ trans('cruds.paciente.fields.endereco') }}*</label>
                <input type="text" id="endereco" name="endereco" class="form-control" value="{{ old('endereco', isset($paciente) ? $paciente->endereco : '') }}" required>
                @if($errors->has('endereco'))
                    <p class="help-block">
                        {{ $errors->first('endereco') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.endereco_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }}">
                <label for="bairro">{{ trans('cruds.paciente.fields.bairro') }}*</label>
                <input type="text" id="bairro" name="bairro" class="form-control" value="{{ old('bairro', isset($paciente) ? $paciente->bairro : '') }}" required>
                @if($errors->has('bairro'))
                    <p class="help-block">
                        {{ $errors->first('bairro') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.bairro_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }}">
                <label for="cidade">{{ trans('cruds.paciente.fields.cidade') }}*</label>
                <input type="text" id="cidade" name="cidade" class="form-control" value="{{ old('cidade', isset($paciente) ? $paciente->cidade : '') }}" required>
                @if($errors->has('cidade'))
                    <p class="help-block">
                        {{ $errors->first('cidade') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.cidade_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }}">
                <label for="cep">{{ trans('cruds.paciente.fields.cep') }}*</label>
                <input type="text" id="cep" name="cep" class="form-control" value="{{ old('cep', isset($paciente) ? $paciente->cep : '') }}" required>
                @if($errors->has('cep'))
                    <p class="help-block">
                        {{ $errors->first('cep') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.cep_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                <label for="estado">{{ trans('cruds.paciente.fields.estado') }}*</label>
                <input type="text" id="estado" name="estado" class="form-control" value="{{ old('estado', isset($paciente) ? $paciente->estado : '') }}" required>
                @if($errors->has('estado'))
                    <p class="help-block">
                        {{ $errors->first('estado') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.estado_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('documento') ? 'has-error' : '' }}">
                <label for="documento">{{ trans('cruds.paciente.fields.documento') }}</label>
                <div class="needsclick dropzone" id="documento-dropzone">

                </div>
                @if($errors->has('documento'))
                    <p class="help-block">
                        {{ $errors->first('documento') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.paciente.fields.documento_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedDocumentoMap = {}
Dropzone.options.documentoDropzone = {
    url: '{{ route('admin.pacientes.storeMedia') }}',
    maxFilesize: 3, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documento[]" value="' + response.name + '">')
      uploadedDocumentoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentoMap[file.name]
      }
      $('form').find('input[name="documento[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($paciente) && $paciente->documento)
          var files =
            {!! json_encode($paciente->documento) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documento[]" value="' + file.file_name + '">')
            }
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
@stop