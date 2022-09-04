<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filters)
    {
        // if this is not false then move on
        // ie : if there's a tag then do whatever
        // is inside the function
        if ($filters['tag'] ?? false) {
            // % sign means that anything can be before or after it in the query
            // concatenate with . and see the tag requested
            // request(tag) will go through the first param 'tags' column and see
            // if there is any match. if match: return it.
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')

                ->orWhere('description', 'like', '%' . request('search') . '%')

                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
