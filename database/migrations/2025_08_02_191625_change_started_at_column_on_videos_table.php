<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStartedAtColumnOnVideosTable extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dateTime('started_at')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('started_at')->nullable()->change(); // jika sebelumnya string
        });
    }
}
