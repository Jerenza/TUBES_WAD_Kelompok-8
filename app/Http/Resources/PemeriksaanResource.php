<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PemeriksaanResource extends JsonResource
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
            'dokter' => $this->dokter->nama ?? null,
            'pasien' => $this->pasien->nama ?? null,
            'diagnosa' => $this->diagnosa,
            'catatan' => $this->catatan,
            'tanggal_pemeriksaan' => $this->tanggal_pemeriksaan,
        ];
    }
}
