<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationClientShareholderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('relation_client_shareholder', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clientId');
            $table->foreign('clientId')->references('id')->on('persons');
            $table->integer('client_relatedId');
            $table->foreign('client_relatedId')->references('id')->on('persons');
            $table->integer('types_shareId');
            $table->foreign('types_shareId')->references('id')->on('types_share');
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
