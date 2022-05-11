<?php

namespace PlureGames\PlureApps\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PlureGames\PlureApps\Database\Factories\AppSettingFactory;
use PlureGames\PlureApps\Scopes\AppIDScope;

/**
 * PlureGames\PlureApps\Models\AppSetting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value_type
 * @property string|null $value
 * @property string|null $description
 * @property string|null $group
 * @property string|null $send_to_fe
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereSendToFe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereValueType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereDescription($value)
 * @mixin \Eloquent
 * @mixin IdeHelperApp
 * @method static \Database\Factories\AppFactory factory(...$parameters)
 */

class AppSetting extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return AppSettingFactory::new();
    }

    protected $fillable = [
        'app_id',
        'key',
        'value_type',
        'value',
        'description',
        'group',
        'send_to_fe',
    ];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AppIDScope());
    }

    protected function value(): Attribute
    {
        return new Attribute(
            get: function($value){
                return match($this->value_type){
                    'array' => json_decode($value),
                    'string', 'currency' => (string)$value,
                    'integer' => (int)$value,
                    'bool' => (bool)$value,
                };
            },
            set: function($value){
                return match($this->value_type){
                    'array' => json_encode($value),
                    'string', 'currency' => (string)$value,
                    'integer' => (int)$value,
                    'bool' => (bool)$value,
                };
            }
        );
    }
}
