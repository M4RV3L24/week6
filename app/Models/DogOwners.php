<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DogOwners extends Pivot
{
    public function walks(): HasMany {
        return $this->hasMany(Walks::class);
    }
    public function dog(): BelongsTo {
        return $this->belongsTo(Dogs::class);
    }
    public function owner(): BelongsTo {
        return $this->belongsTo(Owners::class);
    }
}
