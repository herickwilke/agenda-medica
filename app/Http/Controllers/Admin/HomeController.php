<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Paciente;
use App\Atendimento;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public $sources = [
        [
            'modelAtendimento'      => '\\App\\Atendimento',
            'modelPaciente'         => '\\App\\Paciente',
            'date_field' => 'data',
            'field'      => 'data',
            'prefix'     => 'Atendimento',
            'suffix'     => '',
            'route'      => 'admin.atendimentos.edit',
        ],
    ];
    
    public function index()
    {
        $events = [];
        $pacientes = Paciente::All();
        $duracoes = Atendimento::DURACAO_SELECT;
        $procedimentos = Atendimento::PROCEDIMENTO_SELECT;
        
        foreach ($this->sources as $source) {
            foreach ($source['modelAtendimento']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $comment = DB::select(
                    'SELECT
                        b.comment
                    FROM atendimentos a
                        JOIN comments b
                        ON b.commentable_id = a.id
                    WHERE b.commentable_id = '. $model->id .'');

                $comments[0]['comment'] = json_decode(json_encode($comment), True);
                
                $paciente = $source['modelPaciente']::find($model->paciente_id);

                $events[] = [
                    'id' => $model->id,
                    'nome' => $paciente['nome'],
                    'data' => $model->data,
                    'hora' => $model->hora,
                    'observacao' => $model->observacoes,
                    'procedimento' => $model->procedimento,
                    'comentarios' => $comments[0]['comment'] ? $comments[0]['comment'] : null,
                    'duracao' => $model->duracao,
                    'title' => trim(date('H:i', strtotime($model->hora)) . " - " . $paciente['nome']),
                    'start' => $crudFieldValue
                ];
            }
        }

        $settings1 = [
            'chart_title'           => 'Prontuários',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Atendimento',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where(
                        $settings1['filter_field'],
                        '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Pacientes',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Paciente',
            'group_by_field'        => 'nascimento',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where(
                        $settings2['filter_field'],
                        '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Prontuários no mês',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Atendimento',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'month',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where(
                        $settings3['filter_field'],
                        '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Novos prontuários na semana',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Atendimento',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'week',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings4['total_number'] = 0;

        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where(
                        $settings4['filter_field'],
                        '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings4['aggregate_function'] ?? 'count'}($settings4['aggregate_field'] ?? '*');
        }

        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4', 
                    'events', 'pacientes', 'duracoes', 'procedimentos'));
    }
}
