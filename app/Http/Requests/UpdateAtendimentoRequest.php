<?php

namespace App\Http\Requests;

use App\Atendimento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAtendimentoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('atendimento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'paciente_id'  => [
                'required',
                'integer',
            ],
            'procedimento' => [
                'required',
            ],
            'data'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'hora'         => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'duracao'      => [
                'required',
            ],
        ];
    }
}
