<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('document_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('document_steps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::create('document_type_step', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('step_id');
            $table->unsignedInteger('order');

            $table->unique(['type_id', 'order']);
            $table->unique(['type_id', 'step_id']);
            $table->foreign('type_id')->references('id')->on('document_types')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('step_id')->references('id')->on('document_steps')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('document_versions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('type_id');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('type_id')->references('id')->on('document_types')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_form_element', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('version_id');
            $table->string('title');
            $table->string('type', 64);
            $table->longText('default_value')->nullable();
            $table->json('data')->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('version_id')->references('id')->on('document_versions')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('version_id');
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->json('data');
            $table->boolean('is_draft')->default(0);
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('document_types')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('version_id')->references('id')->on('document_versions')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('document_categories')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_members', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('document_id')->references('id')->on('documents')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('organization_user')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_step_users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('document_id')->references('id')->on('documents')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('organization_user')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_approvals', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('is_passed');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('document_id')->references('id')->on('documents')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('organization_user')
                ->onUpdate('restrict')->onDelete('cascade');
        });

        Schema::create('document_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('data');
            $table->bigInteger('children_of')->unsigned()->nullable();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('document_id')->references('id')->on('documents')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('organiation_user')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('children_of')->references('id')->on('document_comments')
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
        Schema::dropIfExists('document_comments');
        Schema::dropIfExists('document_approvals');
        Schema::dropIfExists('document_step_users');
        Schema::dropIfExists('document_members');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_form_element');
        Schema::dropIfExists('document_versions');
        Schema::dropIfExists('document_categories');
        Schema::dropIfExists('document_type_step');
        Schema::dropIfExists('document_steps');
        Schema::dropIfExists('document_types');
    }
}
