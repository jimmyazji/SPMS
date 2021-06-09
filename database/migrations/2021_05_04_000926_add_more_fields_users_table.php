<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name');
            $table->unsignedInteger('stdsn')->nullable();
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->foreign('dept_id')->references('id')
            ->on('depts')
            ->onDelete('set null');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')
            ->on('groups')
            ->onDelete('SET NULL');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('stsn');
            $table->dropColumn('dept_id');
            $table->dropColumn('group_id');
            });
    }
}
