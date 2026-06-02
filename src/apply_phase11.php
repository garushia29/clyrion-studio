<?php

/**
 * apply_phase11.php - One-shot migration & seed script
 *
 * Crea la tabla `services`, registra la migración en el sistema
 * de Laravel y siembra los 6 servicios por defecto que reemplazan
 * los datos hardcodeados originales de la homepage.
 *
 * Uso: docker exec clyrion_app php /var/www/apply_phase11.php
 */

$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=clyrion_db', 'clyrion_user', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// --- 1. Crear la tabla services si no existe ---
$pdo->exec("
    CREATE TABLE IF NOT EXISTS services (
        id BIGSERIAL PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        description TEXT NOT NULL,
        icon VARCHAR(100) DEFAULT NULL,
        sort_order INTEGER NOT NULL DEFAULT 0,
        is_active BOOLEAN NOT NULL DEFAULT true,
        created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
        updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL
    )
");
echo "services table ready.\n";

// --- 2. Registrar la migración en la tabla de Laravel ---
$stmt = $pdo->query("SELECT COUNT(*) FROM migrations WHERE migration = '2026_06_01_000001_create_services_table'");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO migrations (migration, batch) VALUES ('2026_06_01_000001_create_services_table', (SELECT COALESCE(MAX(batch), 0) + 1 FROM migrations))");
    echo "Migration registered.\n";
}

// --- 3. Sembrar los 6 servicios por defecto (solo si la tabla está vacía) ---
$count = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
if ($count == 0) {
    $defaults = [
        ['Fullstack Development', 'fullstack-development', 'Aplicaciones web modernas con Laravel, Livewire y TailwindCSS', 'code', 0],
        ['Enterprise Systems', 'enterprise-systems', 'Sistemas escalables para empresas, trazabilidad y gestión', 'server', 1],
        ['Process Automation', 'process-automation', 'Automatización de procesos con arquitecturas robustas', 'cog', 2],
        ['Infrastructure', 'infrastructure', 'DevOps, Docker, VPS, CI/CD y despliegue en producción', 'cloud', 3],
        ['Tech Consulting', 'tech-consulting', 'Consultoría en arquitectura, stack tecnológico y mejores prácticas', 'lightbulb', 4],
        ['AI Integrations', 'ai-integrations', 'Integración de inteligencia artificial en sistemas existentes', 'cpu', 5],
    ];
    $stmt = $pdo->prepare("INSERT INTO services (title, slug, description, icon, sort_order, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, true, NOW(), NOW())");
    foreach ($defaults as $s) {
        $stmt->execute($s);
    }
    echo "Default services seeded.\n";
} else {
    echo "Services already seeded ($count found).\n";
}

echo "Done!\n";
