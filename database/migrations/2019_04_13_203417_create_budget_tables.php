<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->year('edu_year');
            $table->float('amount');
            $table->float('remaining_amount');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('organization_budget', function (Blueprint $table) {
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('budget_id');
            $table->float('amount');
            $table->float('remaining_amount');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['organization_id', 'budget_id']);
            $table->foreign('organization_id')->references('id')->on('organizations')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budgets')
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
        Schema::dropIfExists('organization_budget');
        Schema::dropIfExists('budgets');
    }
}
