#!/usr/bin/env bash
# Rilis DigitalBook di host ICT (192.168.1.9), dilayani di https://ict.pralon.com/digital-book.
#
#   sudo deploy/deploy.sh            # pull → build → up → composer → bersihkan cache → cek
#   sudo deploy/deploy.sh --no-pull  # tanpa git pull (pakai kode yang sudah ada di direktori ini)
#
# Dijalankan sebagai root karena berkasnya milik www-data dan docker perlu akses.
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
COMPOSE="docker compose -f docker-compose.yml -f docker-compose.prod.yml"
PORT=8088
PULL=1
[ "${1:-}" = "--no-pull" ] && PULL=0

cd "$APP_DIR"
git config --global --add safe.directory "$APP_DIR" 2>/dev/null || true

log() { printf '\n== %s\n' "$1"; }

if [ "$PULL" = 1 ]; then
  log "git pull"
  git fetch --quiet origin
  git merge --ff-only origin/"$(git rev-parse --abbrev-ref HEAD)"
  git log --oneline -1
fi

log "build image"
$COMPOSE build

log "jalankan container"
$COMPOSE up -d

log "composer (vendor/ ada di direktori ini karena bind mount menutupi vendor dari image)"
docker exec digital-book-php composer install --no-dev --optimize-autoloader --no-interaction

log "bersihkan cache"
for c in config:clear view:clear route:clear; do
  docker exec digital-book-php php artisan "$c"
done

log "izin berkas"
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

log "cek"
docker ps --filter name=digital-book --format '{{.Names}} | {{.Status}}'
code=$(curl -sS -o /dev/null -m 20 -w '%{http_code}' "http://127.0.0.1:${PORT}/" || echo 000)
echo "http://127.0.0.1:${PORT}/ -> $code"
[ "$code" = "200" ] || { echo "GAGAL: aplikasi tidak menjawab 200"; exit 1; }
echo "selesai: $(git log --oneline -1)"
