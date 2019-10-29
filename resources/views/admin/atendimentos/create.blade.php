@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.atendimento.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.atendimentos.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('paciente_id') ? 'has-error' : '' }}">
                <label for="paciente">{{ trans('cruds.atendimento.fields.paciente') }}*</label>
                <select name="paciente_id" id="paciente" class="form-control select2" required>
                    @foreach($pacientes as $id => $paciente)
                        <option value="{{ $id }}" {{ (isset($atendimento) && $atendimento->paciente ? $atendimento->paciente->id : old('paciente_id')) == $id ? 'selected' : '' }}>{{ $paciente }}</option>
                    @endforeach
                </select>
                @if($errors->has('paciente_id'))
                    <p class="help-block">
                        {{ $errors->first('paciente_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('procedimento') ? 'has-error' : '' }}">
                <label for="procedimento">{{ trans('cruds.atendimento.fields.procedimento') }}*</label>
                <select id="procedimento" name="procedimento" class="form-control" required>
                    <option value="" disabled {{ old('procedimento', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Atendimento::PROCEDIMENTO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('procedimento', null) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('procedimento'))
                    <p class="help-block">
                        {{ $errors->first('procedimento') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('data') ? 'has-error' : '' }}">
                <label for="data">{{ trans('cruds.atendimento.fields.data') }}*</label>
                <input type="text" id="data" name="data" class="form-control date" value="{{ old('data', isset($atendimento) ? $atendimento->data : '') }}" required>
                @if($errors->has('data'))
                    <p class="help-block">
                        {{ $errors->first('data') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.atendimento.fields.data_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('hora') ? 'has-error' : '' }}">
                <label for="hora">{{ trans('cruds.atendimento.fields.hora') }}*</label>
                <input type="text" id="hora" name="hora" class="form-control timepicker" value="{{ old('hora', isset($atendimento) ? $atendimento->hora : '') }}" required>
                @if($errors->has('hora'))
                    <p class="help-block">
                        {{ $errors->first('hora') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.atendimento.fields.hora_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('duracao') ? 'has-error' : '' }}">
                <label for="duracao">{{ trans('cruds.atendimento.fields.duracao') }}*</label>
                <select id="duracao" name="duracao" class="form-control" required>
                    <option value="" disabled>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Atendimento::DURACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('duracao', 1.00) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('duracao'))
                    <p class="help-block">
                        {{ $errors->first('duracao') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('observacoes') ? 'has-error' : '' }}">
                <label for="observacoes">{{ trans('cruds.atendimento.fields.observacoes') }}</label>
                <textarea id="observacoes" name="observacoes" class="form-control ">{{ old('observacoes', isset($atendimento) ? $atendimento->observacoes : '') }}</textarea>
                @if($errors->has('observacoes'))
                    <p class="help-block">
                        {{ $errors->first('observacoes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.atendimento.fields.observacoes_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('documento') ? 'has-error' : '' }}">
                <label for="documento">{{ trans('cruds.atendimento.fields.documento') }}</label>
                <div class="needsclick dropzone" id="documento-dropzone">

                </div>
                @if($errors->has('documento'))
                    <p class="help-block">
                        {{ $errors->first('documento') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.atendimento.fields.documento_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedDocumentoMap = {}
Dropzone.options.documentoDropzone = {
    url: '{{ route('admin.atendimentos.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
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
@if(isset($atendimento) && $atendimento->documento)
          var files =
            {!! json_encode($atendimento->documento) !!}
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