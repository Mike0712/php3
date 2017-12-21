<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
        DB::table('roles')->insert(
            [
                'title' => 'admin',
            ]);
        DB::table('roles')->insert(
            [
                'title' => 'user',
            ]);
        Schema::create('user_role', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');
        });
        DB::table('user_role')->insert(
            [
                'user_id' => \App\User::where('name', '=', 'FirstUser')->first()->id,
                'role_id' => \App\Role::where('title', '=', 'admin')->first()->id,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_role');
    }
}
