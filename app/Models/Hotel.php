<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hotel
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Hotel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Hotel extends Model
{

    protected $fillable = ['name'];

    public function room_categories()
    {
        return $this->hasMany(RoomCategory::class);
    }
    public function participants_hotels() 
    {
        return $this->hasMany(Participants::class);
    }
}
