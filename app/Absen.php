<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id';

    public function dtlAbsen()
    {
        return $this->hasMany(DtlAbsen::class);
    }
}
