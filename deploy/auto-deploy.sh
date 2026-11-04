#!/usr/bin/env bash
# Rilis otomatis: cek apakah branch ini tertinggal dari origin, dan kalau ya jalankan deploy.sh.
# Dipasang lewat cron (lihat deploy/README.md). Tidak melakukan apa-apa bila tidak ada commit baru,
# jadi aman dijalankan tiap beberapa menit.
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
LOG=/var/log/digital-book-deploy.log
LOCK=/var/run/digital-book-deploy.lock

exec 9>"$LOCK"
flock -n 9 || exit 0   # rilis sebelumnya masih jalan

cd "$APP_DIR"
git config --global --add safe.directory "$APP_DIR" 2>/dev/null || true

BRANCH="$(git rev-parse --abbrev-ref HEAD)"
git fetch --quiet origin "$BRANCH"
LOCAL="$(git rev-parse HEAD)"
REMOTE="$(git rev-parse "origin/$BRANCH")"
[ "$LOCAL" = "$REMOTE" ] && exit 0

{
  echo "=============================================================="
  echo "$(date '+%Y-%m-%d %H:%M:%S') commit baru di origin/$BRANCH: ${LOCAL:0:7} -> ${REMOTE:0:7}"
  if "$APP_DIR/deploy/deploy.sh"; then
    echo "$(date '+%Y-%m-%d %H:%M:%S') rilis berhasil"
  else
    echo "$(date '+%Y-%m-%d %H:%M:%S') RILIS GAGAL — aplikasi dibiarkan pada versi yang jalan sebelumnya"
  fi
} >> "$LOG" 2>&1
