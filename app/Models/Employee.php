<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_number';
    public $incrementing = false;
    protected $guarded = [];

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'id_number', 'id_number');
    }
}
