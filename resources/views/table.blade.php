@extends('layout.template')

@section('content')
    <div class="mb-4">
        <h3 class="text-center fw-bold text-success">📊 Rekapitulasi Pengolahan Tata Ruang</h3>
    </div>

    {{-- TABLE POINT --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white fw-semibold">
            Pengaduan Fasilitas Umum
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center" id="pointstable">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Dibuat</th>
                        <th>Diupdate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($points as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" width="100" class="img-thumbnail">
                                @else - @endif
                            </td>
                            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $p->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABLE POLYLINE --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white fw-semibold">
            Pengaduan Jalan / Sungai
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center" id="polylinestable">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Dibuat</th>
                        <th>Diupdate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($polylines as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->description }}</td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" width="100" class="img-thumbnail">
                                @else - @endif
                            </td>
                            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $p->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABLE POLYGON --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white fw-semibold">
            Pengajuan Alih Fungsi Lahan
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center" id="polygontable">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Jenis Pengajuan</th>
                        <th>Kontak</th>
                        <th>Alih Fungsi</th>
                        <th>Deskripsi Sebelum</th>
                        <th>Deskripsi Pengajuan</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Surat Permohonan</th>
                        <th>KTP</th>
                        <th>Sertifikat</th>
                        <th>Foto Lokasi</th>
                        <th>Dibuat</th>
                        <th>Diupdate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($polygon as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->username }}</td>
                            <td>{{ $p->contact_person }}</td>
                            <td>{{ $p->land_use_change }}</td>
                            <td>{{ $p->description }}</td>
                            <td>{{ $p->description_suggestion }}</td>
                            <td>{{ $p->type }}</td>
                            <td>
                                <span class="badge bg-{{ $p->status == 'pending' ? 'warning' : 'success' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" width="100" class="img-thumbnail">
                                @else - @endif
                            </td>
                            <td>
                                @if ($p->surat_permohonan)
                                    <a href="{{ asset('storage/images/' . $p->surat_permohonan) }}" target="_blank">Download</a>
                                @else - @endif
                            </td>
                            <td>
                                @if ($p->foto_ktp)
                                    <img src="{{ asset('storage/images/' . $p->foto_ktp) }}" width="100" class="img-thumbnail">
                                @else - @endif
                            </td>
                            <td>
                                @if ($p->sertifikat_tanah)
                                    <a href="{{ asset('storage/images/' . $p->sertifikat_tanah) }}" target="_blank">Download</a>
                                @else - @endif
                            </td>
                            <td>
                                @if ($p->foto_lokasi)
                                    <img src="{{ asset('storage/images/' . $p->foto_lokasi) }}" width="100" class="img-thumbnail">
                                @else - @endif
                            </td>
                            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $p->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #fefefc;
        }

        .table img {
            max-height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .table td, .table th {
            vertical-align: middle !important;
        }

        .card-header {
            font-size: 1.1rem;
            background: linear-gradient(to right, #e8f5e2, #fff7d6); /* soft green to pastel yellow */
            color: #305030;
            border-bottom: 2px solid #d4d4aa;
        }

        .table-success {
            background-color: #f4f9ed !important;
        }

        .badge {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .badge.bg-success {
            background-color: #c5e1b8 !important;
            color: #2f4f2f;
        }

        .badge.bg-warning {
            background-color: #fff3cd !important;
            color: #665c00;
        }

        .card {
            border: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #fcfcf7; /* very soft off-white */
        }

        .table-striped > tbody > tr:hover {
            background-color: #fffbd8;
        }
    </style>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#pointstable');
        new DataTable('#polylinestable');
        new DataTable('#polygontable');
    </script>
@endsection
