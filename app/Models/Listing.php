<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */
class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            // sql like query to check the database column 'tags' for any entrys 'like' the tag in the request
            // concatenated with % signs so anything can be before or after the search string
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
