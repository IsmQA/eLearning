<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';
    protected $primaryKey = 'id';

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function nilai()
    {
        return $this->hasMany(NilaiKuis::class);
    }
}
