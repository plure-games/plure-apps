<?php

namespace PlureGames\PlureApps\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PlureGames\PlureApps\Database\Factories\AppFactory;

/**
 * PlureGames\PlureApps\Models\App
 *
 * @property int $id
 * @property string $name
 * @property string|null $url
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|App newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|App newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|App query()
 * @method static \Illuminate\Database\Eloquent\Builder|App whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereShowPWAAfterGameX($value)
 * @mixin \Eloquent
 * @mixin IdeHelperApp
 * @method static \Database\Factories\AppFactory factory(...$parameters)
 */

/**
 * @OA\Schema(
 *   schema="App",
 *   type="object",
 *   required={"name", "url"},
 *
 *     @OA\Property(property="id",title="ID",description="Tournament ID",example="1",type="integer"),
 *     @OA\Property(property="name",title="Name",description="Name of the app",example="Application",type="string"),
 *     @OA\Property(property="url",title="URL",description="URL of the app",example="https://solitaire.com",type="string"),
 *     @OA\Property(property="currency_id",title="Currency ID",description="ID of start balance currency",example="2",type="integer"),
 *     @OA\Property(property="currency_amount",title="Currency amount",description="Amount of start balance currency",example="2",type="integer"),
 *     @OA\Property(property="tutorial_currency_id",title="Tutorial Currency ID",description="ID of tutorial reward currency",example="2",type="integer"),
 *     @OA\Property(property="tutorial_currency_amount",title="Tutorial Currency amount",description="Amount of tutorial reward currency",example="2",type="integer"),
 * )
 * Class Cases
 * @package Incase\Models
 */
class App extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return AppFactory::new();
    }

    protected $casts = [
        'opponents' => 'array'
    ];

    protected $fillable = [
        'name',
        'url'
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(AppSetting::class);
    }

    public function getUrl(): string
    {
        return rtrim($this->url, '/');
    }

    public function getSetting($setting)
    {
        return $this->settings->where('key', $setting)->first()?->value;
    }
}
