# 🏥 Bimkar Hospital

Aplikasi manajemen rumah sakit berbasis Laravel untuk pengelolaan data pasien, dokter, jadwal periksa, dan riwayat kunjungan.

---

## 🚀 Fitur Utama

- ✅ Autentikasi multi-role (Admin, Dokter, Pasien)
- 🩺 Manajemen data dokter & pasien
- 📆 Sistem janji periksa (booking pemeriksaan)
- 📋 Riwayat kunjungan pasien
- 🧾 Form validasi profil dan informasi pengguna
- 🔐 Keamanan login dan middleware per role

---

## 📂 Struktur Direktori Utama

```bash
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Dokter/
│   │       └── Pasien/
│   └── Requests/
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── pasien/riwayat/index.blade.php
├── routes/web.php
├── .env.example
