<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'address',
        'phone',
        'email',
        'unique_id',
        'share_url',
        'background_color',
        'background_image',
        'background_opacity',
        'background_zoom',
        'text_color',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($card) {
            if (empty($card->unique_id)) {
                $card->unique_id = (string) Str::uuid();
            }
            
            if (empty($card->share_url)) {
                $card->share_url = url('/cards/public/' . $card->unique_id);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}