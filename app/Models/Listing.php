<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filter){
        if($filter['tag'] ?? false){
            dd($query);
            $query->where('tags','like','%'.request('tag').'%')->first();
            // apply
        }
    }
}
