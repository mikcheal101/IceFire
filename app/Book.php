<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $dateFormat = 'U';
    protected $fillable = [
        'name',
        'isbn',
        'country',
        'number_of_pages',
        'publisher',
        'release_date',
    ];

    /**
     * List of authors associated with the book
     *
     * @return [Author]
     */
    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
