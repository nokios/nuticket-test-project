<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->dateTime('checked_out_at')
                ->index('IX_checkouts-checked_out_at');
            $table->dateTime('returned_at')
                ->nullable()
                ->index('IX_checkouts-returned_at');
            $table->timestamps();

            $table->foreign('book_id', 'FK_checkouts-books')
                ->references('id')
                ->on('books');
            
            $table->foreign('user_id', 'FK_checkouts-users')
                ->references('id')
                ->on('users');

            $table->foreign('city_id', 'FK_checkouts-city')
                ->references('id')
                ->on('cities');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
};
