<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';

    public function tipeTugas()
    {
        return $this->belongsTo(TipeTugas::class, 'tipe_tugas', 'id');
    }

    public function dijawab()
    {
        return $this->hasMany(JawabTugas::class);
    }
}
