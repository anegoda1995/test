<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use NodeTrait;
    
    public $fillable = [
        'position_id',
        'parent_id',
        'first_name',
        'middle_name',
        'last_name',
        'employment_date',
        'salary'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
