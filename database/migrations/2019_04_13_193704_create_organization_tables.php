<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('organization_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
        });

        Schema::create('organization_categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('description')->nullable();
            $table->string('slogan', 128)->nullable();
            $table->string('logo_path')->nullable();
            $table->datetime('allowed_at')->nullable();
            $table->datetime('expired_at')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('type_id')->references('id')->on('organization_types')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('organization_categories')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('organization_user_levels', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 128);
        });

        Schema::create('organization_user', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('level_id');
            $table->datetime('allowed_at')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('organization_user_levels')
                ->onUpdate('restrict')->onDelete('cascade');  
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_user');
        Schema::dropIfExists('organization_user_levels');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('organization_categories');
        Schema::dropIfExists('organization_types');
    }
}
