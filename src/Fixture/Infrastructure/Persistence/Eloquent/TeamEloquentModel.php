<?php

namespace Fixture\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TeamEloquentModel extends Model
{
    protected $table = 'teams';

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    public $incrementing  = false;
}
