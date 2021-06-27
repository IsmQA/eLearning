<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'library';
    protected $primaryKey = 'id';

    public function mytipe()
    {
        return $this->belongsTo(TipeLibrary::class, 'tipe', 'id');
    }
}
