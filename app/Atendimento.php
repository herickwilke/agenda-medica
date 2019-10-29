<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Atendimento extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'atendimentos';

    protected $appends = [
        'documento',
    ];

    protected $dates = [
        'data',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data',
        'hora',
        'duracao',
        'created_at',
        'updated_at',
        'deleted_at',
        'paciente_id',
        'observacoes',
        'procedimento',
    ];

    const PROCEDIMENTO_SELECT = [
        'geral'       => 'Clínico geral',
        'mamografia'  => 'Mamografia',
        'ressonancia' => 'Ressonância',
        'pediatria'   => 'Pediatria',
        'cirurgia'    => 'Cirurgia',
    ];

    const DURACAO_SELECT = [
        '0.15' => '15 min',
        '0.30' => '30 min',
        '0.45' => '45 min',
        '1.00' => '1 hora',
        '1.15' => '1 hora e 15 minutos',
        '1.30' => '1 hora e 30 minutos',
        '2.00' => '2 horas',
        'x'    => 'Mais..',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function getDataAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocumentoAttribute()
    {
        return $this->getMedia('documento');
    }
}
