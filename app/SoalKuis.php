<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalKuis extends Model
{
    protected $table = 'soal_kuis';
    protected $primaryKey = 'id';

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id');
    }
}
