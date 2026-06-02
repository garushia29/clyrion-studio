<?php
$p = new PDO('pgsql:host=postgres;port=5432;dbname=clyrion_db', 'clyrion_user', 'secret');
echo 'Max batch: ' . $p->query('SELECT COALESCE(MAX(batch),0) FROM migrations')->fetchColumn() . "\n";
