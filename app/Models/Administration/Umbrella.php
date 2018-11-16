<?php

namespace App\Models\Administration;

use App\Models\Administration\Kiosk;
use App\Models\Administration\Record;
use Illuminate\Database\Eloquent\Model;

class Umbrella extends Model
{
    protected $table = 'umbrella';

    protected $guarded = [
    	'id',
        'status',
        'url',
    ];

    protected $fillable = [
        'kiosk_id',
        'serial_number',
    ];

    /**
     * An umbrella belongs to a kiosk.
     *
     * @return mixed
     */
    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class, 'kiosk_id');
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