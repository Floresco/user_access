<?php

namespace App\Models\users;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfilAccess extends Pivot
{
    use HasFactory, HasUuids, CreatedUpdatedBy;

}
