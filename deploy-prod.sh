#!/bin/bash
echo "🚀 Haciendo un git pull ..."
git pull

echo "🚀 Instalando dependencias..."
composer install

echo "🚀 Iniciando proceso de optimización para Laravel y Filament..."

# --- Limpieza de cachés existentes ---
echo "🧹 Limpiando cachés existentes..."
php artisan optimize:clear
php artisan filament:optimize-clear

# --- Optimización con comando unificado de Laravel ---
echo "⚙️  Optimizando Laravel (configuración, rutas, vistas y eventos)..."
php artisan optimize

# --- Optimización específica de Filament ---
echo "✨ Optimizando Filament (componentes e iconos)..."
php artisan filament:optimize

# --- Optimizaciones finales de la aplicación ---
echo "📦 Optimizando el cargador automático de Composer..."
composer dump-autoload --optimize --classmap-authoritative

echo "🔐 Ajustando permisos de archivos para el servidor web..."
chown -R www-data:www-data *

echo "✅ Proceso de optimización completado."
echo ""
echo "📋 Optimizaciones aplicadas:"
echo "   ✓ Configuración cacheada"
echo "   ✓ Rutas cacheadas" 
echo "   ✓ Vistas compiladas"
echo "   ✓ Eventos cacheados"
echo "   ✓ Componentes de Filament cacheados"
echo "   ✓ Iconos de Blade cacheados"
echo "   ✓ Autoloader de Composer optimizado"
echo "   ✓ Permisos de archivos ajustados para www-data"

# --- Corriendo migraciones ---
echo "✨ Aplicando migraciones..."
php artisan migrate --force