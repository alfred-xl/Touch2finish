<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::create('quote_requests', function (Blueprint $table) {
        $table->id(); $table->string('reference')->unique(); $table->string('name',120); $table->string('email')->index();
        $table->string('phone',30); $table->string('postcode',20)->index(); $table->string('service_slug')->index(); $table->string('service_title');
        $table->date('preferred_date')->nullable(); $table->string('preferred_contact_method',20); $table->text('message');
        $table->json('service_details')->nullable(); $table->string('status')->default('new');
        $table->string('notification_status')->default('pending'); $table->text('notification_error')->nullable();
        $table->timestamp('consent_at'); $table->string('ip_address',45)->nullable(); $table->text('user_agent')->nullable(); $table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('quote_requests'); }
};
