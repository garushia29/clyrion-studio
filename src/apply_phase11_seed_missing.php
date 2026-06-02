<?php

/**
 * apply_phase11_seed_missing.php
 *
 * Agrega 3 servicios faltantes al seed de servicios:
 * Traceability Systems, SaaS Development, Laravel Enterprise Solutions.
 *
 * Uso: docker exec clyrion_app php /var/www/apply_phase11_seed_missing.php
 */

$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=clyrion_db', 'clyrion_user', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$missing = [
    ['Traceability Systems', 'traceability-systems', 'Sistemas de trazabilidad para cadenas de suministro, lotes, tracking y control de calidad.', 'database', 6],
    ['SaaS Development', 'saas-development', 'Desarrollo de aplicaciones SaaS multi-tenant con arquitecturas modernas y escalables.', 'globe', 7],
    ['Laravel Enterprise Solutions', 'laravel-enterprise-solutions', 'Soluciones empresariales robustas con Laravel: ERP, CRM, módulos contables y más.', 'shield', 8],
];

$inserted = 0;
$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM services WHERE slug = ?");
$stmtInsert = $pdo->prepare("INSERT INTO services (title, slug, description, icon, sort_order, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, true, NOW(), NOW())");

foreach ($missing as $s) {
    $stmtCheck->execute([$s[1]]);
    if ($stmtCheck->fetchColumn() == 0) {
        $stmtInsert->execute($s);
        $inserted++;
        echo "Inserted: {$s[0]}\n";
    } else {
        echo "Already exists: {$s[0]}\n";
    }
}

echo "Done! $inserted service(s) inserted.\n";
