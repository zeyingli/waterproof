<?php

namespace App\Models\Administration;

use App\Models\Administration\Vendor;
use App\Models\Administration\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $guarded = [
    	'id',
    ];

    protected $fillable = [
    	'vendor_id',
        'record_id',
    	'amount',
    ];

    /**
     * A kiosk has many umbrella.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }

}
