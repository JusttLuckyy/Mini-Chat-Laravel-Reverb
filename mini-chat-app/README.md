# 💬 Mini Chat Real-Time — Laravel + Reverb

> Tugas Praktikum · Pemrograman Berbasis Web

Aplikasi mini chat real-time yang dibangun menggunakan **Laravel**, **Laravel Reverb** (WebSocket), dan **Laravel Echo**. Pengguna dapat saling berkirim pesan secara real-time tanpa perlu refresh halaman.

---

## ✨ Fitur

- 🔐 **Autentikasi** — Register & Login menggunakan Laravel Breeze
- 💬 **Chat Real-Time** — Pesan terkirim & diterima tanpa refresh halaman
- 🗄️ **Pesan Tersimpan** — Semua pesan disimpan ke database
- 🟢 **Indikator Online/Offline** — Menampilkan status user secara real-time
- ✍️ **Typing Indicator** — Animasi titik-titik saat user sedang mengetik
- 🔔 **Badge Notifikasi** — Notifikasi pesan baru saat chat ditutup
- 📱 **Sidebar Chat** — Chat popup terintegrasi di sidebar dashboard
- 🫧 **Bubble WhatsApp Style** — Tampilan bubble chat bergaya WhatsApp

---

## 🛠️ Tech Stack

| Teknologi | Keterangan |
|---|---|
| **Laravel 11** | PHP Framework |
| **Laravel Reverb** | WebSocket Server (self-hosted) |
| **Laravel Echo** | WebSocket Client |
| **Laravel Breeze** | Authentication Scaffolding |
| **Pusher JS** | WebSocket Protocol |
| **Vite** | Frontend Build Tool |
| **MySQL** | Database |

---

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/JusttLuckyy/Mini-Chat-Laravel-Reverb.git
cd Mini-Chat-Laravel-Reverb
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuaikan database dan Reverb:

```env
DB_DATABASE=mini_chat_app
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_CONNECTION=reverb
REVERB_APP_ID=your-app-id
REVERB_APP_KEY=your-app-key
REVERB_APP_SECRET=your-app-secret
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http
```

### 4. Migrate Database

```bash
php artisan migrate
```

### 5. Build Assets

```bash
npm run build
```

---

## 🚀 Menjalankan Aplikasi

Buka **4 terminal** dan jalankan masing-masing:

```bash
# Terminal 1 — Laravel
php artisan serve

# Terminal 2 — Reverb WebSocket Server
php artisan reverb:start

# Terminal 3 — Queue Worker
php artisan queue:listen

# Terminal 4 — Vite (development)
npm run dev
```

Buka browser ke:
```
http://localhost:8000
```

---

## 📁 Struktur Utama

```
app/
├── Events/
│   └── MessageSent.php       # Broadcast event
├── Http/Controllers/
│   └── ChatController.php    # Handler chat
├── Models/
│   └── Message.php           # Model pesan
resources/
├── js/
│   ├── app.js                # Entry point JS
│   ├── echo.js               # Konfigurasi Echo + Reverb
│   └── bootstrap.js          # Axios setup
├── views/
│   ├── layouts/
│   │   └── app.blade.php     # Layout utama + sidebar + chat popup
│   └── dashboard.blade.php   # Halaman dashboard
routes/
├── web.php                   # Route aplikasi
└── channels.php              # Presence channel
```

---

## 👤 Author

**JusttLuckyy** · Sistem Informasi

---

## 📄 License

MIT License
