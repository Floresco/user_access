<?php

namespace App\Models\users;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserProfil extends Model
{
    use HasFactory, HasUuids, CreatedUpdatedBy;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function access_rights(): BelongsToMany
    {
        return $this->belongsToMany(AccessRight::class)->using(ProfilAccess::class);
    }
}
