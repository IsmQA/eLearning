<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeTugas extends Model
{
    protected $table = 'tipe_tugas';
    protected $primaryKey = 'id';

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
