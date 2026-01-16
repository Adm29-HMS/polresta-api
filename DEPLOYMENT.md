# Polresta API - Laravel Backend

Backend API untuk sistem Polresta Sorong Kota.

## 🚀 Deployment

### Deploy ke Hostinger (Automated via GitHub Actions)

1. Push ke GitHub:
```bash
git add .
git commit -m "Update API"
git push origin main
```

2. GitHub Actions akan otomatis deploy ke Hostinger via SSH

### GitHub Secrets Required

Tambahkan di GitHub Repository → Settings → Secrets:

| Secret Name | Description |
|-------------|-------------|
| `SSH_HOST` | Hostname SSH Hostinger |
| `SSH_PORT` | Port SSH (biasanya 65002) |
| `SSH_USERNAME` | Username SSH |
| `SSH_PASSWORD` | Password SSH |
| `DEPLOY_PATH` | Path ke public_html |

### Environment Variables (di Hostinger)

Edit file `.env` di server:

```env
APP_URL=https://api.polrestasorongkota.com
DB_HOST=localhost
DB_DATABASE=u123456789_polresta_db
DB_USERNAME=u123456789_polresta_user
DB_PASSWORD=YOUR_PASSWORD
SANCTUM_STATEFUL_DOMAINS=polrestasorongkota.com,tbnews.polrestasorongkota.com,admin.polrestasorongkota.com
CORS_ALLOWED_ORIGINS=https://polrestasorongkota.com,https://tbnews.polrestasorongkota.com,https://admin.polrestasorongkota.com
```

### Domain
- Production: `api.polrestasorongkota.com`

## 📦 Development

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Run dev server
php artisan serve
```

## 🔄 Manual Deployment

Jika perlu deploy manual via SSH:

```bash
# SSH ke server
ssh u123456789@ssh.hostinger.com -p 65002

# Masuk ke folder
cd public_html

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
```

## 🔗 Links

- [GitHub Actions](https://github.com/USERNAME/polresta-api/actions)
- [GitHub Repository](https://github.com/USERNAME/polresta-api)
- [Hostinger hPanel](https://hpanel.hostinger.com)

## 📚 API Documentation

API endpoints tersedia di:
- Health Check: `GET /api/health`
- Berita: `GET /api/berita`
- Kategori: `GET /api/kategori`
- Dan lainnya...
