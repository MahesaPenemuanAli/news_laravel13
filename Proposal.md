# PROPOSAL PENGEMBANGAN SISTEM
## PORTAL BERITA DIGITAL BERBASIS WEB MENGGUNAKAN LARAVEL 13 DAN TALL STACK

---

**Disusun Oleh:**
[Nama Penyusun]
[NIM / NIP]
[Program Studi / Departemen]
[Institusi / Universitas]
[Tahun 2026]

---

## LEMBAR PENGESAHAN

**Judul Proposal:**
Pengembangan Sistem Portal Berita Digital Berbasis Web Menggunakan Framework Laravel 13 dengan Arsitektur TALL Stack dan FilamentPHP

**Penyusun:** [Nama Penyusun]

**Tanggal Pengajuan:** [Tanggal]

**Disetujui Oleh:**

| Jabatan | Nama | Tanda Tangan |
|---|---|---|
| Dosen Pembimbing | ........................ | ........................ |
| Kepala Program Studi | ........................ | ........................ |

---

## DAFTAR ISI

1. **BAB I – PENDAHULUAN**
   - 1.1 Latar Belakang
   - 1.2 Rumusan Masalah
   - 1.3 Tujuan Pengembangan
   - 1.4 Manfaat Pengembangan
   - 1.5 Batasan Masalah
2. **BAB II – TINJAUAN PUSTAKA**
   - 2.1 Portal Berita Digital
   - 2.2 Framework Laravel
   - 2.3 TALL Stack
   - 2.4 FilamentPHP
   - 2.5 Meilisearch
   - 2.6 Redis
   - 2.7 Search Engine Optimization (SEO)
   - 2.8 Monetisasi Website
3. **BAB III – METODOLOGI PENGEMBANGAN**
   - 3.1 Model Pengembangan Sistem (SDLC)
   - 3.2 Flowchart Pengembangan
   - 3.3 Alat dan Bahan
   - 3.4 Lingkungan Pengembangan
4. **BAB IV – ANALISIS DAN PERANCANGAN SISTEM**
   - 4.1 Analisis Kebutuhan Fungsional
   - 4.2 Analisis Kebutuhan Non-Fungsional
   - 4.3 Perancangan Arsitektur Sistem
   - 4.4 Entity Relationship Diagram (ERD)
   - 4.5 Perancangan Antarmuka (UI/UX)
   - 4.6 Perancangan Strategi Monetisasi (Iklan)
5. **BAB V – RENCANA IMPLEMENTASI**
   - 5.1 Teknologi yang Digunakan
   - 5.2 Struktur Direktori Proyek
   - 5.3 Rencana Pengujian
6. **BAB VI – PENUTUP**
   - 6.1 Kesimpulan
   - 6.2 Saran
7. **DAFTAR PUSTAKA**

---

## BAB I
## PENDAHULUAN

### 1.1 Latar Belakang

Perkembangan teknologi informasi dan komunikasi telah mengubah lanskap industri media secara fundamental. Menurut data *Reuters Institute Digital News Report 2025*, lebih dari 75% populasi global kini mengonsumsi berita melalui perangkat digital, dengan persentase yang terus meningkat setiap tahunnya. Pergeseran dari media cetak ke media digital menuntut setiap organisasi pers untuk memiliki infrastruktur teknologi yang handal, cepat, dan mampu menyajikan informasi secara *real-time*.

Portal berita digital memiliki karakteristik unik yang membedakannya dari website pada umumnya, antara lain: (1) volume konten yang sangat besar dan terus bertambah setiap menit, (2) pola trafik yang tidak terprediksi dengan lonjakan tajam saat terjadi peristiwa penting (*breaking news*), (3) ketergantungan tinggi pada optimasi mesin pencari (SEO) sebagai sumber utama pengunjung organik, dan (4) kebutuhan monetisasi melalui iklan yang tidak boleh mengganggu pengalaman membaca pengguna.

Framework Laravel, yang telah mencapai versi 13 pada tahun 2026, menyediakan ekosistem pengembangan web yang matang dengan fitur-fitur *enterprise-grade* seperti *queue system*, *event broadcasting*, dan *caching* yang sangat cocok untuk membangun portal berita berskala besar. Dipadukan dengan arsitektur TALL Stack (*Tailwind CSS, Alpine.js, Laravel, Livewire*) untuk frontend dan FilamentPHP untuk panel administrasi, sistem yang dibangun dapat mencapai keseimbangan optimal antara kecepatan pengembangan, performa runtime, dan kualitas pengalaman pengguna.

Berdasarkan pertimbangan tersebut, proposal ini mengajukan perancangan dan pengembangan sistem portal berita digital yang modern, skalabel, dan monetizable menggunakan teknologi terkini dalam ekosistem PHP dan Laravel.

### 1.2 Rumusan Masalah

Berdasarkan latar belakang di atas, rumusan masalah dalam pengembangan sistem ini adalah:

1. Bagaimana merancang arsitektur sistem portal berita digital yang mampu menangani volume konten besar dengan performa tinggi?
2. Bagaimana mengimplementasikan sistem manajemen konten (CMS) yang intuitif bagi redaktur, editor, dan reporter dengan alur kerja editorial yang terstruktur?
3. Bagaimana mengintegrasikan mesin pencari berbasis *full-text search* untuk memberikan pengalaman pencarian berita yang cepat dan toleran terhadap kesalahan ketik (*typo-tolerance*)?
4. Bagaimana merancang strategi monetisasi melalui penempatan iklan yang optimal tanpa menurunkan skor *Core Web Vitals* dan pengalaman pengguna?
5. Bagaimana menerapkan fitur *live blogging* secara *real-time* untuk peliputan peristiwa yang sedang berlangsung?

### 1.3 Tujuan Pengembangan

1. Membangun sistem portal berita digital berbasis web yang responsif, cepat, dan ramah SEO menggunakan Laravel 13.
2. Mengembangkan panel administrasi yang komprehensif menggunakan FilamentPHP untuk pengelolaan konten, pengguna, iklan, dan analitik.
3. Mengimplementasikan mesin pencarian berita menggunakan Meilisearch yang terintegrasi dengan Laravel Scout.
4. Merancang sistem monetisasi iklan yang dinamis dengan manajemen penempatan, jadwal tayang, dan pelacakan impresi.
5. Menerapkan fitur *live blogging* menggunakan Laravel Reverb dan WebSocket untuk pembaruan berita secara *real-time*.
6. Mengoptimasi performa website melalui implementasi Redis caching, konversi gambar otomatis ke format WebP, dan integrasi CDN.

### 1.4 Manfaat Pengembangan

**1.4.1 Manfaat bagi Organisasi Media**
- Memiliki platform digital mandiri yang tidak bergantung pada CMS pihak ketiga (seperti WordPress) sehingga memiliki kontrol penuh atas kustomisasi fitur.
- Alur kerja editorial yang terstruktur (Draft → Review → Published) meningkatkan kualitas konten sebelum dipublikasikan.
- Sistem monetisasi terintegrasi yang dapat meningkatkan pendapatan organisasi.

**1.4.2 Manfaat bagi Pembaca**
- Pengalaman membaca yang cepat dan nyaman dengan skor *Core Web Vitals* yang optimal.
- Pencarian berita yang akurat dan instan dengan toleransi kesalahan ketik.
- Aksesibilitas konten di berbagai perangkat (desktop, tablet, smartphone).

**1.4.3 Manfaat Akademis**
- Menjadi studi kasus implementasi arsitektur TALL Stack pada aplikasi berskala besar.
- Memberikan referensi perancangan sistem portal berita dengan standar industri terkini.

### 1.5 Batasan Masalah

1. Sistem dikembangkan menggunakan bahasa pemrograman PHP 8.4+ dengan framework Laravel 13.
2. Frontend pengguna menggunakan TALL Stack (Blade Templates, Tailwind CSS, Alpine.js, Livewire).
3. Panel administrasi menggunakan FilamentPHP v3.
4. Database menggunakan MySQL 8.0 atau MariaDB 10.11.
5. Fitur pembayaran (*paywall*) hanya mencakup penandaan artikel premium; integrasi *payment gateway* tidak termasuk dalam ruang lingkup ini.
6. Aplikasi mobile (Android/iOS) tidak termasuk dalam ruang lingkup; sistem menggunakan desain *responsive web*.

---

## BAB II
## TINJAUAN PUSTAKA

### 2.1 Portal Berita Digital

Portal berita digital adalah platform berbasis web yang berfungsi sebagai media distribusi informasi jurnalistik secara elektronik. Menurut Wardhana (2023), portal berita modern harus memenuhi empat pilar utama: (1) kecepatan penyajian informasi (*speed*), (2) akurasi dan kredibilitas konten (*credibility*), (3) kemudahan navigasi dan pencarian (*usability*), dan (4) keberlanjutan bisnis melalui monetisasi (*sustainability*).

### 2.2 Framework Laravel

Laravel adalah framework PHP *open-source* yang mengikuti pola arsitektur Model-View-Controller (MVC). Pada versi 13 (2026), Laravel menyempurnakan berbagai fitur termasuk:
- **Eloquent ORM:** Sistem *Object-Relational Mapping* yang menyederhanakan interaksi dengan database.
- **Blade Templating Engine:** Mesin template yang mendukung *component-based UI development*.
- **Queue System:** Penanganan tugas asinkron untuk proses berat seperti pengiriman email dan konversi gambar.
- **Event Broadcasting:** Sistem *real-time* yang terintegrasi dengan WebSocket.
- **Built-in Authentication & Authorization:** Sistem keamanan yang komprehensif.

### 2.3 TALL Stack

TALL Stack adalah kumpulan teknologi yang dirancang untuk bekerja secara sinergis dalam ekosistem Laravel:
- **Tailwind CSS:** Framework CSS *utility-first* yang memungkinkan pembangunan antarmuka responsif tanpa menulis CSS kustom secara manual.
- **Alpine.js:** Framework JavaScript minimalis (~15KB) untuk menambahkan interaktivitas pada komponen HTML.
- **Laravel:** Backend framework (sebagaimana dijelaskan pada sub-bab 2.2).
- **Livewire:** Library yang memungkinkan pembuatan antarmuka dinamis menggunakan PHP tanpa perlu menulis JavaScript secara terpisah, berkomunikasi dengan server melalui AJAX.

### 2.4 FilamentPHP

FilamentPHP adalah toolkit untuk membangun panel administrasi di Laravel menggunakan TALL Stack. Keunggulan utamanya meliputi:
- Pembuatan halaman CRUD secara deklaratif dengan minimal kode.
- Form builder yang kaya komponen (*Rich Text Editor, File Upload, Repeater*).
- Table builder dengan fitur *filtering, sorting, bulk actions*, dan *export*.
- Dashboard widgets untuk visualisasi data statistik.
- Sistem manajemen peran dan izin (*Role-Based Access Control*).

### 2.5 Meilisearch

Meilisearch adalah mesin pencari *open-source* yang ditulis dalam bahasa Rust, dikenal karena kecepatan dan kemudahan penggunaannya. Fitur utama yang relevan untuk portal berita:
- **Typo Tolerance:** Tetap menemukan hasil meskipun pengguna salah mengetik.
- **Typing Speed:** Respons pencarian dalam waktu kurang dari 50 milidetik.
- **Faceted Search:** Memungkinkan filter pencarian berdasarkan kategori, tanggal, dan penulis.
- **Highlighting:** Menyorot kata kunci yang cocok dalam hasil pencarian.

### 2.6 Redis

Redis (*Remote Dictionary Server*) adalah penyimpanan data *in-memory* yang berfungsi sebagai database, cache, dan *message broker*. Dalam konteks portal berita, Redis digunakan untuk:
- Menyimpan hasil *query* yang sering diakses (widget berita populer, kategori).
- Menghitung *page views* secara *atomic* tanpa membebani database utama.
- Menyimpan sesi pengguna (*session storage*) untuk performa yang lebih cepat.

### 2.7 Search Engine Optimization (SEO)

SEO adalah serangkaian praktik untuk meningkatkan visibilitas website di halaman hasil mesin pencari. Untuk portal berita, aspek SEO yang kritis meliputi:
- **Structured Data (Schema.org):** Penandaan `NewsArticle` dalam format JSON-LD agar artikel terindeks oleh Google News.
- **Core Web Vitals:** Metrik performa yang diukur oleh Google meliputi LCP (*Largest Contentful Paint*), FID (*First Input Delay*), dan CLS (*Cumulative Layout Shift*).
- **Open Graph Tags:** Meta tag yang mengatur tampilan pratinjau saat tautan dibagikan di media sosial.
- **XML Sitemap:** Daftar URL yang diperbarui otomatis untuk memfasilitasi *crawling* oleh mesin pencari.

### 2.8 Monetisasi Website

Monetisasi portal berita umumnya dilakukan melalui:
- **Programmatic Advertising:** Iklan yang ditampilkan secara otomatis melalui jaringan seperti Google AdSense berdasarkan lelang *real-time*.
- **Direct Sold Ads:** Penjualan ruang iklan langsung kepada pengiklan dengan harga dan durasi yang disepakati.
- **Sponsored Content (Advertorial):** Konten berbayar yang disajikan dalam format berita dengan label "Sponsored" atau "Promo".
- **Subscription/Paywall:** Pembatasan akses konten premium untuk pengguna berbayar.

---

## BAB III
## METODOLOGI PENGEMBANGAN

### 3.1 Model Pengembangan Sistem

Pengembangan sistem ini menggunakan model **Agile dengan pendekatan iteratif**. Setiap iterasi (sprint) berlangsung selama 2 minggu dengan tahapan: *Planning → Design → Development → Testing → Review*. Pendekatan ini dipilih karena memungkinkan penyesuaian fitur berdasarkan umpan balik berkelanjutan.

### 3.2 Flowchart Pengembangan Sistem

```
┌─────────────────────────────────────────┐
│       1. ANALISIS KEBUTUHAN             │
│  • Identifikasi fitur & target audiens  │
│  • Studi banding portal berita existing │
│  • Penyusunan dokumen spesifikasi       │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    2. PERANCANGAN SISTEM & DATABASE     │
│  • Pembuatan ERD & Normalisasi Tabel    │
│  • Perancangan UI/UX (Wireframe/Figma)  │
│  • Arsitektur infrastruktur server      │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    3. SETUP ENVIRONMENT & DEVOPS        │
│  • Instalasi Laravel 13 & dependensi    │
│  • Konfigurasi Vite, TailwindCSS        │
│  • Setup MySQL, Redis, Meilisearch      │
│  • Konfigurasi Git & CI/CD Pipeline    │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    4. PENGEMBANGAN BACKEND              │
│  • Database Migration & Seeder          │
│  • Model Eloquent & Relasi              │
│  • Controllers & Routing                │
│  • Middleware (Auth, Role, Cache)       │
│  • Queue Jobs (Image Processing)        │
│  • Event & Listener                     │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    5. PENGEMBANGAN FRONTEND USER        │
│  • Master Layout (Blade + Tailwind)     │
│  • Halaman: Home, Category, Article     │
│  • Komponen Livewire (Search, Poll)     │
│  • Alpine.js interaktivitas             │
│  • Responsive Design (Mobile-First)     │
│  • Implementasi SEO Meta & Schema       │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    6. PENGEMBANGAN ADMIN PANEL          │
│  • FilamentPHP Resources                │
│  • CRUD: Artikel, Kategori, Tag, User   │
│  • Manajemen Iklan & Penjadwalan        │
│  • Dashboard Analitik & Statistik       │
│  • Manajemen Menu & Halaman Statis      │
│  • SEO Manager (Polymorphic)            │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    7. INTEGRASI LAYANAN EKSTERNAL       │
│  • Meilisearch via Laravel Scout        │
│  • Spatie MediaLibrary + WebP           │
│  • Laravel Reverb (WebSocket)           │
│  • Redis Caching Layer                  │
│  • Cloudflare CDN Integration           │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    8. PENGUJIAN SISTEM                  │
│  • Unit Testing (PHPUnit/Pest)          │
│  • Feature Testing (HTTP Tests)         │
│  • Load Testing (k6 / Apache Bench)     │
│  • Security Audit (OWASP Checklist)     │
│  • SEO Audit (Lighthouse Score > 90)    │
│  • Cross-browser & Responsive Testing   │
└────────────────┬────────────────────────┘
                 ▼
┌─────────────────────────────────────────┐
│    9. DEPLOYMENT & MAINTENANCE          │
│  • Setup VPS (Ubuntu + Nginx + PHP-FPM) │
│  • SSL Certificate (Let's Encrypt)      │
│  • DNS & Cloudflare Configuration       │
│  • Monitoring (Laravel Telescope/Sentry)│
│  • Backup Otomatis (Database + Storage) │
│  • Dokumentasi Sistem & User Manual     │
└─────────────────────────────────────────┘
```

### 3.3 Alat dan Bahan

| No | Kategori | Alat / Teknologi | Versi | Fungsi |
|----|----------|-------------------|-------|--------|
| 1 | Backend Framework | Laravel | 13.x | Kerangka kerja utama aplikasi |
| 2 | Bahasa Pemrograman | PHP | 8.4+ | Bahasa utama backend |
| 3 | Frontend CSS | Tailwind CSS | 4.x | Styling antarmuka pengguna |
| 4 | Frontend JS | Alpine.js | 3.x | Interaktivitas ringan |
| 5 | Frontend Dinamis | Livewire | 3.x | Komponen reaktif tanpa JS terpisah |
| 6 | Admin Panel | FilamentPHP | 3.x | Panel administrasi |
| 7 | Database | MySQL | 8.0+ | Penyimpanan data relasional |
| 8 | Cache & Queue | Redis | 7.x | Caching dan antrian tugas |
| 9 | Search Engine | Meilisearch | 1.x | Mesin pencari *full-text* |
| 10 | Asset Bundling | Vite | 6.x | Kompilasi CSS/JS |
| 11 | WebSocket | Laravel Reverb | 1.x | Komunikasi *real-time* |
| 12 | Media Management | Spatie MediaLibrary | 11.x | Manajemen file dan gambar |
| 13 | Image Processing | Intervention Image | 3.x | Konversi dan optimasi gambar |
| 14 | Server | Nginx + PHP-FPM | Latest | Web server produksi |
| 15 | CDN & Keamanan | Cloudflare | - | CDN, DDoS protection, SSL |
| 16 | Version Control | Git + GitHub | - | Manajemen kode sumber |
| 17 | Container | Docker | Latest | Standarisasi environment |

### 3.4 Lingkungan Pengembangan

| Lingkungan | Spesifikasi Minimum |
|---|---|
| **Development** | Laptop/PC: 8GB RAM, SSD, PHP 8.4, Composer, Node.js 20+, Docker |
| **Staging** | VPS: 2 vCPU, 4GB RAM, 80GB SSD, Ubuntu 24.04 |
| **Production** | VPS: 4 vCPU, 8GB RAM, 160GB SSD, Ubuntu 24.04, Cloudflare CDN |

---

## BAB IV
## ANALISIS DAN PERANCANGAN SISTEM

### 4.1 Analisis Kebutuhan Fungsional

#### 4.1.1 Kebutuhan Fungsional – Pengguna Umum (Pembaca)
| Kode | Fitur | Deskripsi |
|------|-------|-----------|
| FU-01 | Halaman Beranda | Menampilkan hero news, berita terkini, widget kategori, dan sidebar populer |
| FU-02 | Halaman Kategori | Daftar berita yang difilter berdasarkan kategori dengan pagination |
| FU-03 | Halaman Artikel | Tampilan lengkap artikel dengan gambar, konten, tag, dan artikel terkait |
| FU-04 | Pencarian Berita | Kotak pencarian *instant search* dengan toleransi kesalahan ketik |
| FU-05 | Live Blogging | Pembaruan konten artikel secara *real-time* tanpa *reload* halaman |
| FU-06 | Komentar | Pengguna yang login dapat memberikan komentar dan membalas komentar lain |
| FU-07 | Bookmark | Menyimpan artikel favorit untuk dibaca kemudian |
| FU-08 | Jajak Pendapat | Widget polling interaktif di sidebar |
| FU-09 | Berlangganan | Form input email untuk newsletter |
| FU-10 | Mode Gelap | Toggle tampilan dark/light mode |

#### 4.1.2 Kebutuhan Fungsional – Administrator / Redaksi
| Kode | Fitur | Deskripsi |
|------|-------|-----------|
| FA-01 | Dashboard | Statistik total artikel, views, penulis aktif, dan artikel pending review |
| FA-02 | CRUD Artikel | Form pembuatan artikel dengan Rich Text Editor dan upload gambar |
| FA-03 | Workflow Editorial | Status artikel: Draft → Review → Published → Archived |
| FA-04 | Manajemen Kategori | CRUD kategori dengan struktur hierarki (parent-child) |
| FA-05 | Manajemen Tag | CRUD tag untuk label artikel |
| FA-06 | Manajemen Pengguna | Membuat akun reporter/editor dengan role tertentu |
| FA-07 | Manajemen Iklan | Upload banner, atur posisi, jadwal tayang, dan tracking impresi/klik |
| FA-08 | Manajemen Polling | CRUD jajak pendapat dan opsi jawaban |
| FA-09 | Manajemen Menu | Mengatur struktur navbar dan footer secara dinamis |
| FA-10 | Manajemen Halaman | CRUD halaman statis (Tentang Kami, Kontak, Kebijakan Privasi) |
| FA-11 | SEO Manager | Mengatur meta title, description, dan schema markup per artikel/kategori |
| FA-12 | Analitik Views | Laporan jumlah pembaca per artikel, per kategori, dan per periode waktu |
| FA-13 | Manajemen Komentar | Approve, reject, atau hapus komentar pembaca |
| FA-14 | Pengaturan Umum | Nama website, logo, favicon, kontak, dan link media sosial |

### 4.2 Analisis Kebutuhan Non-Fungsional

| Kode | Kebutuhan | Target |
|------|-----------|--------|
| NF-01 | Kecepatan Muat (LCP) | < 2.5 detik pada koneksi 4G |
| NF-02 | Stabilitas Visual (CLS) | < 0.1 |
| NF-03 | Responsivitas Interaksi (FID/INP) | < 100 milidetik |
| NF-04 | Skor Lighthouse (SEO) | > 90 |
| NF-05 | Responsivitas Tampilan | Mobile, Tablet, Desktop (Breakpoints: 640px, 768px, 1024px, 1280px) |
| NF-06 | Keamanan | Proteksi CSRF, XSS, SQL Injection, Rate Limiting |
| NF-07 | Ketersediaan (Uptime) | > 99.5% |
| NF-08 | Skalabilitas | Mampu menangani 10.000+ concurrent users |
| NF-09 | Aksesibilitas | Memenuhi standar WCAG 2.1 Level AA |
| NF-10 | Backup | Otomatis harian untuk database dan storage |

### 4.3 Perancangan Arsitektur Sistem

```
┌──────────────────────────────────────────────────────────────────────┐
│                        CLIENT LAYER                                  │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────────────────┐   │
│  │   Desktop     │  │    Mobile    │  │   Bot Search Engine      │   │
│  │   Browser     │  │   Browser    │  │   (Googlebot, Bing)      │   │
│  └──────┬───────┘  └──────┬───────┘  └──────────┬───────────────┘   │
│         │                 │                      │                   │
└─────────┼─────────────────┼──────────────────────┼───────────────────┘
          │                 │                      │
          ▼                 ▼                      ▼
┌──────────────────────────────────────────────────────────────────────┐
│                      CDN LAYER (Cloudflare)                          │
│  • Static Assets Caching (CSS, JS, Images)                          │
│  • DDoS Protection & WAF                                            │
│  • SSL/TLS Termination                                              │
│  • Edge Caching untuk HTML Halaman Berita                           │
└──────────────────────────────────┬───────────────────────────────────┘
                                   │
                                   ▼
┌──────────────────────────────────────────────────────────────────────┐
│                    APPLICATION LAYER (Laravel 13)                     │
│  ┌────────────────────────────────────────────────────────────────┐  │
│  │                     Web Server (Nginx)                        │  │
│  │              PHP-FPM 8.4 + OPcache Enabled                    │  │
│  └───────────────────────────────┬────────────────────────────────┘  │
│                                  │                                    │
│  ┌───────────────────────────────┼────────────────────────────────┐  │
│  │                     LARAVEL APPLICATION                       │  │
│  │  ┌────────────┐ ┌─────────────┐ ┌────────────┐ ┌───────────┐ │  │
│  │  │   Routes   │→│ Middleware   │→│Controllers │→│  Models   │ │  │
│  │  │            │ │ (Auth,Role, │ │            │ │ (Eloquent)│ │  │
│  │  │            │ │  Throttle)  │ │            │ │           │ │  │
│  │  └────────────┘ └─────────────┘ └────────────┘ └─────┬─────┘ │  │
│  │                                                       │       │  │
│  │  ┌──────────────────────────────────────────────┐     │       │  │
│  │  │           SERVICES & JOBS                     │     │       │  │
│  │  │  • SearchService (Meilisearch)                │     │       │  │
│  │  │  • ImageConversionJob (WebP)                  │     │       │  │
│  │  │  • ViewCountBatchJob (Redis→MySQL)            │     │       │  │
│  │  │  • SitemapGeneratorJob                        │     │       │  │
│  │  │  • NewsletterDispatchJob                      │     │       │  │
│  │  └──────────────────────────────────────────────┘     │       │  │
│  │                                                       │       │  │
│  │  ┌──────────────────────────────────────────────┐     │       │  │
│  │  │           PRESENTATION LAYER                  │     │       │  │
│  │  │  • Blade Templates (SSR untuk SEO)            │     │       │  │
│  │  │  • Livewire Components (Dynamic UI)           │     │       │  │
│  │  │  • Alpine.js (Lightweight Interactions)       │     │       │  │
│  │  │  • FilamentPHP (Admin Panel)                  │     │       │  │
│  │  └──────────────────────────────────────────────┘     │       │  │
│  └───────────────────────────────────────────────────────┘       │  │
└──────────────────────────────────┬───────────────────────────────────┘
                                   │
          ┌────────────────────────┼────────────────────────┐
          ▼                        ▼                        ▼
┌──────────────────┐  ┌─────────────────────┐  ┌─────────────────────┐
│   DATA LAYER     │  │    CACHE LAYER      │  │   SEARCH LAYER      │
│                  │  │                     │  │                     │
│  ┌────────────┐  │  │  ┌───────────────┐  │  │  ┌───────────────┐  │
│  │  MySQL 8.0 │  │  │  │    Redis      │  │  │  │  Meilisearch  │  │
│  │            │  │  │  │               │  │  │  │               │  │
│  │ • Articles │  │  │  │ • Queries     │  │  │  │ • Full-text   │  │
│  │ • Users    │  │  │  │ • Sessions    │  │  │  │   Index       │  │
│  │ • Categories│ │  │  │ • View Counts │  │  │  │ • Typo Tol.   │  │
│  │ • Ads      │  │  │  │ • Rate Limits │  │  │  │ • Facets      │  │
│  └────────────┘  │  │  └───────────────┘  │  │  └───────────────┘  │
└──────────────────┘  └─────────────────────┘  └─────────────────────┘
                                   │
                                   ▼
┌──────────────────────────────────────────────────────────────────────┐
│                    REAL-TIME LAYER                                    │
│  ┌────────────────────────────────────────────────────────────────┐  │
│  │              Laravel Reverb (WebSocket Server)                 │  │
│  │  • Live Blogging Channel (article.{id})                       │  │
│  │  • Notification Channel                                        │  │
│  │  • Poll Real-time Updates                                      │  │
│  └────────────────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────────────┘
                                   │
                                   ▼
┌──────────────────────────────────────────────────────────────────────┐
│                    STORAGE LAYER                                      │
│  ┌──────────────┐  ┌──────────────────────────────────────────────┐ │
│  │ Local Storage│  │  Spatie MediaLibrary                         │ │
│  │ /storage/app │  │  • Original Images                           │ │
│  │ /public      │  │  • WebP Conversions                          │ │
│  │              │  │  • Thumbnails (300x200, 800x600, 1200x800)   │ │
│  └──────────────┘  └──────────────────────────────────────────────┘ │
└──────────────────────────────────────────────────────────────────────┘
```

### 4.4 Entity Relationship Diagram (ERD)

*(Merujuk pada ERD yang telah dirancang pada Bab sebelumnya, berikut adalah penjelasan rinci per tabel beserta atribut lengkapnya)*

#### 4.4.1 Tabel `users`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK, AUTO_INCREMENT | Primary Key |
| uuid | CHAR(36) | UNIQUE | UUID untuk URL profil publik |
| name | VARCHAR(255) | NOT NULL | Nama lengkap |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Alamat email |
| password | VARCHAR(255) | NOT NULL | Password terenkripsi (bcrypt) |
| role | ENUM | NOT NULL | 'admin', 'editor', 'reporter', 'user' |
| is_active | BOOLEAN | DEFAULT true | Status aktif akun |
| email_verified_at | TIMESTAMP | NULLABLE | Waktu verifikasi email |
| remember_token | VARCHAR(100) | NULLABLE | Token "Remember Me" |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.2 Tabel `author_profiles`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| user_id | BIGINT | FK → users.id, UNIQUE | Relasi one-to-one ke users |
| bio | TEXT | NULLABLE | Biografi penulis |
| expertise | VARCHAR(255) | NULLABLE | Bidang keahlian |
| photo | VARCHAR(255) | NULLABLE | Path foto profil |
| facebook_url | VARCHAR(255) | NULLABLE | URL Facebook |
| twitter_url | VARCHAR(255) | NULLABLE | URL Twitter/X |
| instagram_url | VARCHAR(255) | NULLABLE | URL Instagram |

#### 4.4.3 Tabel `categories`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| parent_id | BIGINT | FK → categories.id, NULLABLE | Self-referencing untuk sub-kategori |
| name | VARCHAR(255) | NOT NULL | Nama kategori |
| slug | VARCHAR(255) | UNIQUE, NOT NULL | URL-friendly identifier |
| description | TEXT | NULLABLE | Deskripsi kategori |
| icon_class | VARCHAR(100) | NULLABLE | CSS class untuk ikon |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.4 Tabel `tags`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| name | VARCHAR(255) | NOT NULL | Nama tag |
| slug | VARCHAR(255) | UNIQUE, NOT NULL | URL-friendly identifier |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.5 Tabel `articles`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| author_id | BIGINT | FK → users.id | Penulis artikel |
| category_id | BIGINT | FK → categories.id | Kategori artikel |
| title | VARCHAR(255) | NOT NULL | Judul berita |
| slug | VARCHAR(255) | UNIQUE, NOT NULL | URL-friendly identifier |
| excerpt | TEXT | NULLABLE | Ringkasan artikel |
| content | LONGTEXT | NOT NULL | Konten lengkap (HTML dari Rich Text Editor) |
| status | ENUM | NOT NULL | 'draft', 'review', 'published', 'archived' |
| published_at | TIMESTAMP | NULLABLE | Waktu publikasi (jadwal atau aktual) |
| is_breaking_news | BOOLEAN | DEFAULT false | Penanda berita terkini/urgent |
| is_premium | BOOLEAN | DEFAULT false | Penanda konten berbayar |
| views_count | INTEGER | DEFAULT 0 | Total jumlah pembaca |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |
| deleted_at | TIMESTAMP | NULLABLE | Soft delete timestamp |

#### 4.4.6 Tabel `article_tag` (Pivot Table)
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| article_id | BIGINT | FK → articles.id | Relasi ke artikel |
| tag_id | BIGINT | FK → tags.id | Relasi ke tag |
| | | PRIMARY KEY (article_id, tag_id) | Composite Primary Key |

#### 4.4.7 Tabel `article_updates` (Live Blogging)
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| article_id | BIGINT | FK → articles.id, CASCADE DELETE | Relasi ke artikel |
| update_content | TEXT | NOT NULL | Konten pembaruan live |
| created_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.8 Tabel `article_views` (Analytics)
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| article_id | BIGINT | FK → articles.id, INDEX | Relasi ke artikel |
| ip_address | VARCHAR(45) | NOT NULL | Alamat IP pengunjung (IPv4/IPv6) |
| user_agent | TEXT | NULLABLE | Informasi browser/perangkat |
| viewed_date | DATE | INDEX | Tanggal kunjungan |

#### 4.4.9 Tabel `comments`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| article_id | BIGINT | FK → articles.id, CASCADE DELETE | Relasi ke artikel |
| user_id | BIGINT | FK → users.id | Pengirim komentar |
| parent_id | BIGINT | FK → comments.id, NULLABLE | Self-referencing untuk balasan |
| body | TEXT | NOT NULL | Isi komentar |
| is_approved | BOOLEAN | DEFAULT false | Status moderasi |
| created_at | TIMESTAMP | AUTO | Waktu pengiriman |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.10 Tabel `article_bookmarks`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| user_id | BIGINT | FK → users.id | Pengguna yang menyimpan |
| article_id | BIGINT | FK → articles.id | Artikel yang disimpan |
| created_at | TIMESTAMP | AUTO | Waktu penyimpanan |
| | | PRIMARY KEY (user_id, article_id) | Composite Primary Key |

#### 4.4.11 Tabel `ads`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| name | VARCHAR(255) | NOT NULL | Nama klien/campaign |
| image_url | VARCHAR(255) | NOT NULL | Path gambar banner |
| target_url | VARCHAR(255) | NOT NULL | URL tujuan saat diklik |
| position | ENUM | NOT NULL | 'header', 'sidebar', 'in_content', 'footer' |
| start_date | DATE | NOT NULL | Tanggal mulai tayang |
| end_date | DATE | NOT NULL | Tanggal akhir tayang |
| is_active | BOOLEAN | DEFAULT true | Status aktif |
| impressions | INTEGER | DEFAULT 0 | Jumlah tampil |
| clicks | INTEGER | DEFAULT 0 | Jumlah klik |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.12 Tabel `polls`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| question | VARCHAR(255) | NOT NULL | Pertanyaan jajak pendapat |
| is_active | BOOLEAN | DEFAULT true | Status aktif |
| expires_at | TIMESTAMP | NULLABLE | Waktu berakhir |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |

#### 4.4.13 Tabel `poll_options`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| poll_id | BIGINT | FK → polls.id, CASCADE DELETE | Relasi ke polling |
| option_text | VARCHAR(255) | NOT NULL | Teks opsi |
| votes_count | INTEGER | DEFAULT 0 | Jumlah suara (denormalized untuk performa) |

#### 4.4.14 Tabel `poll_votes`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| poll_option_id | BIGINT | FK → poll_options.id | Opsi yang dipilih |
| user_id | BIGINT | FK → users.id, NULLABLE | User yang memilih (nullable untuk guest) |
| ip_address | VARCHAR(45) | NOT NULL | IP untuk pencegahan voting ganda |
| created_at | TIMESTAMP | AUTO | Waktu voting |

#### 4.4.15 Tabel `subscribers`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Email pelanggan |
| token | VARCHAR(255) | NOT NULL | Token verifikasi/unsubscribe |
| is_verified | BOOLEAN | DEFAULT false | Status verifikasi |
| created_at | TIMESTAMP | AUTO | Waktu berlangganan |

#### 4.4.16 Tabel `menus`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| name | VARCHAR(255) | NOT NULL | Nama menu (Navbar, Footer, Sidebar) |
| location | VARCHAR(100) | UNIQUE | Lokasi penempatan |

#### 4.4.17 Tabel `menu_items`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| menu_id | BIGINT | FK → menus.id, CASCADE DELETE | Relasi ke menu |
| parent_id | BIGINT | FK → menu_items.id, NULLABLE | Self-referencing untuk dropdown |
| title | VARCHAR(255) | NOT NULL | Teks tampilan menu |
| url | VARCHAR(255) | NULLABLE | URL kustom |
| category_id | BIGINT | FK → categories.id, NULLABLE | Link ke kategori |
| page_id | BIGINT | FK → pages.id, NULLABLE | Link ke halaman statis |
| order | INTEGER | DEFAULT 0 | Urutan tampilan |

#### 4.4.18 Tabel `pages`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| title | VARCHAR(255) | NOT NULL | Judul halaman |
| slug | VARCHAR(255) | UNIQUE, NOT NULL | URL-friendly identifier |
| content | LONGTEXT | NULLABLE | Konten halaman |
| template | VARCHAR(100) | DEFAULT 'default' | Template tampilan |
| created_at | TIMESTAMP | AUTO | Waktu pembuatan |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.19 Tabel `settings`
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| key | VARCHAR(255) | PK | Kunci pengaturan |
| value | TEXT | NULLABLE | Nilai pengaturan |

#### 4.4.20 Tabel `media` (Spatie MediaLibrary - Polymorphic)
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| model_type | VARCHAR(255) | INDEX | Tipe model (App\Models\Article, dll) |
| model_id | BIGINT | INDEX | ID model terkait |
| uuid | CHAR(36) | UNIQUE | UUID file |
| collection_name | VARCHAR(255) | NOT NULL | Nama koleksi (images, thumbnails) |
| name | VARCHAR(255) | NOT NULL | Nama file |
| file_name | VARCHAR(255) | NOT NULL | Nama file di disk |
| mime_type | VARCHAR(255) | NULLABLE | Tipe MIME |
| disk | VARCHAR(255) | NOT NULL | Storage disk |
| size | BIGINT | NOT NULL | Ukuran file (bytes) |
| custom_properties | JSON | NULLABLE | Metadata konversi WebP |
| created_at | TIMESTAMP | AUTO | Waktu upload |
| updated_at | TIMESTAMP | AUTO | Waktu pembaruan |

#### 4.4.21 Tabel `seo_metas` (Polymorphic)
| Kolom | Tipe Data | Constraint | Keterangan |
|-------|-----------|------------|------------|
| id | BIGINT | PK | Primary Key |
| model_type | VARCHAR(255) | INDEX | Tipe model |
| model_id | BIGINT | INDEX | ID model terkait |
| meta_title | VARCHAR(255) | NULLABLE | Judul SEO |
| meta_description | TEXT | NULLABLE | Deskripsi SEO |
| meta_keywords | VARCHAR(255) | NULLABLE | Kata kunci |
| og_image | VARCHAR(255) | NULLABLE | URL gambar Open Graph |
| schema_markup | JSON | NULLABLE | JSON-LD structured data |

### 4.5 Perancangan Antarmuka (UI/UX)

#### 4.5.1 Struktur Navigasi Utama (Navbar)

```
┌─────────────────────────────────────────────────────────────────────────┐
│ [LOGO]  Beranda │ Kategori ▾ │ Trending │ Video │ Opini │ Indeks │     │
│                                          Tentang│  🔍  🌙  Login   │
└─────────────────────────────────────────────────────────────────────────┘
```

**Detail Dropdown Kategori:**
- Nasional
- Internasional
- Politik
- Ekonomi & Bisnis
- Olahraga
- Teknologi
- Hiburan & Gaya Hidup

#### 4.5.2 Layout Halaman Beranda (Homepage)

```
┌─────────────────────────────────────────────────────────────────────────┐
│                           [TOP BANNER AD 728x90]                        │
├─────────────────────────────────────────────────────────────────────────┤
│                         HERO SECTION                                    │
│  ┌─────────────────────────────────────┐  ┌──────────────────────────┐ │
│  │                                     │  │  Berita Pendukung 1      │ │
│  │      HEADLINE UTAMA                 │  ├──────────────────────────┤ │
│  │      [Gambar Besar 800x500]         │  │  Berita Pendukung 2      │ │
│  │                                     │  ├──────────────────────────┤ │
│  │  Judul Berita Utama                 │  │  Berita Pendukung 3      │ │
│  │  Kategori • 2 jam lalu              │  └──────────────────────────┘ │
│  └─────────────────────────────────────┘                                │
├─────────────────────────────────────────────────────────────────────────┤
│                    BERITA TERKINI (Latest News)                         │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐                  │
│  │ [Gambar] │ │ [Gambar] │ │ [Gambar] │ │ [Gambar] │                  │
│  │  Judul   │ │  Judul   │ │  Judul   │ │  Judul   │                  │
│  │  Excerpt │ │  Excerpt │ │  Excerpt │ │  Excerpt │                  │
│  └──────────┘ └──────────┘ └──────────┘ └──────────┘                  │
├───────────────────────────────┬─────────────────────────────────────────┤
│   BLOK KATEGORI: OLAHRAGA     │         SIDEBAR                         │
│   [List berita olahraga]      │  ┌───────────────────────────────┐     │
├───────────────────────────────┤  │ 🔥 BERITA POPULER             │     │
│   BLOK KATEGORI: TEKNOLOGI    │  │ 1. Judul berita populer 1     │     │
│   [List berita teknologi]     │  │ 2. Judul berita populer 2     │     │
├───────────────────────────────┤  │ 3. Judul berita populer 3     │     │
│       [IN-CONTENT AD]         │  │ 4. Judul berita populer 4     │     │
│                               │  │ 5. Judul berita populer 5     │     │
│   BLOK KATEGORI: POLITIK      │  └───────────────────────────────┘     │
│   [List berita politik]       │  ┌───────────────────────────────┐     │
│                               │  │ 📊 JAJAK PENDAPAT              │     │
├───────────────────────────────┤  │ Apakah Anda setuju dengan...  │     │
│       [SIDEBAR AD 300x250]    │  │ ○ Ya    ○ Tidak   ○ Ragu      │     │
│                               │  └───────────────────────────────┘     │
├───────────────────────────────┤  ┌───────────────────────────────┏     │
│      BERITA VIDEO / GALERI    │  │ 🏷️ TAG POPULER                 │     │
│   [Grid thumbnail video]      │  │ #Pemilu #Ekonomi #Teknologi   │     │
│                               │  │ #Olahraga #Internasional      │     │
└───────────────────────────────┴──└───────────────────────────────┘     │
├─────────────────────────────────────────────────────────────────────────┤
│ [IN-CONTENT AD BANNER]                                                  │
├─────────────────────────────────────────────────────────────────────────┤
│                            FOOTER                                       │
│ Tentang Kami │ Pedoman Media Siber │ Kebijakan Privasi │ Kontak         │
│ [Social Media Icons]         © 2026 Portal Berita. All rights reserved │
└─────────────────────────────────────────────────────────────────────────┘
```

#### 4.5.3 Layout Halaman Artikel (Single Post)

```
┌─────────────────────────────────────────────────────────────────────────┐
│ [TOP BANNER AD 728x90]                                                  │
├───────────────────────────────┬─────────────────────────────────────────┤
│ ARTIKEL                       │ SIDEBAR                                │
│                               │                                        │
│ Kategori • 25 Juni 2026       │ ┌───────────────────────────────┐      │
│                               │ │ SIDEBAR AD (Sticky 300x250)   │      │
│ JUDUL BERITA UTAMA            │ └───────────────────────────────┘      │
│ [Sub-judul / Lead]            │                                        │
│                               │ ┌───────────────────────────────┐      │
│ [Gambar Hero + Caption]       │ │ 🔥 BERITA TERKAIT             │      │
│                               │ │ • Judul terkait 1             │      │
│ Oleh: Nama Penulis            │ │ • Judul terkait 2             │      │
│                               │ │ • Judul terkait 3             │      │
│ Paragraf 1...                 │ └───────────────────────────────┘      │
│ Paragraf 2...                 │                                        │
│                               │ ┌───────────────────────────────┐      │
│ ── [IN-ARTICLE AD] ──         │ │ 📊 POLL WIDGET                │      │
│                               │ └───────────────────────────────┘      │
│ Paragraf 3...                 │                                        │
│ Paragraf 4...                 │                                        │
│                               │                                        │
│ [LIVE UPDATE BOX - Jika ada]  │                                        │
│ ┌─────────────────────────┐   │                                        │
│ │ 🔴 LIVE UPDATE          │   │                                        │
│ │ 14:30 - Update terbaru  │   │                                        │
│ │ 14:15 - Update kedua    │   │                                        │
│ └─────────────────────────┘   │                                        │
│                               │                                        │
│ Tags: #Tag1 #Tag2 #Tag3       │                                        │
│                               │                                        │
│ ── Share: 📘 🐦 💬 📧 ──     │                                        │
│                               │                                        │
│ ── KOMENTAR (12) ──           │                                        │
│ [Form komentar]               │                                        │
│ [List komentar nested]        │                                        │
└───────────────────────────────┴─────────────────────────────────────────┘
```

### 4.6 Perancangan Strategi Monetisasi (Iklan)

#### 4.6.1 Peta Penempatan Iklan

| Kode Posisi | Lokasi | Ukuran Desktop | Ukuran Mobile | Tipe |
|---|---|---|---|---|
| `header` | Di bawah Navbar | 728 x 90 | 320 x 50 | Leaderboard |
| `in_content` | Setelah paragraf ke-3 | 336 x 280 | 300 x 250 | Rectangle |
| `sidebar` | Sticky di sidebar kanan | 300 x 250 | Tersembunyi | Rectangle |
| `in_feed` | Di antara list berita di Home | Native (menyerupai card berita) | Native | Native Ad |
| `anchor_bottom` | Sticky di bawah layar HP | Tersembunyi | 320 x 50 | Anchor |

#### 4.6.2 Implementasi Teknis Iklan di Laravel

**Pendekatan 1: Blade Component untuk AdSense**
```php
// resources/views/components/ad-banner.blade.php
@props(['position' => 'default', 'minHeight' => '90px'])

<div class="ad-container my-4 text-center bg-gray-50 border border-gray-200 
            flex items-center justify-center relative"
     style="min-height: {{ $minHeight }};"
     data-ad-position="{{ $position }}">
    {{ $slot }}
</div>
```

**Pendekatan 2: Direct Ads via Database**
```php
// AppServiceProvider.php - View Composer
View::composer('partials.sidebar', function ($view) {
    $view->with('sidebarAd', Ad::where('position', 'sidebar')
        ->where('is_active', true)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first());
});
```

#### 4.6.3 Aturan SEO untuk Iklan
- Semua link iklan keluar wajib menggunakan atribut `rel="sponsored nofollow"`.
- Setiap *container* iklan memiliki `min-height` CSS yang tetap untuk mencegah CLS.
- Iklan dimuat secara *lazy* menggunakan Intersection Observer API.
- Iklan tidak ditempatkan di atas *fold* pertama (Above-the-fold) untuk menjaga LCP.

---

## BAB V
## RENCANA IMPLEMENTASI

### 5.1 Teknologi yang Digunakan (Rangkuman)

```
╔══════════════════════════════════════════════════════════════════╗
║                    TECHNOLOGY STACK OVERVIEW                      ║
╠══════════════════════════════════════════════════════════════════╣
║                                                                  ║
║  BACKEND:                                                         ║
║  ├── Laravel 13 (PHP 8.4+)                                      ║
║  ├── Eloquent ORM (Database Abstraction)                        ║
║  ├── Laravel Scout + Meilisearch (Search)                       ║
║  ├── Laravel Reverb (WebSocket / Real-time)                     ║
║  ├── Laravel Queue (Async Job Processing)                       ║
║  └── Spatie MediaLibrary + Intervention Image (Media)           ║
║                                                                  ║
║  FRONTEND (TALL Stack):                                          ║
║  ├── Tailwind CSS 4 (Styling)                                   ║
║  ├── Alpine.js 3 (Lightweight JS Interactions)                  ║
║  ├── Livewire 3 (Reactive PHP Components)                       ║
║  └── Blade Templates (Server-Side Rendering untuk SEO)          ║
║                                                                  ║
║  ADMIN PANEL:                                                    ║
║  └── FilamentPHP 3 (TALL-based Admin Dashboard)                 ║
║                                                                  ║
║  DATA & INFRASTRUCTURE:                                          ║
║  ├── MySQL 8.0 (Primary Database)                               ║
║  ├── Redis 7 (Caching, Sessions, Queue Driver)                  ║
║  ├── Meilisearch (Full-text Search Engine)                      ║
║  └── Cloudflare (CDN, SSL, DDoS Protection)                    ║
║                                                                  ║
║  SERVER:                                                         ║
║  ├── Ubuntu 24.04 LTS                                           ║
║  ├── Nginx (Web Server)                                         ║
║  ├── PHP 8.4-FPM + OPcache                                     ║
║  └── Supervisor (Queue Worker Manager)                          ║
║                                                                  ║
║  DEVOPS:                                                         ║
║  ├── Git + GitHub (Version Control)                             ║
║  ├── Docker (Development Environment)                           ║
║  ├── GitHub Actions (CI/CD)                                     ║
║  └── Laravel Forge / Envoyer (Deployment)                       ║
║                                                                  ║
╚══════════════════════════════════════════════════════════════════╝
```

### 5.2 Struktur Direktori Proyek

```
portal-berita/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Frontend/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── ArticleController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── PageController.php
│   │   │   │   └── SearchController.php
│   │   │   └── Api/
│   │   │       └── TrackingController.php
│   │   └── Middleware/
│   │       ├── TrackPageView.php
│   │       ├── CacheResponse.php
│   │       └── RoleMiddleware.php
│   ├── Livewire/
│   │   ├── SearchDropdown.php
│   │   ├── PollWidget.php
│   │   ├── CommentSection.php
│   │   ├── BookmarkButton.php
│   │   ├── LiveUpdateFeed.php
│   │   └── NewsletterForm.php
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Category.php
│   │   ├── Tag.php
│   │   ├── Comment.php
│   │   ├── Ad.php
│   │   ├── Poll.php
│   │   ├── PollOption.php
│   │   ├── Page.php
│   │   ├── Menu.php
│   │   └── MenuItem.php
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── ArticleResource.php
│   │   │   ├── CategoryResource.php
│   │   │   ├── AdResource.php
│   │   │   ├── UserResource.php
│   │   │   ├── PollResource.php
│   │   │   ├── PageResource.php
│   │   │   ├── CommentResource.php
│   │   │   └── SettingResource.php
│   │   ├── Widgets/
│   │   │   ├── StatsOverview.php
│   │   │   ├── LatestArticles.php
│   │   │   └── TrafficChart.php
│   │   └── Pages/
│   │       └── Dashboard.php
│   ├── Services/
│   │   ├── SearchService.php
│   │   ├── SeoService.php
│   │   └── AnalyticsService.php
│   ├── Jobs/
│   │   ├── ConvertImageToWebP.php
│   │   ├── GenerateSitemap.php
│   │   ├── DispatchNewsletter.php
│   │   └── AggregateViewCounts.php
│   └── Observers/
│       ├── ArticleObserver.php (Cache invalidation)
│       └── CategoryObserver.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── CategorySeeder.php
│   │   ├── AdminUserSeeder.php
│   │   └── DemoArticleSeeder.php
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php (Master layout)
│   │   │   └── admin.blade.php
│   │   ├── frontend/
│   │   │   ├── home.blade.php
│   │   │   ├── article.blade.php
│   │   │   ├── category.blade.php
│   │   │   ├── page.blade.php
│   │   │   └── search.blade.php
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── article-card.blade.php
│   │   │   ├── ad-banner.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   ├── hero-section.blade.php
│   │   │   ├── seo-meta.blade.php
│   │   │   └── breadcrumbs.blade.php
│   │   └── partials/
│   │       ├── popular-widget.blade.php
│   │       ├── tags-cloud.blade.php
│   │       └── newsletter-form.blade.php
│   ├── css/
│   │   └── app.css (Tailwind directives)
│   └── js/
│       ├── app.js
│       ├── lazy-load-ads.js
│       └── echo.js (Laravel Echo for Reverb)
├── public/
│   ├── ads.txt
│   ├── robots.txt
│   └── sitemap.xml (Generated)
├── routes/
│   ├── web.php
│   ├── channels.php (Broadcasting)
│   └── api.php
├── storage/
│   └── app/
│       └── public/
│           └── media/ (Uploaded images & WebP conversions)
├── docker/
│   ├── docker-compose.yml
│   ├── Dockerfile
│   └── nginx/
│       └── default.conf
├── .env.example
├── vite.config.js
└── composer.json
```

### 5.3 Rencana Pengujian

| No | Jenis Pengujian | Alat | Kriteria Keberhasilan |
|----|-----------------|------|-----------------------|
| 1 | Unit Testing | PHPUnit / Pest | Semua method di Service dan Model lulus |
| 2 | Feature Testing | Laravel HTTP Tests | Semua route dan form berfungsi tanpa error |
| 3 | Load Testing | k6 / Apache Bench | Server bertahan pada 500 concurrent request tanpa error 5xx |
| 4 | Security Audit | OWASP ZAP | Tidak ditemukan celah XSS, CSRF, SQL Injection |
| 5 | SEO Audit | Google Lighthouse | Skor Performance > 85, SEO > 90, Accessibility > 90 |
| 6 | Cross-Browser | BrowserStack | Tampilan konsisten di Chrome, Firefox, Safari, Edge |
| 7 | Responsive Test | Chrome DevTools | Layout benar pada breakpoint 375px, 768px, 1024px, 1440px |
| 8 | Uptime Monitoring | UptimeRobot | Uptime > 99.5% selama periode pengujian 30 hari |

---

## BAB VI
## PENUTUP

### 6.1 Kesimpulan

Berdasarkan analisis dan perancangan yang telah dilakukan, dapat disimpulkan bahwa:

1. Pengembangan portal berita digital menggunakan **Laravel 13** dengan arsitektur **TALL Stack** merupakan pilihan yang optimal karena menggabungkan kemudahan pengembangan (*developer experience*) dengan performa tinggi (*runtime performance*) dan SEO yang sempurna melalui *Server-Side Rendering*.

2. Perancangan database yang komprehensif dengan **21 tabel** mencakup seluruh aspek operasional portal berita modern: manajemen konten, alur kerja editorial, interaksi pembaca, monetisasi iklan, analitik, dan CMS dinamis. Penggunaan *polymorphic relations* untuk media dan SEO meta menjadikan arsitektur database bersih dan ter-*extend*.

3. Integrasi **Meilisearch** melalui Laravel Scout akan memberikan pengalaman pencarian yang superior dibandingkan query database tradisional, terutama ketika volume artikel mencapai puluhan ribu.

4. Strategi monetisasi yang terstruktur dengan manajemen iklan dinamis berbasis database memungkinkan fleksibilitas penuh dalam penempatan, penjadwalan, dan pelacakan performa iklan tanpa bergantung pada *hardcoded* konfigurasi.

5. Implementasi **Redis caching**, konversi gambar otomatis ke **WebP**, dan integrasi **Cloudflare CDN** memastikan website dapat melayani ribuan pengunjung bersamaan dengan waktu muat di bawah 2,5 detik.

6. Fitur **live blogging** melalui Laravel Reverb memberikan nilai tambah kompetitif dalam peliputan berita *breaking news* dan peristiwa yang sedang berlangsung.

### 6.2 Saran

1. **Pengembangan Lanjutan:** Pada fase berikutnya, disarankan untuk mengembangkan aplikasi mobile (PWA atau native) yang terhubung ke Laravel API untuk memperluas jangkauan pembaca.

2. **Integrasi AI:** Mempertimbangkan integrasi model AI untuk fitur-fitur seperti auto-generate excerpt, rekomendasi artikel (*collaborative filtering*), dan deteksi konten duplikat.

3. **Paywall System:** Jika model bisnis mengarah ke konten premium, integrasikan payment gateway (seperti Midtrans atau Stripe) untuk mengimplementasikan sistem berlangganan.

4. **Multi-tenancy:** Jika portal berita akan memiliki beberapa sub-brand atau edisi regional, pertimbangkan implementasi arsitektur multi-tenancy pada Laravel.

5. **Monitoring & Observability:** Implementasikan Laravel Telescope untuk debugging dan Sentry untuk error tracking di lingkungan produksi.

---

## DAFTAR PUSTAKA

1. Laravel LLC. (2026). *Laravel 13 Documentation*. https://laravel.com/docs/13.x

2. FilamentPHP. (2026). *Filament v3 Documentation*. https://filamentphp.com/docs

3. Livewire. (2026). *Livewire v3 Documentation*. https://livewire.laravel.com/docs

4. Meilisearch. (2026). *Meilisearch Documentation*. https://www.meilisearch.com/docs

5. Tailwind Labs. (2026). *Tailwind CSS v4 Documentation*. https://tailwindcss.com/docs

6. Spatie. (2026). *Laravel MediaLibrary Documentation*. https://spatie.be/docs/laravel-medialibrary

7. Redis Ltd. (2026). *Redis Documentation*. https://redis.io/docs

8. Wardhana, A. (2023). *Jurnalistik Digital: Teori dan Praktik Portal Berita Modern*. Jakarta: Penerbit Kompas.

9. Reuters Institute for the Study of Journalism. (2025). *Digital News Report 2025*. University of Oxford.

10. Google Developers. (2026). *Core Web Vitals*. https://web.dev/vitals/

11. Google Developers. (2026). *Search Engine Optimization (SEO) Starter Guide*. https://developers.google.com/search/docs

12. OWASP Foundation. (2025). *OWASP Top 10 Web Application Security Risks*. https://owasp.org/www-project-top-ten/

13. World Wide Web Consortium (W3C). (2023). *Web Content Accessibility Guidelines (WCAG) 2.1*. https://www.w3.org/TR/WCAG21/

14. Schema.org. (2026). *NewsArticle Type Documentation*. https://schema.org/NewsArticle

---

> **Catatan:** Dokumen proposal ini disusun sebagai panduan komprehensif untuk pengembangan sistem portal berita digital. Seluruh rancangan teknis, arsitektur database, dan strategi implementasi telah disesuaikan dengan standar industri dan praktik terbaik (*best practices*) dalam pengembangan web modern per tahun 2026.