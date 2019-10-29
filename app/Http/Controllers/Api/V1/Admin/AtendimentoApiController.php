<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Atendimento;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAtendimentoRequest;
use App\Http\Requests\UpdateAtendimentoRequest;
use App\Http\Resources\Admin\AtendimentoResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtendimentoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('atendimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtendimentoResource(Atendimento::with(['paciente'])->get());
    }

    public function store(StoreAtendimentoRequest $request)
    {
        $atendimento = Atendimento::create($request->all());

        if ($request->input('documento', false)) {
            $atendimento->addMedia(storage_path('tmp/uploads/' . $request->input('documento')))->toMediaCollection('documento');
        }

        return (new AtendimentoResource($atendimento))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Atendimento $atendimento)
    {
        abort_if(Gate::denies('atendimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtendimentoResource($atendimento->load(['paciente']));
    }

    public function update(UpdateAtendimentoRequest $request, Atendimento $atendimento)
    {
        $atendimento->update($request->all());

        if ($request->input('documento', false)) {
            if (!$atendimento->documento || $request->input('documento') !== $atendimento->documento->file_name) {
                $atendimento->addMedia(storage_path('tmp/uploads/' . $request->input('documento')))->toMediaCollection('documento');
            }
        } elseif ($atendimento->documento) {
            $atendimento->documento->delete();
        }

        return (new AtendimentoResource($atendimento))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Atendimento $atendimento)
    {
        abort_if(Gate::denies('atendimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atendimento->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
