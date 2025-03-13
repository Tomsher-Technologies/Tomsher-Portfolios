<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name','status','created_by','updated_by'];

    public function portfolios() {
        return $this->belongsToMany(Portfolio::class, 'technology_portfolio');
    }
}
