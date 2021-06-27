<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtlAbsen extends Model
{
    protected $table = 'dtl_absensi';
    protected $primaryKey = 'id';

    public function absen()
    {
        return $this->belongsTo(Absen::class, 'id_absen', 'id');
    }
}
