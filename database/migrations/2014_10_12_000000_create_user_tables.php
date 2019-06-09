<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 32)->unique();
            $table->string('password', 255);
            $table->rememberToken();
            $table->datetime('deleted_at')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('user_data', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('first_name', 64);
            $table->string('middle_name', 64)->nullable();
            $table->string('last_name', 64);
            $table->string('first_name_th', 64)->nullable();
            $table->string('middle_name_th', 64)->nullable();
            $table->string('last_name_th', 64)->nullable();
            $table->string('student_id', 11)->nullable()->unique();
            $table->string('study_major_code', 9)->nullable(); 
            $table->decimal('score_gpa', 4, 2)->unsigned()->nullable();
            $table->string('activity_experience')->nullable();
            $table->string('addr_street_1')->nullable();
            $table->string('addr_street_2')->nullable();
            $table->string('addr_sub_district', 64);
            $table->string('addr_district', 64);
            $table->string('addr_state', 64);
            $table->string('addr_postal_code', 16);
            $table->string('addr_country', 64)->nullable();
            $table->string('tel_no', 15)->nullable();
            $table->string('email');
            $table->string('image_path_official')->nullable();
            $table->string('image_path_profile')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('user_data');
        Schema::dropIfExists('users');
    }
}
