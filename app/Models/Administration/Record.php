<?php

namespace App\Models\Administration;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'record';

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    protected $fillable = [
        'users_id',
        'kiosk_id',
        'return_kiosk',
        'umbrella_id',
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * Relationships.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class);
    }

    public function umbrella()
    {
        return $this->belongsTo(Umbrella::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
