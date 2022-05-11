<?php

namespace PlureGames\PlureApps\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use PlureGames\PlureApps\Models\App;

class AppIDScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(app()->env != 'testing' && auth()->check()) {
            $appID = auth()->user()->app_id;
            $builder->where('app_id', $appID);
        }
    }
}
