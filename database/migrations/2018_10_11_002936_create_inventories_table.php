<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('p_name')->nullable();
            $table->string('p_owner')->nullable();
            $table->string('Country')->nullable();
            $table->string('total_budget')->nullable();
            $table->string('get_budget')->nullable();
            $table->string('ramain_budget')->nullable();
            $table->string('start_time')->nullable();
            $table->string('deadline')->nullable();
            $table->string('meeting')->nullable();
            // $table->string('type')->nullable();
            $table->uuid('category_id')->nullable();
            // $table->uuid('tax_id')->nullable();
            $table->uuid('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
