<?php

namespace App\Models;

class Listing
{
    /**
     * @return array
     */
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'abcd'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'wxyz'
            ]
        ];
    }

    public static function find($id): array
    {

        $listings = self::all();
        foreach ($listings as $listing) {
            if ($listing['id'] == $id) {
                return $listing;
            }
        }
    }
}
