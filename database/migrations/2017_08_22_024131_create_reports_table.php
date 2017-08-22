<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("reporter_id")->unsigned();     // User who is reporting
            $table->integer("user_id")->unsigned();         // User in the fault
            $table->string("reason");                       // Reason reporter is reporting
            $table->timestamps();
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign("reporter_id")->references("id")->on("users");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
