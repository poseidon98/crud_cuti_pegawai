<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis';

    protected $fillable = [
        'pegawai_id',
        'keterangan',
        'start_date',
        'end_date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
