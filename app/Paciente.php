<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Laravelista\Comments\Commentable;

class Paciente extends Model implements HasMedia
{
    use Commentable;

    use SoftDeletes, HasMediaTrait;

    public $table = 'pacientes';

    protected $appends = [
        'documento',
    ];

    protected $dates = [
        'nascimento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const SEXO_RADIO = [
        'masculino' => 'Masculino',
        'feminino'  => 'Feminino',
    ];

    protected $fillable = [
        'cep',
        'nome',
        'sexo',
        'email',
        'bairro',
        'cidade',
        'estado',
        'endereco',
        'nascimento',
        'created_at',
        'updated_at',
        'deleted_at',
        'observacoes',
        'fone_pessoal',
        'fone_comercial',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'paciente_id', 'id');
    }

    public function getNascimentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setNascimentoAttribute($value)
    {
        $this->attributes['nascimento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocumentoAttribute()
    {
        return $this->getMedia('documento');
    }
}
