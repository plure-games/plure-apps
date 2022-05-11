<?php

namespace PlureGames\PlureApps\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PlureGames\PlureApps\Database\Factories\AppEnvironmentsFactory;
use PlureGames\PlureApps\Scopes\AppIDScope;

/**
 * App\Models\AppEnvironments
 *
 * @property int $id
 * @property int $app_id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppEnvironments whereValue($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\AppEnvironmentsFactory factory(...$parameters)
 */
class AppEnvironments extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return AppEnvironmentsFactory::new();
    }


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AppIDScope());
    }
}
