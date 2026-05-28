# Sistem Pendukung Keputusan (SPK) Kelayakan Penerima Bantuan Sosial BLT-DD

[![PHP Native](https://img.shields.io/badge/PHP-Native-777BB4?logo=php&logoColor=white)](https://php.net)
[![jQuery](https://img.shields.io/badge/jQuery-v3.x-0769AD?logo=jquery&logoColor=white)](https://jquery.com)
[![MySQL](https://img.shields.io/badge/MySQL-v8.0-4479A1?logo=mysql&logoColor=white)](https://mysql.com)

Sistem Pendukung Keputusan (SPK) ini dirancang untuk mendigitalisasi, mengotomatisasi, dan menjaga objektivitas proses seleksi warga layak penerima Bantuan Langsung Tunai Dana Desa (BLT-DD). Menggunakan **Metode Simple Additive Weighting (SAW)**, sistem ini berhasil melakukan otomatisasi perhitungan bobot kriteria secara *real-time* serta **memangkas waktu kalkulasi dan perangkingan dari 3 hari menjadi hanya 1 hari**.

## 📊 Implementasi Metode SAW (Simple Additive Weighting)

Sistem ini melakukan pemrosesan data melalui 3 tahapan utama metode SAW secara murni di sisi server (*backend*):
1. **Analisis Kriteria & Pembobotan:** Mengonversi data mentah warga berdasarkan parameter kriteria dinamis yang telah ditentukan oleh pemerintah desa.
2. **Normalisasi Matriks:** Menghitung nilai normalisasi setiap alternatif (warga) berdasarkan tipe kriteria (*benefit* atau *cost*) untuk menghasilkan matriks ternormalisasi ($R$).
3. **Perangkingan (Preferensi):** Mengalikan matriks ternormalisasi dengan bobot kriteria ($W$) untuk mendapatkan nilai preferensi akhir ($V$) tertinggi sebagai rekomendasi utama penerima bantuan.

## 🚀 Fitur Utama

- **Dynamic Backend Architecture:** Parameter kriteria, bobot, dan jenis bantuan bersifat fleksibel sehingga sistem dapat digunakan berkelanjutan untuk program bansos lainnya selain BLT-DD.
- **Asynchronous Data Processing (jQuery AJAX):** Proses input data warga, kalkulasi metode SAW, hingga pembaruan tabel perangkingan berjalan secara instan tanpa perlu memuat ulang halaman (*page refresh*), memberikan pengalaman pengguna yang responsif.
- **Interactive Dashboard Analytics:** Mengintegrasikan visualisasi grafik interaktif dan pembuatan laporan teks otomatis guna mendukung transparansi penuh bagi pengambil keputusan desa.
- **Strict Data Validation:** Validasi data lapangan berlapis untuk memastikan tidak adanya manipulasi nilai input kriteria alternatif.

## 🛠️ Tech Stack

- **Server-Side:** PHP Native (Clean Structured Programming)
- **Client-Side:** JavaScript, jQuery (AJAX & DOM Manipulation), Bootstrap
- **Database:** MySQL (Relational Data Modeling)

## 💻 Cara Instalasi Lokal

1. **Clone Repositori**
```bash
   git clone [https://github.com/anggerlissamsudi/SPK-SAW-BLT.git](https://github.com/anggerlissamsudi/SPK-SAW-BLT.git)
   cd SPK-SAW-BLT
