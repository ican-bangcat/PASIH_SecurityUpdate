# 🛡️ Laporan Perbaikan Keamanan Aplikasi PASIH

Dokumen ini berisi rangkuman lengkap perbaikan keamanan yang telah diterapkan pada aplikasi **PASIH** (`C:\laragon\www\PASIH`), mengacu pada rekomendasi hasil *Vulnerability Assessment*, **OWASP Top 10 (2021)**, **Perka BSSN No. 4/2021**, dan standar **NIST SP 800-63B Rev. 4** (Agustus 2025).

---

## 📋 Ringkasan Celah Keamanan & Status Perbaikan

| No | Nama Celah Keamanan | Severity | Standar Rujukan | Status |
|---|---|---|---|---|
| 1 | **Improper Error Handling** (Alur Login) | Low | OWASP A07:2021 / Perka BSSN No.4/2021 Ps.26 huruf f | ✅ **Selesai** |
| 2 | **Weak Password Policy** | Medium | OWASP A07:2021 / Perka BSSN No.4/2021 Ps.26 huruf a / NIST SP 800-63B Rev. 4 Sec 3.1.1 | ✅ **Selesai** |

---

## 🔍 Detail Perbaikan per Celah Keamanan

### 1. Improper Error Handling (Alur Login)

#### 📝 Latar Belakang & Perintah:
* **Masalah:** Umpan balik kegagalan login berpotensi membiarkan penyerang membedakan apakah email tidak terdaftar atau password yang salah (*User Enumeration*).
* **Instruksi:**
  1. Arahkan pengguna kembali ke halaman login saat autentikasi gagal.
  2. Tampilkan pesan kesalahan umum (*generic*): `"Email atau password salah."`.
  3. Gunakan mekanisme error handling bawaan Laravel (`back()->withErrors()`).

#### 📁 Lokasi File & Kode yang Diubah:
- **File:** `app/Http/Controllers/AuthController.php`
- **Lokasi Code:** Baris 54-56

```diff
  if (! Auth::attempt($credentials, $request->boolean('remember'))) {
-     return back()->withErrors(['email' => 'Email atau password tidak valid.'])->onlyInput('email');
+     return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
  }
```

---

### 2. Weak Password Policy (NIST SP 800-63B Rev. 4)

#### 📝 Latar Belakang & Perintah:
* **Masalah:** Aplikasi menggunakan panjang minimum password 8 karakter dan mewajibkan aturan komposisi karakter (huruf besar/kecil/angka).
* **Instruksi (Sesuai NIST SP 800-63B Rev. 4 Section 3.1.1):**
  1. Untuk autentikasi *single-factor*, panjang minimum password **WAJIB 15 karakter**.
  2. Dilarang menerapkan aturan komposisi karakter (`letters()`, `mixedCase()`, `numbers()`, `symbols()`, atau `regex`).
  3. Aktifkan pengecekan kebocoran data (*data breach check*) via `Password::min(15)->uncompromised()`.
  4. Perbarui teks petunjuk dan atribut HTML di seluruh form terkait menjadi `"Minimal 15 karakter."`.

---

#### 📁 Rincian File yang Diubah:

#### A. Controller Tambah & Edit Akun (Admin)
- **File:** `app/Http/Controllers/Admin/AccountManagementController.php`
- **Perubahan:**
  - Menambahkan import `use Illuminate\Validation\Rules\Password;`.
  - Mengubah validasi pada method `store()` (Tambah Akun) dan `update()` (Edit Akun).

```diff
+ use Illuminate\Validation\Rules\Password;

  // Method store() & update()
- 'password' => ['required', 'string', 'min:8', 'max:255', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
+ 'password' => ['required', 'string', 'max:255', Password::min(15)->uncompromised()],
```

#### B. Controller Reset Password
- **File:** `app/Http/Controllers/AuthController.php`
- **Perubahan:**
  - Mengubah validasi pada method `resetPassword()`.
  - Menggunakan alias `PasswordRule` yang sudah ada untuk menghindari *class collision* dengan Facade `Password`.

```diff
- PasswordRule::min(8)->letters()->mixedCase()->numbers(),
+ PasswordRule::min(15)->uncompromised(),
```

#### C. Form Tambah Akun (View)
- **File:** `resources/views/pages/admin/accounts/create.blade.php`
- **Perubahan:**
  - Mengubah `minlength="8"` menjadi `minlength="15"`.
  - Menghapus atribut HTML `pattern` dan `title` komposisi karakter.
  - Memperbarui teks petunjuk dari `"Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka."` menjadi `"Minimal 15 karakter."`.

#### D. Form Edit Akun (View)
- **File:** `resources/views/pages/admin/accounts/edit.blade.php`
- **Perubahan:**
  - Menambahkan atribut `minlength="15"`.
  - Menghapus atribut HTML `pattern` dan `title` komposisi karakter.
  - Memperbarui teks petunjuk menjadi `"Minimal 15 karakter."`.

#### E. Form Reset Password (View)
- **File:** `resources/views/auth/reset-password.blade.php`
- **Perubahan:**
  - Menambahkan atribut `minlength="15"` pada input `#new-password` dan `#confirm-password`.
  - Memperbarui teks petunjuk menjadi `"Minimal 15 karakter."`.

---

## 🧪 Pengujian & Verifikasi Akhir

- [x] **Lint Test Sintaks PHP (`php -l`):** Bebas dari error sintaksis pada seluruh controller.
- [x] **Proteksi Data Leak (`uncompromised()`):** Menggunakan model *k-Anonymity* SHA-1 (hanya mengirim 5 karakter awal hash ke HaveIBeenPwned API), menjaga privasi password pengguna.
- [x] **Integritas Sistem:** Tidak ada perubahan struktur database/migration dan tidak ada instalasi package pihak ketiga baru.
