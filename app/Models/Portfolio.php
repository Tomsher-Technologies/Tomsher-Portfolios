<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'site_url', 'sort_order', 'status'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_portfolio');
    }

    public function industries() {
        return $this->belongsToMany(Industry::class, 'industry_portfolio');
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class, 'technology_portfolio');
    }
}
