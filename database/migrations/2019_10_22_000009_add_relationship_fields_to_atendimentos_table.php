<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAtendimentosTable extends Migration
{
    public function up()
    {
        Schema::table('atendimentos', function (Blueprint $table) {
            $table->unsignedInteger('paciente_id');

            $table->foreign('paciente_id', 'paciente_fk_464797')->references('id')->on('pacientes');
        });
    }
}
