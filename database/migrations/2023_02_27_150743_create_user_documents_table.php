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
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('document_id');
            $table->smallInteger('is_activate')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Index
            $table->index('user_id', 'user_document_user_idx');
            $table->index('document_id', 'user_document_document_idx');

            // Foreign Key
            $table->foreign('user_id', 'user_document_user_fk')->on('users')->references('id');
            $table->foreign('document_id', 'user_document_document_fk')->on('documents')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
};
