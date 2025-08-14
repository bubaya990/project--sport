@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon">✏️</div>
                    <h2 class="section-title">Edit About Us</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('aboutus.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" 
                                           value="{{ old('company_name', $aboutUs->company_name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $aboutUs->email) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $aboutUs->description) }}</textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mission" class="form-label">Mission</label>
                                    <textarea class="form-control" id="mission" name="mission" rows="3">{{ old('mission', $aboutUs->mission) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vision" class="form-label">Vision</label>
                                    <textarea class="form-control" id="vision" name="vision" rows="3">{{ old('vision', $aboutUs->vision) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="{{ old('address', $aboutUs->address) }}" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                           value="{{ old('phone', $aboutUs->phone) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="whatsapp" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" 
                                           value="{{ old('whatsapp', $aboutUs->whatsapp) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="map_link" class="form-label">Map Link</label>
                                    <input type="url" class="form-control" id="map_link" name="map_link" 
                                           value="{{ old('map_link', $aboutUs->map_link) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facebook_url" class="form-label">Facebook</label>
                                    <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                                           value="{{ old('facebook_url', $aboutUs->facebook_url) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="instagram_url" class="form-label">Instagram</label>
                                    <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                                           value="{{ old('instagram_url', $aboutUs->instagram_url) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="twitter_url" class="form-label">Twitter</label>
                                    <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                           value="{{ old('twitter_url', $aboutUs->twitter_url) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="linkedin_url" class="form-label">LinkedIn</label>
                                    <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                                           value="{{ old('linkedin_url', $aboutUs->linkedin_url) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="main_image" class="form-label">Main Image</label>
                            @if($aboutUs->main_image)
                            <div class="mb-3">
                                <img src="{{ $aboutUs->main_image_url }}" class="img-thumbnail d-block mb-2" style="max-height: 200px;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="keep_main_image" name="keep_main_image" checked>
                                    <label class="form-check-label" for="keep_main_image">Keep current image</label>
                                </div>
                            </div>
                            @endif
                            <input type="file" class="form-control" id="main_image" name="main_image">
                        </div>

                        <div class="form-group mb-4">
                            <label for="gallery_images" class="form-label">Gallery Images</label>
                            @if(count($aboutUs->gallery_urls) > 0)
                            <div class="mb-3">
                                <div class="row g-2">
                                    @foreach($aboutUs->gallery_urls as $image)
                                    <div class="col-3">
                                        <img src="{{ $image }}" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="keep_gallery" name="keep_gallery" checked>
                                    <label class="form-check-label" for="keep_gallery">Keep current gallery images</label>
                                </div>
                            </div>
                            @endif
                            <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview main image before upload
    document.getElementById('main_image').addEventListener('change', function(e) {
        if (document.getElementById('keep_main_image')) {
            document.getElementById('keep_main_image').checked = false;
        }
        
        if (e.target.files.length > 0) {
            const preview = document.createElement('img');
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.className = 'img-thumbnail d-block mb-2';
            preview.style.maxHeight = '200px';
            
            const container = document.getElementById('main_image').parentNode;
            const existingPreview = container.querySelector('img');
            if (existingPreview) {
                container.replaceChild(preview, existingPreview);
            } else {
                container.insertBefore(preview, document.getElementById('main_image'));
            }
        }
    });
</script>
@endpush