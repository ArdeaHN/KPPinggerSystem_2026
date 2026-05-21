<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kulon Progo PINGER - Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body { margin: 0; padding: 0; background-color: #f3f4f6; }
        #map { height: calc(100vh - 80px); width: 100%; z-index: 1; }
        .leaflet-popup-content-wrapper { border-radius: 8px; }
        .status-on { color: #16a34a; font-weight: bold; } /* Hijau Tailwind */
        .status-off { color: #dc2626; font-weight: bold; } /* Merah Tailwind */
    </style>
</head>
<body class="antialiased">

    <header class="bg-slate-800 text-white p-4 shadow-md flex justify-between items-center h-[80px]">
        <div>
            <h1 class="text-2xl font-bold tracking-wider">KP TOPOLOGY PINGER</h1>
            <p class="text-sm text-slate-300">Live Geographic Status: 42 OPD Kulon Progo</p>
        </div>
        
        <nav class="flex gap-6">
            <a href="#" class="hover:text-teal-400 border-b-2 border-teal-400 pb-1">Dashboard</a>    
            
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300 ml-4">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-teal-400 hover:text-teal-300 ml-4 font-bold">Login</a>
            @endauth
        </nav>
    </header>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Inisialisasi Peta Kulon Progo
            var map = L.map('map').setView([-7.8286, 110.1384], 11);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap | KP Pinger'
            }).addTo(map);

            var devices = @json($devices ?? []);
            var links = @json($links ?? []);
            
            var deviceCoordinates = {};
            var groupedDevices = {}; // Objek untuk mengelompokkan perangkat

            // 2. Kelompokkan perangkat berdasarkan koordinat yang persis sama
            devices.forEach(function(device) {
                if (device.latitude && device.longitude) {
                    // Simpan koordinat asli untuk pembuatan garis/link
                    let lat = parseFloat(device.latitude);
                    let lng = parseFloat(device.longitude);
                    deviceCoordinates[device.id] = [lat, lng];

                    // Buat 'kunci' unik dari gabungan koordinat
                    let coordKey = lat.toFixed(6) + "_" + lng.toFixed(6);

                    // Masukkan perangkat ke dalam kelompok koordinat tersebut
                    if (!groupedDevices[coordKey]) {
                        groupedDevices[coordKey] = [];
                    }
                    groupedDevices[coordKey].push(device);
                }
            });

            // 3. Render Titik Penanda (Marker) dari data yang sudah dikelompokkan
            for (let key in groupedDevices) {
                let locationDevices = groupedDevices[key]; // Array perangkat di titik ini
                let lat = parseFloat(key.split('_')[0]);
                let lng = parseFloat(key.split('_')[1]);

                // Cek apakah ada perangkat yang OFF di lokasi ini?
                let isAnyOffline = locationDevices.some(d => d.is_online == false);
                
                // Jika ada 1 saja yang mati, warnai marker jadi merah. Jika semua hidup, hijau.
                var markerColor = isAnyOffline ? '#dc2626' : '#16a34a'; 
                
                // Jika titik ini berisi lebih dari 1 perangkat, buat radius markernya sedikit lebih besar
                var markerRadius = locationDevices.length > 1 ? 11 : 8; 

                var marker = L.circleMarker([lat, lng], {
                    color: markerColor,
                    fillColor: markerColor,
                    fillOpacity: 0.9,
                    radius: markerRadius,
                    weight: 2
                }).addTo(map);

                // 4. Susun isi Popup secara dinamis
                let popupHtml = `<div style="min-width: 220px;">`;
                
                // Header jumlah perangkat
                if (locationDevices.length > 1) {
                    popupHtml += `<div style="background:#1e293b; color:white; padding:4px; text-align:center; border-radius:4px; margin-bottom:8px; font-size:12px; font-weight:bold;">
                        Terdapat ${locationDevices.length} Perangkat
                    </div>`;
                }

                // Looping semua perangkat di lokasi ini ke dalam popup
                locationDevices.forEach(function(d, index) {
                    let statusText = d.is_online ? '<strong style="color:green;">ON</strong>' : '<strong style="color:red;">DOWN</strong>';
                    
                    // Tambahkan garis bawah pemisah jika ada banyak perangkat (kecuali yang terakhir)
                    let borderBottom = (index !== locationDevices.length - 1) ? 'border-bottom: 1px dashed #ccc; margin-bottom: 8px; padding-bottom: 8px;' : '';

                    popupHtml += `
                        <div style="${borderBottom}">
                            <b style="font-size:14px;">${d.name}</b><br>
                            <span style="font-size:12px;">IP: ${d.ip_address}</span><br>
                            <span style="font-size:12px;">Status: ${statusText}</span>
                        </div>
                    `;
                });
                
                popupHtml += `</div>`;

                // Pasang popup dengan batas tinggi maksimal agar bisa di-scroll jika isinya sangat banyak
                marker.bindPopup(popupHtml, { maxHeight: 250 });
            }

            // 5. Render Garis Koneksi (Links)
            links.forEach(function(link) {
                var sourceCoords = deviceCoordinates[link.source_device_id];
                var targetCoords = deviceCoordinates[link.target_device_id];

                // Hanya gambar garis jika kedua perangkat memiliki koordinat
                if (sourceCoords && targetCoords) {
                    L.polyline([sourceCoords, targetCoords], {
                        color: '#3b82f6', // Biru
                        weight: 3,
                        opacity: 0.6,
                        dashArray: '5, 5'
                    }).addTo(map);
                }
            });
        });
    </script>
</body>
</html>