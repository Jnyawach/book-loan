<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('book_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamp('loan_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->boolean('extended')->default(false);
            $table->timestamp('extended_date')->nullable();
            $table->integer('penalty_amount')->nullable();
            $table->string('penalty_status')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_loans');
    }
};
