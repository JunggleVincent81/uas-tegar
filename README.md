# Sistem Pemesanan Makanan Berbasis Web  
**(Ujian Akhir Semester – UAS)**

---

## 👤 Identitas Mahasiswa
- **Nama** : Tegar Bagus Santoso  
- **Program Studi** : (isi sesuai prodi kamu)  
- **Mata Kuliah** : (isi sesuai mata kuliah)  
- **Dosen Pengampu** : (opsional)  

---
- Domai: https://uas.tegarbs.site
- domain Pengganti: https://dependable-fuchsia-fox.103-247-9-134.cpanel.site/login
- mohon maaf pak dikarenakan saya salah click change nameserver, jadinya untuk saat ini domain saya tidak bisa diakses kemungkinan besok senin baru dapat diakses jadi saya taruh project saya di temporery domain yg sudah saya taruh diatas sebagai domain pengganti

---

## 📌 Deskripsi Aplikasi

Aplikasi **Sistem Pemesanan Makanan Berbasis Web** ini dibuat untuk memenuhi tugas **Ujian Akhir Semester (UAS)**.  
Sistem ini dirancang untuk mensimulasikan alur pemesanan makanan di sebuah restoran, mulai dari **customer melakukan pemesanan**, **kasir melakukan konfirmasi pembayaran**, hingga **chef memproses pesanan di dapur**.

Aplikasi menerapkan konsep **role-based access control**, di mana setiap pengguna memiliki hak akses dan tampilan sistem yang berbeda sesuai perannya.

---

## 🔄 Alur & Logika Sistem

### 1️⃣ Customer
- Melihat daftar menu
- Melakukan pemesanan
- Melakukan checkout
- Sistem akan **menentukan nomor meja secara otomatis**
- Customer dapat melihat **status pesanan secara real-time**

### 2️⃣ Kasir
- Melihat daftar pesanan yang menunggu pembayaran
- Memilih metode pembayaran (Cash / QRIS / Debit)
- Mengonfirmasi pembayaran melalui **modal konfirmasi**
- Setelah pembayaran berhasil, status pesanan berubah menjadi **Paid**

### 3️⃣ Chef (Dapur)
- Melihat antrian pesanan yang sudah dibayar
- Menekan tombol **Mulai Masak** → status berubah menjadi `Cooking`
- Menekan tombol **Selesai** → status berubah menjadi `Done`
- Setelah pesanan selesai, **meja otomatis dibuka kembali (available)**

### 4️⃣ Admin
- Mengelola user dan role (Admin, Kasir, Chef, Customer)
- Melihat dashboard statistik:
  - Total user
  - Total order
  - Order hari ini
  - Meja tersedia
- Melihat grafik status order dan order 7 hari terakhir
- Monitoring order yang bermasalah (pending terlalu lama)

---

## 🧩 Teknologi yang Digunakan
- **Laravel** (Backend Framework)
- **MySQL** (Database)
- **Tailwind CSS** (UI Styling)
- **Alpine.js** (Interaksi Frontend)
- **Chart.js** (Visualisasi Data)

---

## 🔐 Akun Demo (Untuk Dosen)

Gunakan akun berikut untuk mengakses seluruh fitur sistem:

### 👨‍💼 Admin
- Email: `admin@admin.com`  
- Password: `admin123`

### 💰 Kasir
- Email: `kasir@kasir.com`  
- Password: `kasir123`

### 👨‍🍳 Chef
- Email: `chef@chef.com`  
- Password: `chef123`

### 👤 Customer
- Email: `customer@user.com`  
- Password: `user123`

> **Catatan:**  
> Informasi akun demo juga ditampilkan otomatis dalam bentuk **modal alert** pada halaman login untuk memudahkan pengujian.

---

## ✅ Penutup
Web ini dibuat untuk kebutuhan uas, tentu belum terlalu kompleks dan masih banyak yg perlu diperbaiki dan ditambahkan dalam web tersebut.
Untuk saat ini, ini yg dapat saya berikan untuk uas kali ini terimakasih.

