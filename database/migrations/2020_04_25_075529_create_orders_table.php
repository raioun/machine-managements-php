<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('out_date');
            $table->string('out_time')->nullable();
            $table->date('in_date');
            $table->string('in_time')->nullable();
            $table->integer('status')->default(0); //limit(1)一旦未記入 null(false)も一旦未記入
            $table->integer('project_id');
            $table->integer('orderer_id');
            $table->integer('rental_machine_id');
            $table->integer('user_id');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
