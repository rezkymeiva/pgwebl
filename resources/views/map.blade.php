@extends('layout.template')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        /* === GLOBAL === */
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* === NAVBAR CANTIK SAGE PROFESSIONAL === */
        .navbar {
            background: linear-gradient(to right, #c8d5b9, #a7c7a3);
            padding: 0.8rem 1.5rem;
            height: 64px;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #2e4e1e !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: #446c39;
        }

        .navbar-nav .nav-link {
            color: #2f4f4f !important;
            font-weight: 500;
            border-radius: 10px;
            padding: 8px 14px;
            margin: 0 4px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
            color: #1d2c1d !important;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            background-color: #f7faf7;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        }

        .dropdown-item:hover {
            background-color: #dfeede;
            color: #2e4e1e;
            border-radius: 8px;
        }

        .nav-link.text-danger {
            color: #b30000 !important;
        }

        .nav-link.text-primary {
            color: #206030 !important;
            font-weight: 600;
        }

        .navbar-toggler {
            border: none;
            background-color: rgba(255, 255, 255, 0.4);
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23333' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0,0,0,0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* === CARD === */
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            background-color: #fff;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(90deg, #c8d5b9, #a7c7a3);
            color: #556b2f;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }

        .card-body {
            background-color: white;
            padding: 1.5rem;
        }

        /* === MAP === */
        #map {
            height: calc(100vh - 72px);
            width: 100%;
            margin-top: 0.5rem;
            border: 3px solid #a7c7a3;
            border-radius: 12px;
        }

        .leaflet-container {
            border-radius: 12px;
        }

        /* === LEGEND (CUSTOM) === */
        .custom-legend {
            background: white;
            border-radius: 12px;
            max-width: 450px;
            font-size: 13px;
            color: #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-height: 260px;
            padding: 0.8rem 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .legend-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .legend-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
        }

        .legend-color {
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            margin-right: 6px;
            border-radius: 4px;
        }

        .legend-label {
            font-size: 12.5px;
            word-break: break-word;
        }

        /* === BUTTONS === */
        .btn-success {
            background-color: #a7c7a3;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-success:hover {
            background-color: #8daa91;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #6e8f62;
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #597552;
            transform: translateY(-2px);
        }

        .btn-secondary {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
        }

        /* === MODAL === */
        .modal-content {
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .modal-content:hover {
            transform: scale(1.01);
        }

        .modal-header {
            background: linear-gradient(90deg, #a7c7a3, #6e8f62);
            color: #ffffff;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-bottom: none;
            text-align: center;
            padding: 1.5rem;
        }

        .modal-title {
            font-size: 1.7rem;
            font-weight: 700;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6e8f62;
            box-shadow: 0 0 0 0.2rem rgba(110, 143, 98, 0.25);
        }

        .btn-close {
            filter: brightness(0.7);
            transition: filter 0.2s;
        }

        .btn-close:hover {
            filter: brightness(1);
        }

        /* === LEAFLET TOOLBAR === */
        .leaflet-draw-toolbar a {
            background-color: #849189 !important;
            border: 1px solid #849189 !important;
            border-radius: 6px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        }

        .leaflet-draw-toolbar a:hover {
            background-color: #7a867f !important;
        }

        .leaflet-draw-toolbar {
            border-radius: 10px;
            padding: 4px;
        }

        .leaflet-control-zoom {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .leaflet-control-zoom a {
            background-color: #849189 !important;
            border-bottom: 1px solid #849189;
            color: #2f4f4f !important;
            font-weight: bold;
        }

        .leaflet-control-zoom a:hover {
            background-color: #7a867f !important;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }

            .navbar-nav .nav-link {
                padding: 6px 10px;
                font-size: 0.9rem;
            }

            #map {
                height: 70vh;
            }

            .custom-legend {
                font-size: 12px;
                max-height: 180px;
            }
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <div class="mb-3">
        <label class="form-label">Cari Koordinat (Latitude, Longitude)</label>
        <div class="d-flex gap-2">
            <input type="text" id="latitude" class="form-control" placeholder="Latitude">
            <input type="text" id="longitude" class="form-control" placeholder="Longitude">
            <button class="btn btn-primary" onclick="searchCoordinate()">Cari</button>
        </div>
    </div>


    <!-- Modal Create Point -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengaduan Kerusakan Fasilitas Umum</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Kerusakan</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Kerusakan dan Foto Lokasi</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                width="250">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polyline-->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengaduan Kerusakan Jalan atau Sungai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Kerusakan</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                width="250">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygon-->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Biar lebih lebar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan KKPR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polygon.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill polygon name">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter username">
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person"
                                placeholder="Enter contact person">
                        </div>

                        <div class="mb-3">
                            <label for="land_use_change" class="form-label">Land Use Change</label>
                            <input type="text" class="form-control" id="land_use_change" name="land_use_change"
                                placeholder="Enter land use change info">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="description_suggestion" class="form-label">Description Suggestion</label>
                            <textarea class="form-control" id="description_suggestion" name="description_suggestion" rows="3"
                                placeholder="Enter suggestion"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3" placeholder="Enter geometry"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="Polygon">Polygon</option>
                                <option value="Point">Point</option>
                                <option value="LineString">LineString</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="pending" selected>Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygon" class="img-thumbnail mt-2"
                                width="250">
                        </div>

                        <div class="mb-3">
                            <label for="surat_permohonan" class="form-label">Surat Permohonan</label>
                            <input type="file" class="form-control" id="surat_permohonan" name="surat_permohonan">
                        </div>

                        <div class="mb-3">
                            <label for="foto_ktp" class="form-label">Foto KTP</label>
                            <input type="file" class="form-control" id="foto_ktp" name="foto_ktp">
                        </div>

                        <div class="mb-3">
                            <label for="sertifikat_tanah" class="form-label">Sertifikat Tanah</label>
                            <input type="file" class="form-control" id="sertifikat_tanah" name="sertifikat_tanah">
                        </div>

                        <div class="mb-3">
                            <label for="foto_lokasi" class="form-label">Foto Lokasi</label>
                            <input type="file" class="form-control" id="foto_lokasi" name="foto_lokasi">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script src="https://unpkg.com/leaflet.wms@1.0.0/dist/leaflet.wms.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


    <script>
        var map = L.map('map').setView([-7.330873015079398, 110.50849228886244], 15);

        // Basemap Esri
        var esriWorldImagery = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye'
            }
        );

        // Basemap OSM
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        esriWorldImagery.addTo(map);

        var baseMaps = {
            "Esri World Imagery": esriWorldImagery,
            "OpenStreetMap": osm
        };

        // Leaflet Geocoder Search
        L.Control.geocoder({
            defaultMarkGeocode: true
        }).addTo(map);

        // Search by Manual Coordinate
        function searchCoordinate() {
            var lat = document.getElementById('latitude').value;
            var lng = document.getElementById('longitude').value;

            if (lat && lng) {
                var newLatLng = new L.LatLng(lat, lng);
                map.setView(newLatLng, 18);

                // Tambah marker
                L.marker(newLatLng).addTo(map)
                    .bindPopup("Lokasi: " + lat + ", " + lng)
                    .openPopup();
            } else {
                alert('Masukkan Latitude dan Longitude yang valid.');
            }
        }


        // Legend
        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'custom-legend card p-3 shadow');

            var categories = [{
                    name: 'Badan Air',
                    color: '#c5ecff'
                },
                {
                    name: 'Badan Jalan',
                    color: '#ec573b'
                },
                {
                    name: 'Hortikultura',
                    color: '#E6FF4B'
                },
                {
                    name: 'Jalur Hijau',
                    color: '#28e421'
                },
                {
                    name: 'Kawasan Peruntukan Industri',
                    color: '#660000'
                },
                {
                    name: 'Pariwisata',
                    color: '#e6a1e1'
                },
                {
                    name: 'Pemakaman',
                    color: '#99ff99'
                },
                {
                    name: 'Pembangkit Tenaga Listrik',
                    color: '#00ffff'
                },
                {
                    name: 'Pengelolaan Persampahan',
                    color: '#ff9900'
                },
                {
                    name: 'Perdagangan dan Jasa Skala Kota',
                    color: '#ff9999'
                },
                {
                    name: 'Perdagangan dan Jasa Skala WP',
                    color: '#ffb6b6'
                },
                {
                    name: 'Perikanan Budi Daya',
                    color: '#66ccff'
                },
                {
                    name: 'Perkantoran',
                    color: '#cccccc'
                },
                {
                    name: 'Perkebunan',
                    color: '#999933'
                },
                {
                    name: 'Perlindungan Setempat',
                    color: '#33ccff'
                },
                {
                    name: 'Pertahanan dan Keamanan',
                    color: '#9900cc'
                },
                {
                    name: 'Perumahan Kepadatan Sedang',
                    color: '#ffff33'
                },
                {
                    name: 'Perumahan Kepadatan Tinggi',
                    color: '#ffcc00'
                },
                {
                    name: 'Rimba Kota',
                    color: '#336600'
                },
                {
                    name: 'Ruang Terbuka Non Hijau',
                    color: '#999999'
                },
                {
                    name: 'SPU Skala Kecamatan',
                    color: '#cc66ff'
                },
                {
                    name: 'SPU Skala Kelurahan',
                    color: '#9933ff'
                },
                {
                    name: 'SPU Skala Kota',
                    color: '#6600cc'
                },
                {
                    name: 'Taman Kecamatan',
                    color: '#006600'
                },
                {
                    name: 'Taman Kelurahan',
                    color: '#00cc00'
                },
                {
                    name: 'Taman Kota',
                    color: '#99ff99'
                },
                {
                    name: 'Tanaman Pangan',
                    color: '#66ffcc'
                },
                {
                    name: 'Transportasi',
                    color: '#cc3300'
                }
            ];


            div.innerHTML += '<h6 style="font-weight: 600; margin-bottom: 10px;">Legenda</h6>';
            div.innerHTML += '<div class="legend-grid">';

            categories.forEach(function(category) {
                div.innerHTML +=
                    '<div class="legend-item mb-1 d-flex align-items-center">' +
                    '<span class="legend-color" style="display:inline-block; width:15px; height:15px; background:' +
                    category.color + '; margin-right:8px; border:1px solid #000;"></span>' +
                    '<span class="legend-label">' + category.name + '</span>' +
                    '</div>';
            });

            div.innerHTML += '</div>';

            return div;
        };

        legend.addTo(map);




        // WMS Layer (GeoServer)
        var wmsLayer = L.tileLayer.wms('http://localhost:8080/geoserver/salatiga/wms', {
            layers: 'salatiga:Data_Responsi',
            format: 'image/png',
            transparent: true,
            attribution: "RTRW Kota Salatiga"
        });

        // Layer Control (Base Map dan Overlay)

        var overlayMaps = {
            "Pola Ruang Kota Salatiga": wmsLayer
        };

        // Tambahkan Layer Control ke Map
        L.control.layers(baseMaps, overlayMaps, {
            collapsed: false
        }).addTo(map);


        // Digitize Function
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: true,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            if (type === 'polyline') {
                $('#geom_polyline').val(objectGeometry);
                $('#createpolylineModal').modal('show');
            } else if (type === 'polygon' || type === 'rectangle') {
                $('#geom_polygon').val(objectGeometry);
                $('#createpolygonModal').modal('show');
            } else if (type === 'marker') {
                $('#geom_point').val(objectGeometry);
                $('#createpointModal').modal('show');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('points.destroy', ':id') }}".replace(':id', feature.properties.id);
                var routeedit = "{{ route('points.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                    "' width='200' alt=''>" + "<br>" +
                    "<div class='row mt-4'>" +
                    "<div class='col-6 text-start'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-end'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    '@csrf' + '@method('DELETE')' +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`sure it will be deleted`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>" + "<br>" + "<p>Dibuat:" + feature.properties.user_created + "</p>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name).openTooltip();
                    },
                });
            },
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polylines
        var polyline = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "#e34040",
                    weight: 3,
                    opacity: 1
                };
            },
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polylines.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polylines.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Panjang: " + feature.properties.length_km + " km<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                    "' width='200' alt=''>" + "<br>" +
                    "<div class='row mt-4'>" +
                    "<div class='col-6 text-start'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-end'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    '@csrf' + '@method('DELETE')' +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`sure it will be deleted?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>" + "<br>" + "<p>Dibuat:" + feature.properties.user_created + "</p>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name).openTooltip();
                    },
                });
            },
        });

        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        // GeoJSON Polygons
        var polygon = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "#5b2a46",
                    fillColor: "#d14d97",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.2
                };
            },
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polygon.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polygon.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Luas: " + feature.properties.luas_hektar + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                    "' width='200' alt=''>" + "<br>" +
                    "<div class='row mt-4'>" +
                    "<div class='col-6 text-start'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-end'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    '@csrf' + '@method('DELETE')' +
                    "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(`sure it will be deleted?`)'><i class='fa-solid fa-trash'></i></button>" +
                    "</form>" +
                    "</div>" +
                    "</div>" + "<br>" + "<p>Dibuat:" + feature.properties.user_created + "</p>";

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name).openTooltip();
                    },
                });
            },
        });

        $.getJSON("{{ route('api.polygon') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // Layer Control
        var overlayMaps = {
            "Points": point,
            "Polylines": polyline,
            "Polygons": polygon
        };

        L.control.layers(null, overlayMaps, {
            position: 'topright'
        }).addTo(map);
    </script>
@endsection
