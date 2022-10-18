<?php

namespace Fixture\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class MatchdayEloquentModel extends Model
{
    protected $table = 'matchdays';

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
}
