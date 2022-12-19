<?php

namespace App\Models\users;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AccessRight extends Model
{
    use HasFactory, HasUuids, CreatedUpdatedBy;

    protected $fillable = [
        'wording'
    ];

    public function userProfils(): BelongsToMany
    {
        return $this->belongsToMany(UserProfil::class)->using(ProfilAccess::class);
    }
}
