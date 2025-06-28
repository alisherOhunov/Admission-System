<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->string('type', 64); //'passport', 'transcript', 'diploma', 'sop', 'cv', 'english_score', 'portfolio'
            $table->string('filename', 255);
            $table->string('original_name', 255);
            $table->string('mime_type', 64);
            $table->integer('size');
            $table->string('path', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
