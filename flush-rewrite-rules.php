<?php
/**
 * Script temporal para hacer flush de las rewrite rules
 * Acceder a este archivo via navegador una sola vez y luego eliminarlo
 */

// Cargar WordPress
require_once(__DIR__ . '/wp-load.php');

echo "<h2>Diagnóstico de URLs Traducidas</h2>";

// Verificar que las páginas existan
$slugs = ['diagnosi', 'metodo', 'problemi', 'soluzioni', 'chi-siamo', 'contattaci', 'esperienza', 'questionario'];
echo "<h3>Páginas encontradas:</h3><ul>";
foreach ($slugs as $slug) {
    $page = get_page_by_path($slug);
    if ($page) {
        echo "<li>✓ <strong>$slug</strong> - ID: {$page->ID} - Título: {$page->post_title}</li>";
    } else {
        echo "<li>✗ <strong>$slug</strong> - NO ENCONTRADA</li>";
    }
}
echo "</ul>";

// Forzar el flush de rewrite rules
flush_rewrite_rules(true);

echo "<h3 style='color: green;'>✓ Rewrite rules regeneradas con éxito!</h3>";
echo "<p>Ahora los links traducidos deberían funcionar.</p>";
echo "<p><strong>IMPORTANTE:</strong> Elimina este archivo después de usarlo por seguridad.</p>";
echo "<p><a href='" . home_url() . "' style='padding: 10px 20px; background: #0073aa; color: white; text-decoration: none; border-radius: 5px;'>Volver a la home</a></p>";
?>
