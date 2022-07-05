<?php

namespace PlureGames\PlureApps\Models;

use App\Models\TempUser;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use PlureGames\PlureApps\Database\Factories\UserSessionFactory;

/**
 * App\Models\UserSession
 *
 * @property int $id
 * @property string $temp_user_id
 * @property string $started_at
 * @property string|null $ended_at
 * @property string|null $start_url
 * @property string|null $referral
 * @property string|null $user_agent
 * @property string|null $device_info
 * @property string|null $ip
 * @property string|null $country
 * @property int $bot
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereDeviceInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereReferral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereStartUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereTempUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereUserAgent($value)
 * @mixin \Eloquent
 * @property Carbon $last_event_at
 * @property int $is_first_session
 * @property bool $is_vpn
 * @property string|null $close_reason
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereCloseReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereIsFirstSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSession whereLastEventAt($value)
 * @method static \Database\Factories\UserSessionFactory factory(...$parameters)
 * @property-read \App\Models\TempUser|null $user
 */
class UserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'temp_user_id',
        'started_at',
        'last_event_at',
        'ended_at',
        'is_first_session',
        'start_url',
        'referral',
        'user_agent',
        'device_info',
        'device_cap',
        'ip',
        'country',
        'state',
        'bot',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'started_at',
        'ended_at',
        'last_event_at',
    ];

    protected $casts = [
        'device_info' => AsArrayObject::class,
        'device_cap' => AsArrayObject::class,
    ];

    protected static function newFactory()
    {
        return UserSessionFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(TempUser::class, 'temp_user_id', 'temp_user_id');
    }
}
