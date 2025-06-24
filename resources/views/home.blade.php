@extends('layout.template')

@section('content')
    <div class="container py-5">

        <!-- Hero Section -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/salataru-logo.png') }}" alt="Logo Salataru"
                        style="height: 60px; width: auto; margin-right: 12px;">
                    <div>
                        <h1 class="fw-bold text-success mb-1">SalaTaru</h1>
                        <div class="text-muted small fst-italic">Temukan, Laporkan, Rencanakan Ruangmu</div>
                    </div>
                </div>
                <p class="fs-5 text-muted">
                    Sistem Informasi Geospasial untuk mendukung pengelolaan, pengawasan, dan partisipasi masyarakat
                    dalam perencanaan tata ruang yang berkelanjutan.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('map') }}#aduan-fasos" class="btn btn-lg rounded-pill shadow"
                        style="background-color: #A8D5BA; color: #155724;">
                        <i class="fa-solid fa-city"></i> Fasilitas Umum
                    </a>
                    <a href="{{ route('map') }}#aduan-jalan" class="btn btn-lg rounded-pill shadow"
                        style="background-color: #FFE49E; color: #856404;">
                        <i class="fa-solid fa-road"></i> Jalan & Sungai
                    </a>
                    <a href="{{ route('map') }}#kkpr" class="btn btn-lg rounded-pill shadow"
                        style="background-color: #A7D8FF; color: #004085;">
                        <i class="fa-solid fa-file-signature"></i> Pengajuan KKPR
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/salatiga1.png') }}" class="img-fluid rounded shadow" alt="GIS Salatiga"
                    style="max-height: 400px; object-fit: cover;">
            </div>
        </div>

        <!-- Penjelasan Umum -->
        <div class="row mb-5">
            <div class="col-md-10 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-body fs-6">
                        <p><strong>Tata Ruang</strong> adalah proses penataan dan pemanfaatan ruang secara berkelanjutan
                            dengan memperhatikan keseimbangan antara lingkungan, sosial, dan ekonomi. Web GIS ini hadir
                            sebagai solusi interaktif untuk memetakan fungsi ruang di Kota Salatiga serta menampung aspirasi
                            masyarakat melalui pengaduan dan pengajuan alih fungsi lahan (KKPR).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ketentuan Khusus Tata Ruang -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        📌 Ketentuan Khusus Tata Ruang Kota Salatiga
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-success text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 220px;">Kawasan</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><strong>Kawasan Lahan Pertanian Pangan Berkelanjutan (LP2B)</strong></td>
                                        <td>a. Lahan yang sudah ditetapkan sebagai LP2B dilindungi dan dilarang
                                            dialihfungsikan; b. LP2B dapat dialihfungsikan dan dilaksanakan sesuai dengan
                                            ketentuan peraturan perundang-undangan untuk kepentingan umum dan/atau proyek
                                            strategis nasional; dan; c. ketentuan intensitas Pemanfaatan Ruang LP2B
                                            meliputi: 1. KDB paling besar 10% (sepuluh persen); dan 2. KLB paling besar 0,2
                                            (nol koma dua).</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td><strong>Kawasan Rawan Bencana</strong></td>
                                        <td>a. Kawasan peruntukan industri</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td><strong>Kawasan Cagar Budaya</strong></td>
                                        <td>a. Kegiatan yang diperbolehkan berupa pelestarian cagar budaya</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td><strong>Kawasan Resapan Air</strong></td>
                                        <td>a. Kegiatan yang diperbolehkan berupa rehabilitasi lahan</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td><strong>Kawasan Sempadan Sungai</strong></td>
                                        <td>a. Pemanfaatan diperbolehkan/diizinkan berupa kegiatan RTH publik</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">6</td>
                                        <td><strong>Kawasan Sempadan Mata Air</strong></td>
                                        <td>a. Pemanfaatan diperbolehkan/diizinkan berupa kegiatan RTH publik</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">7</td>
                                        <td><strong>Kawasan Sempadan Ketenagalistrikan</strong></td>
                                        <td>Tidak diperbolehkan mendirikan bangunan di sepanjang jaringan transmisi
                                            listrik</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">8</td>
                                        <td><strong>Kawasan TEB</strong></td>
                                        <td>a. Diperbolehkan fasilitas umum dengan syarat menunjang fungsi.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peraturan Zonasi Tata Ruang -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        📌 Peraturan Zonasi Tata Ruang
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-success text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 250px;">Kawasan</th>
                                        <th>Ketentuan</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><strong>TPZ Conditional Uses</strong></td>
                                        <td>diperbolehkan kegiatan industri dengan syarat tidak berpotensi menimbulkan
                                            pencemaran lingkungan hidup yang berdampak luas, dan dilengkapi kajian pendukung
                                            lainnya sesuai ketentuan yang berlaku;</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td><strong>TPZ Zona Pengendalian Pertumbuhan</strong></td>
                                        <td>tidak diperbolehkan membangun dan/atau mengembangkan kegiatan Karaoke, Klub
                                            Malam, Diskotek, Aktivitas SPA (Sante Par Aqua) dan Rumah Pijat kecuali yang
                                            sudah terbangun sebelum berlakunya peraturan Wali Kota ini</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td><strong>TPZ lainnya</strong></td>
                                        <td>a. Zona yang masih berstatus LSD namun terdapat pertampalan dengan TPZ LSD
                                            dikenakan pengaturan Zonasi sebagaimana Zona pertanian tanaman pangan dengan
                                            kode P-1; b. ketentuan sebagaimana dimaksud pada huruf a dikecualikan bagi lahan
                                            yang mendapatkan rekomendasi perubahan penggunaan tanah dari menteri yang
                                            menyelenggarakan urusan pemerintahan di bidang agraria dan tata ruang; dan c.
                                            Zona yang terdapat pertampalan TPZ LSD namun sudah mendapatkan rekomendasi
                                            perubahan penggunaan tanah dari Menteri yang menyelenggarakan urusan
                                            pemerintahan di bidang agraria dan tata ruang dapat dimanfaatkan sesuai dengan
                                            pola ruang.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penjelasan Data Tata Ruang -->
        <div class="row mb-5">
            <div class="col-md-10 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        📌 Kategori Data Tata Ruang
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Berikut adalah kategori pemanfaatan ruang yang tersedia pada peta interaktif:</p>
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                            @php
                                $legend = [
                                    'Badan Air' => '#c5ecff',
                                    'Badan Jalan' => '#ec573b',
                                    'Hortikultura' => '#f3df72',
                                    'Jalur Hijau' => '#28e421',
                                    'Kawasan Peruntukan Industri' => '#660000',
                                    'Pariwisata' => '#e6a1e1',
                                    'Pemakaman' => '#99ff99',
                                    'Pembangkit Tenaga Listrik' => '#00ffff',
                                    'Pengelolaan Persampahan' => '#ff9900',
                                    'Perdagangan dan Jasa Skala Kota' => '#ff9999',
                                    'Perdagangan dan Jasa Skala WP' => '#ffb6b6',
                                    'Perikanan Budi Daya' => '#66ccff',
                                    'Perkantoran' => '#cccccc',
                                    'Perkebunan' => '#999933',
                                    'Perlindungan Setempat' => '#33ccff',
                                    'Pertahanan dan Keamanan' => '#9900cc',
                                    'Perumahan Kepadatan Sedang' => '#ffff33',
                                    'Perumahan Kepadatan Tinggi' => '#ffcc00',
                                    'Rimba Kota' => '#336600',
                                    'Ruang Terbuka Non Hijau' => '#999999',
                                    'SPU Skala Kecamatan' => '#cc66ff',
                                    'SPU Skala Kelurahan' => '#9933ff',
                                    'SPU Skala Kota' => '#6600cc',
                                    'Taman Kecamatan' => '#006600',
                                    'Taman Kelurahan' => '#00cc00',
                                    'Taman Kota' => '#99ff99',
                                    'Tanaman Pangan' => '#66ffcc',
                                    'Transportasi' => '#cc3300',
                                ];
                            @endphp
                            @foreach ($legend as $name => $color)
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        style="width: 18px; height: 18px; background-color: {{ $color }}; border: 1px solid #aaa; border-radius: 4px;">
                                    </div>
                                    <span class="small text-dark">{{ $name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-muted small mt-5">
            &copy; {{ date('Y') }} Web GIS Tata Ruang Kota Salatiga | Disperkim
        </div>
    </div>
@endsection
