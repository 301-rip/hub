<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('known_instances', function (Blueprint $table) {
            $table->id();

            $table->string('domain');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('known_instances');
    }
};
