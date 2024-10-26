<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Walks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Untuk allow mass assign
     * @var array
     */
    protected $fillable = ['dog_owner_id', 'started_at', 'finished_at'];

    public function dogOwner(): BelongsTo {
        return $this->belongsTo(DogOwners::class);
    }

}
