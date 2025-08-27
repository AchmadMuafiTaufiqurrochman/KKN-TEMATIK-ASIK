// Admin Map JavaScript untuk Manajemen Fasilitas Desa
class AdminFacilityMap {
    constructor() {
        this.map = null;
        this.markers = [];
        this.init();
    }

    init() {
        // Initialize map - Koordinat Desa Wonokarang yang tepat
        this.map = L.map('adminMap').setView([-7.4129785, 112.5208843], 16);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(this.map);

        // Add click handler for adding new facilities
        this.map.on('click', (e) => {
            if (confirm('Tambah fasilitas baru di lokasi ini?')) {
                this.setCoordinatesInForm(e.latlng.lat, e.latlng.lng);
                if (typeof window.openAddLocationModal === 'function') {
                    window.openAddLocationModal();
                }
            }
        });
    }

    setCoordinatesInForm(lat, lng) {
        const latInput = document.querySelector('input[name="latitude"]');
        const lngInput = document.querySelector('input[name="longitude"]');
        
        if (latInput) latInput.value = lat.toFixed(8);
        if (lngInput) lngInput.value = lng.toFixed(8);
    }

    getIconHtml(type) {
        const icons = {
            'pelayanan_publik': '<i class="fas fa-building" style="color: white; font-size: 14px;"></i>',
            'pendidikan': '<i class="fas fa-graduation-cap" style="color: white; font-size: 14px;"></i>',
            'kesehatan': '<i class="fas fa-heartbeat" style="color: white; font-size: 14px;"></i>',
            'ekonomi': '<i class="fas fa-store" style="color: white; font-size: 14px;"></i>',
            'sosial_budaya': '<i class="fas fa-users" style="color: white; font-size: 14px;"></i>'
        };
        return icons[type] || '<i class="fas fa-map-marker-alt" style="color: white; font-size: 14px;"></i>';
    }

    getMarkerColor(type) {
        const colors = {
            'pelayanan_publik': '#2563eb',
            'pendidikan': '#16a34a',
            'kesehatan': '#dc2626',
            'ekonomi': '#ca8a04',
            'sosial_budaya': '#9333ea'
        };
        return colors[type] || '#6b7280';
    }

    addMarker(facility) {
        if (!facility.latitude || !facility.longitude) return;

        const markerIcon = L.divIcon({
            html: `
                <div style="
                    background-color: ${this.getMarkerColor(facility.type)};
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                    border: 2px solid white;
                    ${facility.status === 'inactive' ? 'opacity: 0.5;' : ''}
                ">
                    ${this.getIconHtml(facility.type)}
                </div>
            `,
            className: 'custom-marker',
            iconSize: [35, 35],
            iconAnchor: [17, 17]
        });

        const marker = L.marker([facility.latitude, facility.longitude], { 
            icon: markerIcon 
        })
        .addTo(this.map)
        .bindPopup(this.createPopupContent(facility));

        this.markers.push(marker);
        return marker;
    }

    createPopupContent(facility) {
        return `
            <div class="p-3 min-w-64">
                <div class="flex items-center gap-2 mb-2">
                    <div style="
                        background-color: ${this.getMarkerColor(facility.type)};
                        width: 24px;
                        height: 24px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        ${this.getIconHtml(facility.type)}
                    </div>
                    <h4 class="font-bold text-blue-900 text-sm">${facility.name}</h4>
                </div>
                
                <div class="space-y-1 text-xs">
                    <p class="text-gray-600">${facility.description}</p>
                    
                    ${facility.opening_hours ? `
                    <div class="flex items-center gap-1">
                        <i class="fas fa-clock text-gray-500"></i>
                        <span class="text-gray-700">${facility.opening_hours}</span>
                    </div>
                    ` : ''}
                    
                    ${facility.pic_name ? `
                    <div class="flex items-center gap-1">
                        <i class="fas fa-user text-gray-500"></i>
                        <span class="text-gray-700">${facility.pic_name}</span>
                    </div>
                    ` : ''}
                    
                    ${facility.contact ? `
                    <div class="flex items-center gap-1">
                        <i class="fas fa-phone text-gray-500"></i>
                        <span class="text-gray-700">${facility.contact}</span>
                    </div>
                    ` : ''}
                    
                    <div class="flex items-center gap-1 mt-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold ${
                            facility.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                        }">
                            ${facility.status === 'active' ? 'Aktif' : 'Tidak Aktif'}
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    clearMarkers() {
        this.markers.forEach(marker => {
            this.map.removeLayer(marker);
        });
        this.markers = [];
    }

    updateMap(facilities) {
        this.clearMarkers();
        facilities.forEach(facility => {
            this.addMarker(facility);
        });
    }
}

// Initialize map when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('adminMap')) {
        window.adminMap = new AdminFacilityMap();
        
        // Tambah marker dari data yang sudah ada jika tersedia
        if (window.facilitiesData) {
            console.log('Loading facilities:', window.facilitiesData);
            window.facilitiesData.forEach(facility => {
                if (facility.latitude && facility.longitude) {
                    window.adminMap.addMarker(facility);
                }
            });
        }
    }
});
