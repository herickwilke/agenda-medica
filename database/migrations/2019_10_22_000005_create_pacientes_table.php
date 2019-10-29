<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->date('nascimento');

            $table->string('sexo');

            $table->string('email')->nullable();

            $table->longText('observacoes')->nullable();

            $table->string('endereco');

            $table->string('bairro');

            $table->string('cidade');

            $table->string('estado');

            $table->string('fone_pessoal');

            $table->string('fone_comercial')->nullable();

            $table->string('cep');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
