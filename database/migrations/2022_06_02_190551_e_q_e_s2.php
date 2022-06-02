<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EQES2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Esperemos que esto sirva...
        Schema::table('amistads', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->biginteger('amigo_id');
            $table->string('estado',1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('amigo_id')->references('id')->on('users');
        });

        Schema::table('comentarios', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->biginteger('publicacion_id');
            $table->text('descripcion');
            $table->string('estado',1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('publicacion_id')->references('id')->on('publicacions');
        });

        Schema::table('etiqueta_publicacions', function (Blueprint $table) {
            $table->bigInteger('publicacion_id');
            $table->bigInteger('etiqueta_id');
            $table->foreign('publicacion_id')->references('id')->on('publicacions');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas');
        });

        Schema::table('etiquetas', function (Blueprint $table) {
            $table->string('etiqueta',60);
            $table->string('estado',1);
        });

        Schema::table('favoritos', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->biginteger('publicacion_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('publicacion_id')->references('id')->on('publicacions');
        });

        Schema::table('me_gustas', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->biginteger('publicacion_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('publicacion_id')->references('id')->on('publicacions');
        });

        Schema::table('mensajes', function (Blueprint $table) {
            $table->bigInteger('user_id_desde');
            $table->bigInteger('user_id_para');
            $table->text('mensaje');
            $table->string('estado',1);
            $table->foreign('user_id_desde')->references('id')->on('users');
            $table->foreign('user_id_para')->references('id')->on('users');
        });

        Schema::table('notificacions', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->text('contenido');
            $table->string('link',255);
            $table->string('estado',1);
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('publicacions', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->bigInteger('nro_likes');
            $table->bigInteger('nro_comentarios');
            $table->boolean('isLiked');
            $table->boolean('isFavorite');
            $table->string('estado',1);
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('telefono',20);
            $table->text('direccion');
            $table->text('gustos');
            $table->string('imagen',255);
            $table->string('estado',1);
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
