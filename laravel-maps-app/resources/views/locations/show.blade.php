@extends('layouts.app')

@section('title', $location->name . ' - Laravel Maps App')

    @section('styles')
<style>
    /* --- Variáve
        :root {
            --deep-navy: #0d1b2a;
            --oxford-blue: #1b263b;
            --shadow-blue: #778da9;
            --platinum: #e0e1dd;
            --coral: #ff6b6b;
            --mint: #4ecdc4;
            --gold: #ffd166;
            --lavender: #d8b4fe;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            --smooth-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Estilos gerais */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--deep-navy);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            line-height: 1.6;
            padding-bottom: 3rem;
        }

        /* Header e navegação */
        .navbar {
            background: linear-gradient(135deg, var(--deep-navy) 0%, var(--oxford-blue) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 1rem 0;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: var(--platinum) !important;
            font-weight: 500;
        }

        /* Títulos */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: var(--deep-navy);
        }

        h1 i {
            background: linear-gradient(135deg, var(--coral) 0%, var(--lavender) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 12px;
            font-size: 2.2rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 18px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--smooth-transition);
            margin-bottom: 2rem;
            background: white;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--oxford-blue) 0%, var(--shadow-blue) 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 1.4rem 1.8rem;
        }

        .card-title {
            margin: 0;
            color: white;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .card-title i {
            color: var(--gold);
            margin-right: 10px;
        }

        .card-body {
            padding: 2rem;
        }

        /* Botões */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            transition: var(--smooth-transition);
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--gold) 0%, #ffb74d 100%);
            color: var(--deep-navy);
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(255, 179, 71, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid var(--shadow-blue);
            color: var(--shadow-blue);
            background: transparent;
        }

        .btn-outline-secondary:hover {
            background: var(--shadow-blue);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--coral) 0%, #ff8a8a 100%);
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(255, 107, 107, 0.3);
        }

        /* Mapa */
        #map {
            height: 450px;
            width: 100%;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        /* Informações do local */
        .info-item {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-label {
            font-weight: 600;
            color: var(--oxford-blue);
            margin-bottom: 0.5rem;
            display: block;
        }

        .info-content {
            color: var(--oxford-blue);
            font-size: 1.1rem;
        }

        .badge {
            font-weight: 600;
            padding: 0.6rem 1rem;
            border-radius: 25px;
            background: linear-gradient(135deg, var(--mint) 0%, #26a69a 100%);
            font-size: 0.9rem;
        }

        /* Ícones */
        .fa-icon {
            width: 24px;
            text-align: center;
            margin-right: 10px;
            color: var(--shadow-blue);
        }

        /* Divisor */
        hr {
            border-top: 2px solid rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .card-body {
                padding: 1.5rem;
            }
            
            #map {
                height: 350px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .btn {
                padding: 0.6rem 1.2rem;
            }
        }

        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
            
            .d-flex.justify-content-between .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
</style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-map-marker-alt me-2"></i>{{ $location->name }}</h1>
            <div>
                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Voltar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Mapa -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-map me-2"></i>Localização no Mapa</h5>
            </div>
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>

    <!-- Detalhes -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Informações do Local</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nome:</label>
                    <p class="mb-0">{{ $location->name }}</p>
                </div>

                @if($location->category)
                <div class="mb-3">
                    <label class="form-label fw-bold">Categoria:</label>
                    <p class="mb-0"><span class="badge bg-secondary">{{ $location->category }}</span></p>
                </div>
                @endif

                @if($location->description)
                <div class="mb-3">
                    <label class="form-label fw-bold">Descrição:</label>
                    <p class="mb-0">{{ $location->description }}</p>
                </div>
                @endif

                @if($location->address)
                <div class="mb-3">
                    <label class="form-label fw-bold">Endereço:</label>
                    <p class="mb-0"><i class="fas fa-map-pin me-1"></i>{{ $location->address }}</p>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold">Coordenadas:</label>
                    <p class="mb-0"><i class="fas fa-location-arrow me-1"></i>{{ $location->latitude }}, {{ $location->longitude }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Data de Criação:</label>
                    <p class="mb-0">{{ $location->created_at->format('d/m/Y H:i') }}</p>
                </div>

                @if($location->updated_at != $location->created_at)
                <div class="mb-3">
                    <label class="form-label fw-bold">Última Atualização:</label>
                    <p class="mb-0">{{ $location->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif

                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Editar Local
                    </a>
                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Tem certeza que deseja excluir este local?')">
                            <i class="fas fa-trash me-1"></i>Excluir Local
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var lat = parseFloat('{{ $location->latitude }}');
    var lng = parseFloat('{{ $location->longitude }}');

    var map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

    // Usar innerHTML seguro para evitar misturar Blade com template string
    var popupContent = `
        <div class="text-center">
            <h6><strong>{{ addslashes($location->name) }}</strong></h6>
            @if($location->category)
            <p class="badge bg-secondary">{{ $location->category }}</p>
            @endif
            @if($location->address)
            <p><i class="fas fa-map-pin"></i> {{ $location->address }}</p>
            @endif
            @if($location->description)
            <p>{{ $location->description }}</p>
            @endif
        </div>
    `;
    marker.bindPopup(popupContent).openPopup();
});
</script>
@endsection