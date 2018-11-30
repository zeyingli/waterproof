<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'key',
        'secret',
    ];

    /**
     * A kiosk has many umbrella.
     *
     * @return mixed
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
