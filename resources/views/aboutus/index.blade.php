@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Company Info Card -->
            <div class="card shadow-lg mb-5">
                @if($aboutUs->main_image)
                <img src="{{ $aboutUs->main_image_url }}" class="card-img-top" alt="{{ $aboutUs->company_name }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title display-4">{{ $aboutUs->company_name }}</h1>
                    <p class="card-text lead">{{ $aboutUs->description }}</p>
                    
                    @if($aboutUs->mission)
                    <div class="mt-4">
                        <h3 class="text-primary">Notre Mission</h3>
                        <p>{{ $aboutUs->mission }}</p>
                    </div>
                    @endif
                    
                    @if($aboutUs->vision)
                    <div class="mt-4">
                        <h3 class="text-primary">Notre Vision</h3>
                        <p>{{ $aboutUs->vision }}</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Gallery Section -->
            @if(count($aboutUs->gallery_urls) > 0)
            <div class="card shadow-lg mb-5">
                <div class="card-header bg-primary text-white">
                    <h3>Galerie</h3>
                </div>
                <div class="card-body">
                    <div class="row gallery">
                        @foreach($aboutUs->gallery_urls as $image)
                        <div class="col-md-4 mb-3">
                            <a href="{{ $image }}" data-lightbox="gallery">
                                <img src="{{ $image }}" class="img-fluid rounded" alt="Gallery Image">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Contact Section -->
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3>Contactez-nous</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-primary">Coordonnées</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                    {{ $aboutUs->address }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone text-primary mr-2"></i>
                                    <a href="tel:{{ $aboutUs->phone }}">{{ $aboutUs->phone }}</a>
                                </li>
                                @if($aboutUs->whatsapp)
                                <li class="mb-2">
                                    <i class="fab fa-whatsapp text-success mr-2"></i>
                                    <a href="https://wa.me/{{ $aboutUs->whatsapp }}">{{ $aboutUs->whatsapp }}</a>
                                </li>
                                @endif
                                <li class="mb-2">
                                    <i class="fas fa-envelope text-primary mr-2"></i>
                                    <a href="mailto:{{ $aboutUs->email }}">{{ $aboutUs->email }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-primary">Réseaux Sociaux</h4>
                            <div class="social-links">
                                @if($aboutUs->facebook_url)
                                <a href="{{ $aboutUs->facebook_url }}" class="btn btn-outline-primary mb-2" target="_blank">
                                    <i class="fab fa-facebook-f mr-2"></i> Facebook
                                </a>
                                @endif
                                
                                @if($aboutUs->instagram_url)
                                <a href="{{ $aboutUs->instagram_url }}" class="btn btn-outline-danger mb-2" target="_blank">
                                    <i class="fab fa-instagram mr-2"></i> Instagram
                                </a>
                                @endif
                                
                                @if($aboutUs->twitter_url)
                                <a href="{{ $aboutUs->twitter_url }}" class="btn btn-outline-info mb-2" target="_blank">
                                    <i class="fab fa-twitter mr-2"></i> Twitter
                                </a>
                                @endif
                                
                                @if($aboutUs->linkedin_url)
                                <a href="{{ $aboutUs->linkedin_url }}" class="btn btn-outline-primary mb-2" target="_blank">
                                    <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                </a>
                                @endif
                            </div>
                            
                            @if($aboutUs->map_link)
                            <div class="mt-3">
                                <a href="{{ $aboutUs->map_link }}" class="btn btn-outline-dark" target="_blank">
                                    <i class="fas fa-map-marked-alt mr-2"></i> Voir sur la carte
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .gallery img {
        transition: transform 0.3s;
        height: 200px;
        object-fit: cover;
    }
    .gallery img:hover {
        transform: scale(1.05);
    }
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
</style>
@endpush

@push('scripts')
<!-- Lightbox pour la galerie -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush