<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $connection        = 'personalia_db';
    public 	  $incrementing      = false;
    public    $timestamps        = false;
    
    protected $table             = 'msjabatan';
    protected $primaryKey        = 'idjabatan';
    protected $fillable          = ['idjabatan','namajabatan','flag_active'];
}
