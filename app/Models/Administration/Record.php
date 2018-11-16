<?php

namespace App\Models\Administration;

use App\Models\User;
use App\Models\Administration\Kiosk;
use App\Models\Administration\Umbrella;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'record';

    protected $guarded = [
    	'id',
    ];

    protected $fillable = [
    	'users_id',
    	'kiosk_id',
        'umbrella_id',        
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * Relationships
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

}