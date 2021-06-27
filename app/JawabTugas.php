<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabTugas extends Model
{
    protected $table = 'jwb_tugas';
    protected $primaryKey = 'id';

    public function jawaban_tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id');
    }
}
