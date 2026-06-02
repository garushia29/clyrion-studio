<?php

/**
 * Migration: Create page_views table.
 *
 * Almacena cada visita a las páginas públicas para el sistema
 * de analytics. Cada registro contiene la ruta visitada, referente,
 * agente de usuario, IP y un identificador único de visitante
 * (hash de IP + user agent) para contar visitantes únicos sin
 * almacenar datos personales.
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('referer')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('visitor_id', 64)->nullable()->index();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
