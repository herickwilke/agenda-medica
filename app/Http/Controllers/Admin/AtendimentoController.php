<?php

namespace App\Http\Controllers\Admin;

use App\Atendimento;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAtendimentoRequest;
use App\Http\Requests\StoreAtendimentoRequest;
use App\Http\Requests\UpdateAtendimentoRequest;
use App\Paciente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtendimentoController extends Controller
{
    use MediaUploadingTrait;

    public function ajaxUpdate(Request $request)
    {
        $atendimento = Atendimento::with('paciente')->findOrFail($request->atendimento_id);

        $atendimento->update($request->all());

        return response()->json(['atendimento' => $atendimento]);
    }

    public function ajaxNew(Request $request)
    {
        $atendimento = new Atendimento();
        
        $atendimento->create($request->all());

        if (!$atendimento == false) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function ajaxUpdateDrop(Request $request) 
    {
        $atendimento = Atendimento::with('paciente')->findOrFail($request->atendimento_id);

        $atendimento->update($request->all());

        return response()->json(['atendimento' => $atendimento]);
    }

    public function index()
    {
        abort_if(Gate::denies('atendimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atendimentos = Atendimento::all();

        return view('admin.atendimentos.index', compact('atendimentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('atendimento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pacientes = Paciente::all()->pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.atendimentos.create', compact('pacientes'));
    }

    public function store(StoreAtendimentoRequest $request)
    {
        $atendimento = Atendimento::create($request->all());

        foreach ($request->input('documento', []) as $file) {
            $atendimento->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documento');
        }

        return redirect()->route('admin.atendimentos.index');
    }

    public function edit(Atendimento $atendimento)
    {
        abort_if(Gate::denies('atendimento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pacientes = Paciente::all()->pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $atendimento->load('paciente');

        return view('admin.atendimentos.edit', compact('pacientes', 'atendimento'));
    }

    public function update(UpdateAtendimentoRequest $request, Atendimento $atendimento)
    {
        $atendimento->update($request->all());

        if (count($atendimento->documento) > 0) {
            foreach ($atendimento->documento as $media) {
                if (!in_array($media->file_name, $request->input('documento', []))) {
                    $media->delete();
                }
            }
        }

        $media = $atendimento->documento->pluck('file_name')->toArray();

        foreach ($request->input('documento', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $atendimento->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documento');
            }
        }

        return redirect()->route('admin.atendimentos.index');
    }

    public function show(Atendimento $atendimento)
    {
        abort_if(Gate::denies('atendimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atendimento->load('paciente');

        return view('admin.atendimentos.show', compact('atendimento'));
    }

    public function destroy(Atendimento $atendimento)
    {
        abort_if(Gate::denies('atendimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atendimento->delete();

        return back();
    }

    public function massDestroy(MassDestroyAtendimentoRequest $request)
    {
        Atendimento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
