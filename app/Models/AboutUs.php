<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'aboutus';

    protected $fillable = [
        'company_name',
        'description',
        'mission',
        'vision',
        'main_image',
        'gallery',
        'address',
        'phone',
        'whatsapp',
        'email',
        'map_link',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url'
    ];

    protected $casts = [
        'gallery' => 'array'
    ];

    // Accessor for main image URL
    public function getMainImageUrlAttribute()
    {
        if (!$this->main_image) {
            return asset('images/default-about.jpg');
        }
        
        return Storage::disk('public')->exists($this->main_image)
            ? Storage::disk('public')->url($this->main_image)
            : asset('images/default-about.jpg');
    }

    // Accessor for gallery images URLs
    public function getGalleryUrlsAttribute()
    {
        if (empty($this->gallery)) {
            return [];
        }

        return array_map(function($image) {
            return Storage::disk('public')->exists($image)
                ? Storage::disk('public')->url($image)
                : asset('images/default-gallery.jpg');
        }, $this->gallery);
    }

    // Method to get social links as an array
    public function socialLinks()
    {
        return [
            'facebook' => $this->facebook_url,
            'instagram' => $this->instagram_url,
            'twitter' => $this->twitter_url,
            'linkedin' => $this->linkedin_url
        ];
    }

    // Clean up images when deleting
    protected static function booted()
    {
        static::deleting(function ($aboutUs) {
            // Delete main image
            if ($aboutUs->main_image && Storage::disk('public')->exists($aboutUs->main_image)) {
                Storage::disk('public')->delete($aboutUs->main_image);
            }
            
            // Delete gallery images
            if ($aboutUs->gallery) {
                foreach ($aboutUs->gallery as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        });
    }

    
}