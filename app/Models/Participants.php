<?php

namespace App\Models;

use App\Country;
use App\Scopes\ParticipantScope;
use App\Scopes\ParticipantTypeScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * App\Models\Participants
 *
 * @property int $id
 * @property int $civility
 * @property string $first_name
 * @property string $last_name
 * @property string|null $birthday
 * @property string|null $function
 * @property string|null $organization
 * @property string|null $nationality
 * @property string|null $cin
 * @property string|null $passport
 * @property string|null $country
 * @property string|null $city
 * @property string $email
 * @property string|null $level
 * @property string $identity_type
 * @property string $num_identity
 * @property string|null $pro_phone
 * @property string|null $mobile_phone
 * @property string|null $webcode
 * @property string|null $access_code
 * @property int $status
 * @property int|null $type_id
 * @property string $language
 * @property int $has_restoration
 * @property int $has_hebergement
 * @property int $has_transfert
 * @property int $has_pec
 * @property string|null $air_ticket
 * @property int|null $parent_id
 * @property string|null $restoration
 * @property string|null $hotel_id
 * @property int|null $room_category_id
 * @property int|null $room_type
 * @property string|null $arrival_date
 * @property string|null $departure_date
 * @property int|null $nights_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string civility_name
 * @property string room_type_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereAccessCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereAirTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereArrivalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereCin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereCivility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereDepartureDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereHasHebergement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereHasPec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereHasRestoration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereHasTransfert($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereIdentityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereNightsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereNumIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereProPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereRestoration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereRoomCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereRoomType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Participants whereWebcode($value)
 * @mixin \Eloquent
 */
class Participants extends Model
{
    use Notifiable;
    protected $table = 'participants';
    protected $primaryKey = 'id';

    protected $guarded = [];

    /* protected $fillable = [
         'type_id',
         'level',
         'civility',
         'first_name',
         'last_name',
         'birthday',
         'organization',
         'function',
         'nationality',
         'identity_type',
         'num_identity',
         'country',
         'city',
         'email',
         'pro_phone',
         'mobile_phone',
         'webcode',
         'access_code',
         'has_pec',
         'has_transfert',
         'has_hebergement',
         'has_restoration',
         'hotel_id',
         'room_type',
         'room_category_id',
         'restoration',
         'language',
         'status',
         'inscriptionDate',
         'transfer_arrival_date',
         'transfer_arrival_time',
         'departure_date',
         'arrival_date',
         'transfer_departure_date',
         'desired_arrival_date',
         'desired_arrival_hour',
         'pec_departure_airport',
         'desired_departure_hour',
         'desired_departure_date',
         'pec_arrival_airport',
         'departure_deposit_point',
         'departure_recovery_point',
         'departure_flight_number',
         'departure_airline_company',
         'departure_airport',
         'transfer_departure_time',
         'transfer_departure_date',
         'arrival_deposit_point',
         'arrival_recovery_point',
         'arrival_flight_number',
         'arrival_airline_company',
         'arrival_airport',
         'transfer_arrival_time',
         'transfer_arrival_date',
         'nights_count',
     ];*/

    protected $dates = [
        'inscriptionDate',
        // 'arrival_date',
        // 'departure_date',
        // 'transfer_arrival_date',
        // 'transfer_departure_date',
    ];

    public function insertData($data)
    {
        DB::table('participants')->insert($data);

        return true;
    }

    public function type()
    {
        return $this->belongsTo(ParticipantType::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ParticipantScope());
    }


    public function getCivilityNameAttribute()
    {
        if ($this->language == 'en') {
            return $this->civility == 1 ? "Ma'am" : 'Mister';
        }

        return $this->civility == 1 ? 'Madame' : 'Monsieur';
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIdentityTypeNameAttribute()
    {
        if ($this->identity_type) {
            return $this->identity_type == 1 ? 'CIN' : 'Passport';
        }

        return '';
    }

    public function getRoomTypeNameAttribute()
    {
        if ($this->room_type == 1) {
            return 'Single';
        }
        if ($this->room_type == 2) {
            return "Double";
        }

        if ($this->room_type == 3) {
            return "Twin";
        }

        return '';
    }

    public function theCountry()
    {
        return $this->belongsTo(Country::class, 'country', 'code2');
    }

    public function theNationality()
    {
        return $this->belongsTo(Country::class, 'nationality', 'code2');
    }

    public function theRestoration()
    {
        return $this->belongsTo(Restaurant::class, 'restoration', 'id');
    }

    public function roomCategory()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    protected function getStatusNameAttribute()
    {
        $status = [];
        $status[1] = 'En attente';
        $status[2] = 'Invitation envoyée';
        $status[3] = 'Validée';
        $status[4] = 'Refusée';
        $status[5] = 'Désactivé';
        $status[6] = 'Demande transport';
        $status[7] = 'Attente informations transfert';
        $status[8] = 'Badge en cours d’édition';
        $status[9] = 'Badge édité';
        $status[10] = 'Badge livré'; 
        $status[13] = 'Attente de validation';

        if (isset($status[$this->status])) {
            return $status[$this->status];
        }

        return '';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'participant_id');
    }

    public static function commentsCount($id)
    {
        return Comment::where('participant_id', '=', $id)->count();
    }

    public function chef()
    {
        return $this->belongsTo(Participants::class, 'parent_id');
    }
    public function getStateFormationAttribute() {
        if($this->formation_state == 1)
         return 'Attente paiement';
        else if($this->formation_state == 2)
         return 'Payée';
        else if($this->formation_state == 3)
         return 'Annulée';

        return '';
    }
}
