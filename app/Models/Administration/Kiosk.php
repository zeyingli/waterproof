<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $table = 'kiosk';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'location',
        'status',
        'lat',
        'lng',
        'url',
        'img',
    ];

    /**
     * A kiosk has many umbrella.
     *
     * @return mixed
     */
    public function umbrella()
    {
        return $this->hasMany(Umbrella::class);
    }

    public function record()
    {
        return $this->hasMany(Record::class);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getAvailableUmbrella(Request $request)
    {
        $kioskID = self::find($id);

        return Umbrella::where([
            ['kiosk_id', '=', $kioskID],
            ['status', '=', 0],
        ])->count('id');
    }
}
