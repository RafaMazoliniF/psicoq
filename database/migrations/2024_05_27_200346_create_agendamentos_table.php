<?php

use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Paciente::class)->onDelete('cascade');
            #$table->foringIdFor(Psicologo::class)->onDelete('cascade');
            #$table->longText('anotacao')->nullable();
            $table->date('data');
            $table->time('hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
};
