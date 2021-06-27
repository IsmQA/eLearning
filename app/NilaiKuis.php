<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiKuis extends Model
{
    protected $table = 'nilai_kuis';
    protected $primaryKey = 'id';

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id');
    }
}
