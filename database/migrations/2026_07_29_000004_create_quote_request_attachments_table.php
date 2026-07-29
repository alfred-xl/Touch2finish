<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::create('quote_request_attachments', function (Blueprint $table) {
        $table->id(); $table->foreignId('quote_request_id')->constrained()->cascadeOnDelete(); $table->string('original_name');
        $table->string('stored_path'); $table->string('disk',50); $table->string('mime_type',100); $table->unsignedBigInteger('file_size'); $table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('quote_request_attachments'); }
};
