<?php


namespace App\Scopes;

use App\Models\ParticipantType;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ParticipantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check() && auth()->user()->hasRole('manager')) {
            $allowed_types = auth()->user()->userPermissions()->whereNotNull('participant_type_id')->get()->pluck('participant_type_id')->toArray();
            $builder->whereIn('type_id', $allowed_types);
        }
    }
}