<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusLogProp extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_log_id',
        'entity_type',
        'entity_id'
    ];

    protected $with = ['entity'];

    public function entity()
    {
        return $this->morphTo()->withTrashed();
    }
}
