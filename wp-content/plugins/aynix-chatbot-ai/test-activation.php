<?php
/**
 * Test de activación del plugin
 */

// Verificar si el plugin está cargado
error_log('AYNIX Chatbot: Plugin file loaded');

// Verificar si la clase existe
if (class_exists('AYNIX_Chatbot_AI')) {
    error_log('AYNIX Chatbot: Class exists');
} else {
    error_log('AYNIX Chatbot: Class does NOT exist');
}

// Verificar si hay hooks registrados
global $wp_filter;
if (isset($wp_filter['wp_enqueue_scripts'])) {
    error_log('AYNIX Chatbot: wp_enqueue_scripts hook registered');
}
if (isset($wp_filter['wp_footer'])) {
    error_log('AYNIX Chatbot: wp_footer hook registered');
}
