<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoomCategory
 *
 * @property int $id
 * @property string $name
 * @property int $hotel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoomCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomCategory extends Model
{

    protected $fillable = ['hotel_id', 'name'];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
