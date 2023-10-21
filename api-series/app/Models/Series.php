<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model{
    
    use HasFactory;
    protected $fillable = ['name', 'seasons_qty', 'episodes_per_season'];
    protected $appends = ['links'];

    public function seasons(){
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes(){
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted(){
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }

    public function links(): Attribute{
        return new Attribute(
            fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ]
            ],
        );
    }
}
