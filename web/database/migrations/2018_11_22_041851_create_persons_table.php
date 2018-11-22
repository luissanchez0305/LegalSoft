<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_clientId'); // todo
            $table->foreign('type_clientId')->references('id')->on('types_client');
            $table->string('name');
            $table->string('last_name');
            $table->integer('country_birthId');
            $table->foreign('country_birthId')->references('id')->on('countries');
            $table->integer('country_residenceId');
            $table->foreign('country_residenceId')->references('id')->on('countries');
            $table->integer('country_nationalityId');
            $table->foreign('country_nationalityId')->references('id')->on('countries');
            $table->integer('genderId'); // todo
            $table->foreign('genderId')->references('id')->on('genders');

            $table->string('address_physical');
            $table->string('address_mail');
            $table->string('email');
            $table->string('phone_fixed');
            $table->string('phone_mobile');
            $table->string('ocuppation');
            $table->integer('final_recipientId');
            $table->boolean('is_pep');
            $table->boolean('is_pep_family');
            $table->boolean('activity_financial');
            $table->integer('country_activity_financialId');
            $table->foreign('country_activity_financialId')->references('id')->on('countries');
            $table->integer('annual_income_lower_limit');
            $table->integer('annual_income_higher_limit');
            $table->integer('legacy_lower_limit');
            $table->integer('legacy_higher_limit');
            $table->integer('productId');// todo
            $table->foreign('productId')->references('id')->on('types_product');
            $table->integer('legal_structureId');// todo
            $table->foreign('legal_structureId')->references('id')->on('types_legal_structure');
            $table->string('ruc');
            $table->integer('agent_dwellsId'); //todo
            $table->foreign('agent_dwellsId')->references('id')->on('types_agent_dwell');
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
