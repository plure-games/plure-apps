<?php

namespace PlureGames\PlureApps\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * )
 * Class Cases
 * @package Incase\Models
 */
class App extends Model
{
    use HasFactory;


    protected static function newFactory()
    {
        return \PlureGames\PlureApps\Database\Factories\AppFactory::new();
    }

    protected $fillable = [
        'name',
    ];

    public function getUrl(): string
    {
        return rtrim($this->url, '/');
    }
}
