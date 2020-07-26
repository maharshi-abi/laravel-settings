<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('settings.table', 'settings'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->index();
            $table->enum('type', ['BOOLEAN', 'NUMBER', 'DATE', 'TEXT', 'SELECT', 'FILE', 'TEXTAREA']);
            $table->string('label');
            $table->longText('value')->nullable();
            $table->boolean('hidden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('settings.table', 'settings'));
    }
}
