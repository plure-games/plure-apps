<?php

namespace PlureGames\PlureApps\Models;

use App\Services\Micros;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @mixin \Eloquent
 * @mixin IdeHelperApp
 * @method static \Database\Factories\AppFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereUrl($value)
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
 * )
 * Class Cases
 * @package Incase\Models
 */
class App extends Model
{
    use HasFactory;

    protected $casts = [
        'currency_amount' => Micros::class,
    ];

    protected static function newFactory()
    {
        return AppFactory::new();
    }

    protected $fillable = [
        'name',
    ];

    public function getUrl(): string
    {
        return rtrim($this->url, '/');
    }

    public function balanceCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
