<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pasien' => $this->pasien->nama ?? null,
            'dokter' => $this->dokter->nama ?? null,
            'tanggal_reservasi' => $this->tanggal_reservasi,
            'waktu_reservasi' => $this->waktu_reservasi,
            'status' => $this->status,
        ];
    }
}
