<?php

namespace App\Models;

use App\Scopes\ParticipantScope;
use App\Scopes\ParticipantTypeScope;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ParticipantType
 *
 * @property int $id
 * @property string $name
 * @property int|null $group_id
 * @property int|null $participant_features_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereParticipantFeaturesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParticipantType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParticipantType extends Model
{


    protected $fillable = ['group_id', 'name', 'hotel_id', 'room_type', 'room_category_id', 'restoration'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room_catrgory()
    {
        return $this->hasOne(RoomCategory::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ParticipantTypeScope());
    }

}
