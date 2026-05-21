<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex min-w-0 items-start gap-3 sm:items-center sm:gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 via-blue-600 to-indigo-700 text-white shadow-lg shadow-blue-500/25 ring-1 ring-white/20">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 20l-5.447-2.724A2 2 0 013 15.382V6.618a2 2 0 011.106-1.789L9 2m0 18l9.944-4.972A2 2 0 0020 13.236V4.464a2 2 0 00-1.106-1.789L9 2m0 18v-8m0-8v8m9-4H9"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <h2 class="truncate text-xl font-black tracking-tight text-slate-900 sm:text-2xl">
                        Live Geographic Status
                    </h2>
                    <p class="mt-1 max-w-2xl text-sm font-medium leading-6 text-slate-500">
                        Pemantauan real-time topologi, node, link, dan status perangkat jaringan.
                    </p>
                </div>
            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 shadow-sm">
                <span class="relative flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-emerald-500"></span>
                </span>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-emerald-700">
                    System Active
                </span>
            </div>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="min-h-dvh bg-slate-50">
        <div class="relative overflow-hidden">
            <!-- Background Accent -->
            <div class="pointer-events-none absolute -top-40 -right-32 h-80 w-80 rounded-full bg-cyan-300/20 blur-3xl"></div>
            <div class="pointer-events-none absolute top-60 -left-32 h-80 w-80 rounded-full bg-blue-400/10 blur-3xl"></div>

            <div class="relative mx-auto w-full max-w-7xl px-4 py-5 sm:px-6 sm:py-7 lg:px-8 lg:py-8">

                @php
                    $totalDevices = collect($devices ?? [])->count();
                    $onlineDevices = collect($devices ?? [])->where('is_online', true)->count();
                    $offlineDevices = collect($devices ?? [])->where('is_online', false)->count();
                    $totalLinks = collect($links ?? [])->count();

                    $onlinePercentage = $totalDevices > 0 ? round(($onlineDevices / $totalDevices) * 100) : 0;
                @endphp

                @if (session('success'))
                    <div class="mb-5 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h3 class="text-sm font-black text-emerald-800">Berhasil</h3>
                            <p class="mt-1 text-sm font-medium leading-6 text-emerald-700">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-5 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 shadow-sm">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h3 class="text-sm font-black text-red-800">Gagal</h3>
                            <p class="mt-1 text-sm font-medium leading-6 text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                @endif
                @if(in_array(Auth::user()->role, ['Super Admin', 'Admin']))
                    <div class="mb-5 rounded-3xl border border-white bg-white/85 p-4 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-600 ring-1 ring-cyan-100">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                                        </svg>
                                    </div>

                                    <div class="min-w-0">
                                        <h3 class="text-base font-black tracking-tight text-slate-900 sm:text-lg">
                                            Check Status Nodes
                                        </h3>
                                        <p class="mt-1 text-sm font-medium leading-6 text-slate-500">
                                            Jalankan pengecekan status perangkat menggunakan command
                                            <span class="font-mono text-xs font-bold text-slate-700">php artisan network:ping</span>.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('network.check-status') }}" class="w-full sm:w-auto">
                                @csrf

                                <button
                                    type="submit"
                                    onclick="return confirm('Jalankan pengecekan status seluruh node sekarang?')"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-cyan-500/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-cyan-500/35 focus:outline-none focus:ring-4 focus:ring-cyan-500/20 sm:w-auto"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v6h6M20 20v-6h-6M20 9A8 8 0 006.34 4.34L4 6.68M4 15a8 8 0 0013.66 4.66L20 17.32"/>
                                    </svg>

                                    Check Status Nodes
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
                <!-- Summary Section -->
                <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5">

                    <!-- Total Node -->
                    <div class="group rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 ring-1 ring-blue-100 transition group-hover:scale-105">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-xs font-black uppercase tracking-[0.16em] text-slate-400">
                                    Total Node
                                </p>
                                <h4 class="mt-1 text-2xl font-black leading-none text-slate-900 sm:text-3xl">
                                    {{ $totalDevices }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Online Node -->
                    <div class="group rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100 transition group-hover:scale-105">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-xs font-black uppercase tracking-[0.16em] text-slate-400">
                                    Node Online
                                </p>
                                <h4 class="mt-1 text-2xl font-black leading-none text-emerald-600 sm:text-3xl">
                                    {{ $onlineDevices }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Offline Node -->
                    <div class="group rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600 ring-1 ring-red-100 transition group-hover:scale-105">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-xs font-black uppercase tracking-[0.16em] text-slate-400">
                                    Node Offline
                                </p>
                                <h4 class="mt-1 text-2xl font-black leading-none text-red-600 sm:text-3xl">
                                    {{ $offlineDevices }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Total Link -->
                    <div class="group rounded-3xl border border-white bg-white/90 p-4 shadow-lg shadow-slate-200/60 ring-1 ring-slate-900/5 backdrop-blur transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100 transition group-hover:scale-105">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-xs font-black uppercase tracking-[0.16em] text-slate-400">
                                    Jalur Link
                                </p>
                                <h4 class="mt-1 text-2xl font-black leading-none text-slate-900 sm:text-3xl">
                                    {{ $totalLinks }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Availability Bar -->
                <div class="mb-5 rounded-3xl border border-white bg-white/80 p-4 shadow-lg shadow-slate-200/50 ring-1 ring-slate-900/5 backdrop-blur">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-900">
                                Network Availability
                            </p>
                            <p class="mt-1 text-xs font-medium text-slate-500">
                                Persentase node online terhadap total node yang terdaftar.
                            </p>
                        </div>

                        <div class="text-left sm:text-right">
                            <p class="text-2xl font-black text-emerald-600">
                                {{ $onlinePercentage }}%
                            </p>
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-400">
                                Online Rate
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-slate-100">
                        <div
                            class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-cyan-500 shadow-sm transition-all duration-700"
                            style="width: {{ $onlinePercentage }}%;"
                        ></div>
                    </div>
                </div>

                <!-- Map Card -->
                <div class="overflow-hidden rounded-[1.75rem] border border-white bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-900/5">

                    <!-- Map Header -->
                    <div class="border-b border-slate-100 bg-white/95 px-4 py-4 backdrop-blur sm:px-5 lg:px-6">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 20l-5.447-2.724A2 2 0 013 15.382V6.618a2 2 0 011.106-1.789L9 2m0 18l9.944-4.972A2 2 0 0020 13.236V4.464a2 2 0 00-1.106-1.789L9 2m0 18v-8m0-8v8m9-4H9"/>
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <h3 class="truncate text-base font-black text-slate-900 sm:text-lg">
                                        Peta Topologi Interaktif
                                    </h3>
                                    <p class="mt-0.5 text-xs font-medium text-slate-500 sm:text-sm">
                                        Visualisasi node dan jalur koneksi jaringan.
                                    </p>
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="grid grid-cols-3 gap-2 rounded-2xl bg-slate-50 p-2 text-[11px] font-bold text-slate-600 sm:flex sm:items-center sm:gap-3 sm:text-xs">
                                <span class="flex items-center justify-center gap-1.5 rounded-xl bg-white px-2.5 py-2 shadow-sm">
                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-sm"></span>
                                    Online
                                </span>

                                <span class="flex items-center justify-center gap-1.5 rounded-xl bg-white px-2.5 py-2 shadow-sm">
                                    <span class="h-2.5 w-2.5 rounded-full bg-red-500 shadow-sm"></span>
                                    Offline
                                </span>

                                <span class="flex items-center justify-center gap-1.5 rounded-xl bg-white px-2.5 py-2 shadow-sm">
                                    <span class="h-1 w-4 rounded-full bg-indigo-500"></span>
                                    Link
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="relative">
                        <div class="absolute left-0 top-0 z-[2] h-1 w-full bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600"></div>

                        <div
                            id="map"
                            class="relative z-0 h-[58dvh] min-h-[360px] w-full sm:h-[62dvh] sm:min-h-[460px] lg:h-[650px]"
                        ></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultCenter = [-7.8286, 110.1384];

            const map = L.map('map', {
                zoomControl: false,
                preferCanvas: true
            }).setView(defaultCenter, 11);

            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap & CartoDB | KP Pinger System'
            }).addTo(map);

            const devices = @json($devices ?? []);
            const links = @json($links ?? []);

            const deviceCoordinates = {};
            const groupedDevices = {};
            const bounds = [];

            function isOnline(device) {
                return device.is_online === true || device.is_online === 1 || device.is_online === '1';
            }

            function escapeHtml(value) {
                return String(value ?? '-')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function getRegionName(device) {
                if (!device.region) {
                    return 'Pusat / Global';
                }

                if (typeof device.region === 'object') {
                    return device.region.name ?? device.region.nama ?? 'Pusat / Global';
                }

                return device.region;
            }

            devices.forEach(function (device) {
                if (device.latitude && device.longitude) {
                    const lat = parseFloat(device.latitude);
                    const lng = parseFloat(device.longitude);

                    if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
                        deviceCoordinates[device.id] = [lat, lng];
                        bounds.push([lat, lng]);

                        const coordKey = lat.toFixed(6) + '_' + lng.toFixed(6);

                        if (!groupedDevices[coordKey]) {
                            groupedDevices[coordKey] = [];
                        }

                        groupedDevices[coordKey].push(device);
                    }
                }
            });

            // Draw Links First
            links.forEach(function (link) {
                const sourceCoords = deviceCoordinates[link.source_device_id];
                const targetCoords = deviceCoordinates[link.target_device_id];

                if (sourceCoords && targetCoords) {
                    L.polyline([sourceCoords, targetCoords], {
                        color: '#4f46e5',
                        weight: 3,
                        opacity: 0.68,
                        dashArray: '8, 8',
                        lineJoin: 'round',
                        lineCap: 'round'
                    }).addTo(map);
                }
            });

            // Draw Markers After Links
            Object.keys(groupedDevices).forEach(function (key) {
                const locationDevices = groupedDevices[key];
                const lat = parseFloat(key.split('_')[0]);
                const lng = parseFloat(key.split('_')[1]);

                const isAnyOffline = locationDevices.some(function (device) {
                    return !isOnline(device);
                });

                const markerColor = isAnyOffline ? '#ef4444' : '#10b981';
                const markerRadius = locationDevices.length > 1 ? 12 : 9;

                const marker = L.circleMarker([lat, lng], {
                    color: '#ffffff',
                    fillColor: markerColor,
                    fillOpacity: 1,
                    radius: markerRadius,
                    weight: 3,
                    opacity: 1
                }).addTo(map);

                let popupHtml = `
                    <div class="kp-popup">
                `;

                if (locationDevices.length > 1) {
                    popupHtml += `
                        <div class="kp-popup-stack">
                            ${locationDevices.length} Perangkat pada Titik Ini
                        </div>
                    `;
                }

                locationDevices.forEach(function (device, index) {
                    const online = isOnline(device);
                    const badgeClass = online ? 'kp-badge-online' : 'kp-badge-offline';
                    const statusText = online ? 'ONLINE' : 'OFFLINE';
                    const region = getRegionName(device);
                    const dividerClass = index !== locationDevices.length - 1 ? 'kp-popup-item kp-popup-divider' : 'kp-popup-item';

                    popupHtml += `
                        <div class="${dividerClass}">
                            <div class="kp-popup-title-row">
                                <div class="kp-popup-title">
                                    ${escapeHtml(device.name)}
                                </div>
                                <span class="kp-badge ${badgeClass}">
                                    ${statusText}
                                </span>
                            </div>

                            <div class="kp-popup-meta">
                                <span class="kp-popup-label">IP</span>
                                <span class="kp-popup-code">${escapeHtml(device.ip_address)}</span>
                            </div>

                            <div class="kp-popup-region">
                                ${escapeHtml(region)}
                            </div>
                        </div>
                    `;
                });

                popupHtml += `</div>`;

                marker.bindPopup(popupHtml, {
                    maxWidth: 320,
                    maxHeight: 320,
                    className: 'custom-modern-popup'
                });
            });

            if (bounds.length > 0) {
                map.fitBounds(bounds, {
                    padding: [32, 32],
                    maxZoom: 13
                });
            }

            setTimeout(function () {
                map.invalidateSize();
            }, 250);

            window.addEventListener('resize', function () {
                setTimeout(function () {
                    map.invalidateSize();
                }, 150);
            });
        });
    </script>

    <style>
        .leaflet-container {
            font-family: inherit;
            background: #f8fafc;
        }

        .leaflet-control-zoom {
            border: none !important;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.16) !important;
        }

        .leaflet-control-zoom a {
            width: 38px !important;
            height: 38px !important;
            line-height: 38px !important;
            border: none !important;
            color: #0f172a !important;
            font-weight: 900 !important;
        }

        .leaflet-control-zoom-in {
            border-top-left-radius: 14px !important;
            border-top-right-radius: 14px !important;
        }

        .leaflet-control-zoom-out {
            border-bottom-left-radius: 14px !important;
            border-bottom-right-radius: 14px !important;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 20px;
            box-shadow:
                0 24px 60px rgba(15, 23, 42, 0.18),
                0 8px 20px rgba(15, 23, 42, 0.10);
            border: 1px solid rgba(226, 232, 240, 0.9);
            padding: 0;
            overflow: hidden;
        }

        .leaflet-popup-content {
            margin: 0;
            width: auto !important;
        }

        .leaflet-popup-tip {
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.14);
        }

        .kp-popup {
            min-width: 240px;
            max-width: 300px;
            padding: 12px;
            background: #ffffff;
        }

        .kp-popup-stack {
            margin-bottom: 12px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: #ffffff;
            padding: 9px 10px;
            text-align: center;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .kp-popup-item {
            padding: 2px 0;
        }

        .kp-popup-divider {
            margin-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
        }

        .kp-popup-title-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .kp-popup-title {
            color: #0f172a;
            font-size: 14px;
            font-weight: 900;
            line-height: 1.25;
        }

        .kp-badge {
            flex-shrink: 0;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 0.04em;
        }

        .kp-badge-online {
            background: #dcfce7;
            color: #047857;
        }

        .kp-badge-offline {
            background: #fee2e2;
            color: #b91c1c;
        }

        .kp-popup-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 12px;
        }

        .kp-popup-label {
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569;
            padding: 2px 7px;
            font-size: 10px;
            font-weight: 900;
        }

        .kp-popup-code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            color: #334155;
            font-weight: 700;
        }

        .kp-popup-region {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 700;
        }

        @media (max-width: 640px) {
            .leaflet-control-attribution {
                max-width: 220px;
                white-space: normal;
                font-size: 10px;
            }

            .kp-popup {
                min-width: 220px;
                max-width: 260px;
            }
        }
    </style>
</x-app-layout>