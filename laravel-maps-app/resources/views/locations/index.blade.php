@extends('layouts.app')

@section('title', 'Locais - Laravel Maps App')

    @section('styles')
    <style>
    :root {
            --deep-blue: #688fecff;
            --vibrant-red: #fb3640;
            --soft-teal: #17bebb;
            --light-gray: #f5f5f5;
            --dark-charcoal: #ffffffff;
            --accent-yellow: #ffc857;
            --card-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            --smooth-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Estilos gerais */
        body {
            background-color: #f8f9fa;
            color: var(--dark-charcoal);
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            padding-bottom: 2rem;
        }

        /* Header e navegação */
        .navbar, .card-header {
            background: linear-gradient(135deg, var(--deep-blue) 0%, #1e3a8a 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
        }

        /* Títulos */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--deep-blue);
        }

        h1 i, h5 i {
            color: var(--vibrant-red);
            background: rgba(251, 54, 64, 0.1);
            padding: 12px;
            border-radius: 50%;
            margin-right: 12px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--smooth-transition);
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1.2rem 1.5rem;
        }

        .card-title {
            margin: 0;
            color: white;
            font-weight: 600;
        }

        .card-body {
            padding: 1.8rem;
        }

        /* Botões */
        .btn {
            border-radius: 10px;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            transition: var(--smooth-transition);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--vibrant-red) 0%, #ff5a62 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(251, 54, 64, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(251, 54, 64, 0.4);
        }

        .btn-outline-primary {
            border-color: var(--soft-teal);
            color: var(--soft-teal);
        }

        .btn-outline-primary:hover {
            background-color: var(--soft-teal);
            border-color: var(--soft-teal);
        }

        .btn-outline-warning {
            border-color: var(--accent-yellow);
            color: var(--accent-yellow);
        }

        .btn-outline-warning:hover {
            background-color: var(--accent-yellow);
            border-color: var(--accent-yellow);
            color: var(--dark-charcoal);
        }

        .btn-outline-danger {
            border-color: var(--vibrant-red);
            color: var(--vibrant-red);
        }

        .btn-outline-danger:hover {
            background-color: var(--vibrant-red);
            border-color: var(--vibrant-red);
        }

        /* Mapa */
        #map {
            height: 500px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        /* Lista de locais */
        .location-card {
            background: white;
            border-radius: 12px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: var(--smooth-transition);
            border-left: 4px solid var(--soft-teal);
        }

        .location-card:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .location-card h6 {
            color: var(--deep-blue);
            margin-bottom: 0.5rem;
        }

        .badge {
            font-weight: 500;
            padding: 0.5rem 0.8rem;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--soft-teal) 0%, #1dc7c4 100%);
        }

        /* List group */
        .list-group-item {
            border: none;
            padding: 0;
            background: transparent;
        }

        /* Textos e ícones */
        .text-muted {
            color: #6c757d !important;
        }

        .location-card .text-muted {
            font-size: 0.85rem;
        }

        .fa-icon {
            width: 20px;
            text-align: center;
            margin-right: 8px;
            color: var(--soft-teal);
        }

        /* Estado vazio */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--soft-teal);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .empty-state h5 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #adb5bd;
        }

        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .location-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
            
            #map {
                height: 350px;
            }
            
            .btn-group-sm .btn {
                padding: 0.25rem 0.5rem;
            }
        }
    </style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-map-marker-alt me-2"></i>Locais Cadastrados
            </h1>
            <a href="{{ route('locations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1 sea-blue"></i>Adicionar Local
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Mapa -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-map me-2"></i>Mapa Interativo
                </h5>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Lista de Locais -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Lista de Locais
                </h5>
            </div>
            <div class="card-body">
                @if($locations->count() > 0)
                <div class="list-group">
                    @foreach($locations as $location)
                    <div class="list-group-item location-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $location->name }}</h6>
                                @if($location->category)
                                <span class="badge bg-secondary mb-2">{{ $location->category }}</span>
                                @endif
                                @if($location->address)
                                <p class="mb-1 text-muted small">
                                    <i class="fas fa-map-pin me-1"></i>{{ $location->address }}
                                </p>
                                @endif
                                <p class="mb-1 text-muted small">
                                    <i class="fas fa-location-arrow me-1"></i>{{ $location->latitude }}, {{ $location->longitude }}
                                </p>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este local?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Nenhum local cadastrado</h5>
                    <p class="text-muted">Clique em "Adicionar Local" para começar!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection {{-- <--- FECHA A SEÇÃO CONTENT --}}

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar o mapa
    var map = L.map('map').setView([-23.5505, -46.6333], 10);

    // Adicionar camada do OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];
    var locations = {!! json_encode($locations) !!};

    locations.forEach(function(location) {
        var marker = L.marker([location.latitude, location.longitude])
            .addTo(map)
            .bindPopup(
                '<div class="text-center">' +
                '<h6><strong>' + location.name + '</strong></h6>' +
                (location.category ? '<p class="badge bg-secondary">' + location.category + '</p>' : '') +
                (location.address ? '<p><i class="fas fa-map-pin"></i> ' + location.address + '</p>' : '') +
                (location.description ? '<p>' + location.description + '</p>' : '') +
                '<div class="mt-2">' +
                '<a href="/locations/' + location.id + '" class="btn btn-sm btn-primary">Ver Detalhes</a>' +
                '</div>' +
                '</div>'
            );

        markers.push(marker);
    });

    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endsection