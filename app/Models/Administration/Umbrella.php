<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Umbrella extends Model
{
    protected $table = 'umbrella';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'kiosk_id',
        'status',
        'serial_number',
        'url',
    ];

    /**
     * An umbrella belongs to a kiosk.
     *
     * @return mixed
     */
    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class);
    }

    public function record()
    {
        return $this->hasMany(Record::class);
    }

    public function scopeAvailableUmbrella()
    {
        return $this->where('status', '=', '0');
    }
}
