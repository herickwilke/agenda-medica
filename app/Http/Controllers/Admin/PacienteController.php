<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPacienteRequest;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Paciente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PacienteController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('paciente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pacientes = Paciente::all();

        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        abort_if(Gate::denies('paciente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pacientes.create');
    }

    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->all());

        foreach ($request->input('documento', []) as $file) {
            $paciente->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documento');
        }

        return redirect()->route('admin.pacientes.index');
    }

    public function edit(Paciente $paciente)
    {
        abort_if(Gate::denies('paciente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pacientes.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());

        if (count($paciente->documento) > 0) {
            foreach ($paciente->documento as $media) {
                if (!in_array($media->file_name, $request->input('documento', []))) {
                    $media->delete();
                }
            }
        }

        $media = $paciente->documento->pluck('file_name')->toArray();

        foreach ($request->input('documento', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $paciente->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documento');
            }
        }

        return redirect()->route('admin.pacientes.index');
    }

    public function show(Paciente $paciente)
    {
        abort_if(Gate::denies('paciente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pacientes.show', compact('paciente'));
    }

    public function destroy(Paciente $paciente)
    {
        abort_if(Gate::denies('paciente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paciente->delete();

        return back();
    }

    public function massDestroy(MassDestroyPacienteRequest $request)
    {
        Paciente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
