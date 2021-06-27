<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabKuis extends Model
{
    protected $table = 'jwb_kuis';
    protected $primaryKey = 'id';

    public function jawaban_kuis()
    {
        return $this->belongsTo(SoalKuis::class, 'id_kuis', 'id');
    }
}
