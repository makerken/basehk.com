<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('font')->nullable()->default('"Didact Gothic", sans-serif;');
            $table->string('sample')->nullable();
            $table->smallInteger('sample_size')->nullable();
            $table->smallInteger('auto_time')->nullable();
            $table->boolean('autoadvance')->nullable()->default(true);
            $table->boolean('shuffle')->nullable()->default(true);
            $table->char('background_color',7)->nullable();
            $table->char('text_color',7)->nullable();
            $table->decimal('letter_spacing',4,3)->nullable();
            $table->decimal('text_size',3,1)->nullable();
            $table->decimal('position_y',4,2)->nullable();
            $table->unsignedBigInteger('active_list_num')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefs');
    }
}
