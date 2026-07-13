<h1>Restributor Pasar 🏪</h1>

<p><strong>Description:</strong> A full-stack web application (Frontend & Backend) built to manage and streamline market retribution systems.</p>

<p><strong>Restributor Pasar</strong> adalah aplikasi berbasis <strong>Web Full-Stack</strong> yang dirancang untuk mendigitalisasi, mengelola, serta mempermudah seluruh ekosistem penarikan dan pencatatan retribusi pasar. Dengan mengintegrasikan sistem <em>Frontend</em> yang responsif dan <em>Backend</em> yang kokoh, aplikasi ini memberikan solusi yang transparan, efisien, dan meminimalisir kesalahan pencatatan manual di lapangan.</p>

<hr />

<h2>✨ Fitur Utama</h2>
<ul>
  <li><strong>Dashboard Admin & Statistik:</strong> Ringkasan visual secara real-time mengenai total pendapatan retribusi, jumlah pedagang aktif, dan status keterisian lapak.</li>
  <li><strong>Manajemen Data Pedagang & Lapak (CRUD):</strong> Pengelolaan informasi data pedagang secara terpusat, kategori jenis jualan, serta nomor blok/kios pasar.</li>
  <li><strong>Pencatatan Retribusi Digital:</strong> Memudahkan petugas lapangan melakukan input data pembayaran retribusi harian atau bulanan secara cepat melalui web.</li>
  <li><strong>Histori & Laporan Keuangan:</strong> Rekapitulasi transaksi otomatis yang dapat difilter berdasarkan rentang waktu tertentu untuk kebutuhan pembukuan.</li>
</ul>

<hr />

<h2>🛠️ Teknologi yang Digunakan</h2>
<p>Aplikasi ini dikembangkan menggunakan ekosistem framework web modern:</p>
<ul>
  <li><strong>Backend Framework:</strong> Laravel (PHP)</li>
  <li><strong>Frontend Engine:</strong> Blade Templating / HTML5, CSS3, JavaScript</li>
  <li><strong>CSS Framework:</strong> TailwindCSS / Bootstrap</li>
  <li><strong>Database:</strong> MySQL</li>
  <li><strong>Local Server Environment:</strong> Laragon </li>
</ul>

<hr />

<h2>🚀 Langkah Instalasi & Konfigurasi</h2>
<p>Ikuti panduan berikut secara berurutan untuk menjalankan proyek ini di lingkungan lokal (localhost) laptop/komputer kamu:</p>

<h3>1. Clone Repositori</h3>
<p>Buka Terminal atau Git Bash, lalu klon repositori ini ke dalam direktori server lokal kamu (jika menggunakan Laragon, arahkan ke folder <code>C:\laragon\www\</code>):</p>
<pre><code>git clone https://github.com/farighaputri/restributor_pasar-project.git
cd restributor_pasar-project</code></pre>

<h3>2. Install Dependencies Backend</h3>
<p>Jalankan Composer untuk mengunduh semua package dan vendor library Laravel yang dibutuhkan proyek:</p>
<pre><code>composer install</code></pre>

<h3>3. Konfigurasi Environment File (.env)</h3>
<p>Salin file template konfigurasi default bawaan proyek menjadi file <code>.env</code> operasional:</p>
<pre><code>cp .env.example .env</code></pre>
<p>Buka file <code>.env</code> baru tersebut menggunakan VS Code atau teks editor, lalu sesuaikan bagian konfigurasi database berikut dengan server lokal kamu:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_restributor_pasar
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<h3>4. Generate Application Key</h3>
<p>Buat enkripsi kunci keamanan unik untuk aplikasi Laravel kamu dengan menjalankan perintah:</p>
<pre><code>php artisan key:generate</code></pre>

<h3>5. Migrasi Database & Seeding</h3>
<p>Pastikan MySQL server di Laragon/XAMPP kamu sudah aktif. Buat database baru bernama <code>db_restributor_pasar</code> di phpMyAdmin, kemudian jalankan perintah migrasi berikut untuk membuat tabel secara otomatis:</p>
<pre><code>php artisan migrate --seed</code></pre>
<p><em>*Catatan: Flag <code>--seed</code> digunakan jika proyek sudah dilengkapi data awal otomatis (dummy data / akun admin default). Jika tidak ada data awal bawaan, cukup jalankan <code>php artisan migrate</code>.</em></p>

<h3>6. Menjalankan Aplikasi</h3>
<p>Nyalakan server development lokal Laravel dengan perintah:</p>
<pre><code>php artisan serve</code></pre>
<p>Buka browser kesayangan kamu dan akses URL yang tertera pada terminal, biasanya: <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a></p>

<hr />

<h2>👨‍💻 Kontributor</h2>
<ul>
  <li><strong>farighaputri</strong> - <em>Pengembang Utama & Full-Stack Developer</em> - <a href="https://github.com/farighaputri">@farighaputri</a></li>
</ul>
