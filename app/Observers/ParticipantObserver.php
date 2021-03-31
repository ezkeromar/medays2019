<?php

namespace App\Observers;

use App\Models\Participants;
use Illuminate\Support\Facades\Log;

class ParticipantObserver
{
    /**
     * Handle the participants "created" event.
     *
     * @param \App\Models\Participants $participants
     *
     * @return void
     */
    public function created(Participants $participants)
    {
        $type = $participants->type;

        if ($type) {

            Log::info('observer type ' . $participants->type_id . ' id:' . $participants->id);
            Log::info('observer type ' . json_encode($type));

            $participants->update([
                    "restoration"      => $type->restoration,
                    "has_restoration"  => is_null($type->restoration) ? 1 : 2,
                    "has_hebergement"  => is_null($type->hotel_id) ? 1 : 2,
                    "hotel_id"         => $type->hotel_id,
                    "room_type"        => $type->room_type,
                    "room_category_id" => $type->room_category_id,
                ]
            );
        }

    }

    /**
     * Handle the participants "updated" event.
     *
     * @param \App\Models\Participants $participants
     *
     * @return void
     */
    public function updated(Participants $participants)
    {
        //
    }

    /**
     * Handle the participants "deleted" event.
     *
     * @param \App\Models\Participants $participants
     *
     * @return void
     */
    public function deleted(Participants $participants)
    {
        //
    }

    /**
     * Handle the participants "restored" event.
     *
     * @param \App\Models\Participants $participants
     *
     * @return void
     */
    public function restored(Participants $participants)
    {
        //
    }

    /**
     * Handle the participants "force deleted" event.
     *
     * @param \App\Models\Participants $participants
     *
     * @return void
     */
    public function forceDeleted(Participants $participants)
    {
        //
    }
}
