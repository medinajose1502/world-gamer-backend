<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EsperoQueEstoSirva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amistads', function (Blueprint $table) {
        });

        Schema::table('comentarios', function (Blueprint $table) {
        });

        Schema::table('etiqueta_publicacions', function (Blueprint $table) {
        });

        Schema::table('etiquetas', function (Blueprint $table) {
        });

        Schema::table('favoritos', function (Blueprint $table) {
        });

        Schema::table('me_gustas', function (Blueprint $table) {
        });

        Schema::table('mensajes', function (Blueprint $table) {
        });

        Schema::table('notificacions', function (Blueprint $table) {
        });

        Schema::table('publicacions', function (Blueprint $table) {
        });

        Schema::table('users', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
