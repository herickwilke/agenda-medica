<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('procedimento');

            $table->longText('observacoes')->nullable();

            $table->date('data');

            $table->time('hora');

            $table->string('duracao');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
