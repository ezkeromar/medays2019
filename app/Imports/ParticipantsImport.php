<?php

namespace App\Imports;

use App\Models\Participants;
use App\Models\ParticipantType;
use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\ImportFailed;


class ParticipantsImport implements ToModel, WithBatchInserts, ShouldQueue, WithEvents, WithChunkReading, WithHeadingRow
{

    protected $type;
    protected $user;

    /**
     * ParticipantsImport constructor.
     *
     * @param int $type
     * @param \App\Models\User $user
     */
    public function __construct(int $type, User $user)
    {
        $this->type = ParticipantType::find($type);
        $this->user = $user;
    }

    /**
     * @param array $row
     *
     * @return \App\Models\Participants
     */
    public function model(array $row)
    {
        $status = [];
        $status[1] = 'en attente';
        $status[2] = 'invitation envoyée';
        $status[3] = 'validée';
        $status[4] = 'refusée';
        $status[5] = 'désactivé';
        $status[6] = 'demande transport';
        $status[7] = 'attente informations transfert';
        $status[8] = 'badge en cours d’édition';
        $status[9] = 'badge édité';
        $status[10] = 'badge livré';
        $status[13] = 'attente de validation';

        $selectedStatus = array_search(strtolower($row['statut']), $status);
        $data = [
            'civility'         => strcasecmp($row['civilite'], 'mr') == 0 ? 2 : 1,
            'last_name'        => $row['nom'],
            'first_name'       => $row['prenom'],
            'organization'     => $row['organisme'],
            'type_id'          => $this->type->id,
            'email'            => $row['email'],
            'function'         => $row['fonction'],
            'webcode'          => $this->generateRandomString(10, false),
            'access_code'      => $this->generateRandomString(6),
            "restoration"      => $this->type->restoration,
            "has_restoration"  => is_null($this->type->restoration) ? 1 : 2,
            "has_hebergement"  => is_null($this->type->hotel_id) ? 1 : 2,
            'identity_type'    => strcasecmp($row['type_piece_didentite'], 'cin') == 0 ? 1 : 2,
            'num_identity'     => $row['numero_piece_didentite'],
            'language'         => $row['langue'],
            'status'           => $selectedStatus ? $selectedStatus : 1,
            "hotel_id"         => $this->type->hotel_id,
            "room_type"        => $this->type->room_type,
            "room_category_id" => $this->type->room_category_id,
            "inscriptionDate"  => Carbon::now()
        ];

        return new Participants($data);
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $this->user->notify(new ImportHasFailedNotification());
            },
        ];
    }

    /**
     * Generate random string for | WebCode | Access Code
     */
    private function generateRandomString($length = 10, $numberto = true)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        if ($numberto) {
            $characters .= $numbers;
        }
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
