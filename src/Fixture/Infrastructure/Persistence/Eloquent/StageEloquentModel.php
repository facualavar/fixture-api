<?php

namespace Fixture\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class StageEloquentModel extends Model
{
    protected $table = 'stages';

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
}
