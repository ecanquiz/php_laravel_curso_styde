<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessionIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profession');
            //$table->unsignedInteger('profession_id')->after('password'); //(it can also be done like this)
            //$table->integer('profession_id')->unsigned()->after('password'); // both options are valid
            $table->integer('profession_id')->unsigned()->after('id');
            $table->foreign('profession_id')->references('id')->on('professions');
            
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
            $table->dropForeign(['profession_id']);
            // Another way: $table->dropForeign('profession_id_foreign'); 
            // being 'profession_id_foreign' the name that mysql gives to the restriction
            $table->dropColumn('profession_id');
            $table->string('profession', 50)->nullable()->after('password');            
        });
    }
}


