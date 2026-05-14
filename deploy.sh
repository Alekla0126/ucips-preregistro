#!/bin/bash
# Deploy UCIPS Preregistro → plataformaucips.com/preregistro
# Uso: bash deploy.sh

SERVER="root@161.97.92.90"
REMOTE_PATH="/var/www/html/preregistro"

echo "🚀 Desplegando a $SERVER:$REMOTE_PATH"

# Sincronizar archivos (excluye la base de datos y archivos locales)
rsync -avz --progress \
  --exclude='data/' \
  --exclude='.git/' \
  --exclude='.DS_Store' \
  --exclude='*.db' \
  --exclude='deploy.sh' \
  ./ "$SERVER:$REMOTE_PATH/"

echo ""
echo "✅ Archivos sincronizados."
echo ""
echo "📋 Configurando permisos en el servidor…"

ssh "$SERVER" bash <<'REMOTE'
  RPATH="/var/www/html/preregistro"

  # Crear directorio de datos si no existe
  mkdir -p "$RPATH/data"

  # Permisos correctos
  find "$RPATH" -type f -exec chmod 644 {} \;
  find "$RPATH" -type d -exec chmod 755 {} \;
  chmod 750 "$RPATH/data"

  # PHP debe poder escribir en data/
  chown -R www-data:www-data "$RPATH/data" 2>/dev/null || \
  chown -R apache:apache     "$RPATH/data" 2>/dev/null || \
  chmod 777 "$RPATH/data"

  echo "✅ Permisos configurados."
  echo "🌐 Sitio disponible en: http://161.97.92.90/preregistro"
REMOTE

echo ""
echo "🎉 ¡Deploy completado!"
echo "   → http://161.97.92.90/preregistro"
echo "   → https://plataformaucips.com/preregistro"
