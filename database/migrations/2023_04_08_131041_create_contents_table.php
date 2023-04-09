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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('cover');
            $table->text('poster')->nullable();
            $table->text('overview')->nullable();
            $table->float('rating')->nullable();
            $table->string('release-date')->nullable();
            $table->string('duration')->nullable();
            $table->integer('view')->default(0);
            $table->text('trailer')->nullable();
            $table->boolean('publish')->default(0);
            $table->boolean('featured')->default(0);
            $table->boolean('premium_only')->default(0);
            $table->text('content_type');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('contents');
    }
};
