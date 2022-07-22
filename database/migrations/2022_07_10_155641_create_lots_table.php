<?php

use App\Models\Lots;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('num')->nullable();
            $table->string('author')->nullable();
            $table->decimal('low_estimate', '8', '2');
            $table->decimal('high_estimate', '8', '2');
            $table->decimal('starting_price', '8', '2');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', Lots::STAUTUSES)->default(Lots::STAUTUSES[0]);
            $table->enum('buy_status', Lots::BUY_STAUTSES)->nullable();
            $table->unsignedBigInteger('consigner_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('consigner_id')->references('id')->on('consigners')->onDelete('set null');
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
        Schema::dropIfExists('lots');
    }
}
