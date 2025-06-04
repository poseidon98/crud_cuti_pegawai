<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cuti;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'gender',
        'email',
        'phone_number',
    ];

    public function cuti()
    {
        return $this->hasMany(Cuti::class);
    }
}
