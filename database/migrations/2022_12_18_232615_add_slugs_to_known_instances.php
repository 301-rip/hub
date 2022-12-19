<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugsToKnownInstances extends Migration
{
    public function up()
    {
        Schema::table('known_instances', function (Blueprint $table) {
            $table->string('slug', 10)->nullable();
        });
    }

    public function down()
    {
        Schema::table('known_instances', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
