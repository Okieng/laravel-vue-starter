<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $connection = 'personalia_db';
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'v_karyawan';
    protected $primaryKey = 'idkaryawan';
    protected $fillable = [
        'idkaryawan',
        'namakaryawan',
        'jeniskelamin',
        'idstatus',
        'idjabatan',
        'iddivisi',
        'idbagian',
        'idarea',
        'iddepartment',
        'idunit',
        'idsubunit',
        'idgroupkerja',
        'idlokasi',
        'tglmasuk',
        'idagama',
        'nik',
        'tempatlahir',
        'tgllahir',
        'alamatktp',
        'alamatdomisili',
        'idpernikahan',
        'idpendidikan',
        'idpenggajian',
        'nobpjs',
        'nobpjatk',
        'norekening1',
        'namarekening1',
        'norekening2',
        'namarekening2',
        'norekening3',
        'namarekening3',
        'tglkeluar',
        'idkeluar',
        'alasan',
        'no_rfid',
        'idjadwalkerja',
        'golongan',
        'flag_borongan',
        'idatasan',
        'photo',
        'nrpparent',
        'nrprfid',
        'npwp',
        'nohandphone',
        'email',
        'namakontakdarurat',
        'hubkontakdarurat',
        'hpkontakdarurat',
        'idgroupbpjs',
        'pernikahan',
        'flag_borongan_old',
        'awal_aktif',
        'password',
        'tgl_berlaku_idpenggajian',
        'tgl_berlaku_flag_borongan',
        'idpenggajian_new',
        'user_create',
        'user_update',
        'date_created',
        'date_updated',
        'iddepartementalisasi',
        'list_inventori',
        'no_rfid'
    ];
    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'idjabatan', 'idjabatan');
    }

    // public function nrps()
    // {
    //     return $this->hasMany(\App\Models\Asik\LogNrp::class, 'idkaryawan');
    // }
    // public function departementalisasi()
    // {
    //     return $this->belongsTo(\App\Models\Asik\Departementalisasi::class, 'iddepartementalisasi', 'iddepartementalisasi');
    // }
}
