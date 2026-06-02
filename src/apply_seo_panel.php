<?php

/**
 * apply_seo_panel.php - SEO settings migration & seed
 *
 * Crea la tabla seo_settings, registra la migración en el sistema
 * de Laravel y siembra configuraciones SEO por defecto para las
 * rutas públicas principales.
 *
 * Uso: docker exec clyrion_app php /var/www/apply_seo_panel.php
 */

$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=clyrion_db', 'clyrion_user', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// --- 1. Crear la tabla seo_settings si no existe ---
$pdo->exec("
    CREATE TABLE IF NOT EXISTS seo_settings (
        id BIGSERIAL PRIMARY KEY,
        page_route VARCHAR(100) NOT NULL UNIQUE,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(500) DEFAULT NULL,
        type VARCHAR(50) NOT NULL DEFAULT 'website',
        is_active BOOLEAN NOT NULL DEFAULT true,
        created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
        updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL
    )
");
echo "seo_settings table ready.\n";

// --- 2. Registrar migración ---
$stmt = $pdo->query("SELECT COUNT(*) FROM migrations WHERE migration = '2026_06_01_000003_create_seo_settings_table'");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO migrations (migration, batch) VALUES ('2026_06_01_000003_create_seo_settings_table', (SELECT COALESCE(MAX(batch), 0) + 1 FROM migrations))");
    echo "Migration registered.\n";
}

// --- 3. Sembrar defaults ---
$defaults = [
    ['home', 'Clyrion Studio | JIMMY — Building scalable digital solutions', 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.', null, 'website'],
    ['about', 'Sobre mí | Clyrion Studio — JIMMY', 'Conoce más sobre mi trayectoria como Software Engineer & Fullstack Developer.', null, 'profile'],
    ['projects.index', 'Portafolio | Clyrion Studio — JIMMY', 'Proyectos destacados en desarrollo web, sistemas empresariales y automatización.', null, 'website'],
    ['blog.index', 'Blog | Clyrion Studio — JIMMY', 'Artículos técnicos sobre Laravel, Livewire, arquitecturas backend y mejores prácticas.', null, 'website'],
    ['tutorials.index', 'Tutoriales | Clyrion Studio — JIMMY', 'Tutoriales prácticos de programación, desde nivel principiante hasta avanzado.', null, 'website'],
];

$inserted = 0;
$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM seo_settings WHERE page_route = ?");
$stmtInsert = $pdo->prepare("INSERT INTO seo_settings (page_route, title, description, image, type, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, true, NOW(), NOW())");

foreach ($defaults as $s) {
    $stmtCheck->execute([$s[0]]);
    if ($stmtCheck->fetchColumn() == 0) {
        $stmtInsert->execute($s);
        $inserted++;
        echo "Inserted: {$s[0]}\n";
    } else {
        echo "Already exists: {$s[0]}\n";
    }
}

echo "Done! $inserted SEO setting(s) inserted.\n";
