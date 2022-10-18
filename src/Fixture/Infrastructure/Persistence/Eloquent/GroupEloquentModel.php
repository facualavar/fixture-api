<?php

namespace Fixture\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class GroupEloquentModel extends Model
{
    protected $table = 'groups';
    protected $guarded = [];

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
}
