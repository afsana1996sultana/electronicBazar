<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->contrained('users')->onDelete('cascade');
            $table->string('shop_name', 150)->nullable();
            $table->string('slug', 150)->nullable();
            $table->string('fb_url', 100)->default('#');
            $table->string('bank_account', 80)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('holder_name', 100)->nullable();
            $table->string('branch_name', 50)->nullable();
            $table->string('routing_name', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('commission', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('shop_profile')->nullable();
            $table->string('shop_cover')->nullable();
            $table->string('nid')->nullable();
            $table->string('trade_license')->nullable();
            $table->integer('created_by')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
