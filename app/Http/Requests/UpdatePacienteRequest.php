<?php

namespace App\Http\Requests;

use App\Paciente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('paciente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nome'           => [
                'min:8',
                'max:100',
                'required',
            ],
            'nascimento'     => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'sexo'           => [
                'required',
            ],
            'fone_pessoal'   => [
                'min:7',
                'max:12',
                'required',
            ],
            // 'fone_comercial' => [
            //     'min:7',
            //     'max:12',
            // ],
            'endereco'       => [
                'min:10',
                'max:200',
                'required',
            ],
            'bairro'         => [
                'min:3',
                'max:30',
                'required',
            ],
            'cidade'         => [
                'min:4',
                'max:100',
                'required',
            ],
            'cep'            => [
                'min:8',
                'max:9',
                'required',
            ],
            'estado'         => [
                'min:2',
                'max:30',
                'required',
            ],
        ];
    }
}
