<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeLibrary extends Model
{
    protected $table = 'tipe_library';
    protected $primaryKey = 'id';

    public function library()
    {
        return $this->hasMany(Library::class);
    }
}
