<?php

namespace Fixture\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class TeamStatsEloquentModel extends Model
{
    protected $table = 'team_stats';
    protected $guarded = [];
}
