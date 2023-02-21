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

    // in order to create database entries, the fields have to be put into fillable properties in the respective model
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags', 'user_id'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            // sql like query to check the database column 'tags' for any entrys 'like' the tag in the request
            // concatenated with % signs so anything can be before or after the tag
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            // same function, but for the search bar
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%')
                ->orWhere('company', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
