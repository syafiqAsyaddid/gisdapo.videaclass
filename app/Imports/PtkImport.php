<?php

namespace App\Imports;

use App\Models\Ptk;
use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\StatusPegawai;
use App\Models\Pendidikan;
use Carbon\Carbon;

class PtkImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $statusMap = StatusPegawai::all()->pluck('id', 'status')->mapWithKeys(function ($item, $key) {
            return [strtolower(trim($key)) => $item];
        });

        $pendidikanMap = Pendidikan::all()->pluck('id', 'pendidikan')->mapWithKeys(function ($item, $key) {
            return [strtolower(trim($key)) => $item];
        });

        foreach ($rows as $row) {
            // Basic normalization
            $nip = isset($row['nip']) ? trim($row['nip']) : (isset($row['nipnuptk']) ? trim($row['nipnuptk']) : null);
            $nama = isset($row['nama']) ? trim($row['nama']) : (isset($row['nama_lengkap']) ? trim($row['nama_lengkap']) : null);
            
            if (!$nip || !$nama) {
                continue;
            }

            // Status Lookup (Match Image 1 header: Status (PNS/Non-PNS))
            $statusName = '';
            if (isset($row['status_pnsnon_pns'])) {
                $statusName = strtolower(trim($row['status_pnsnon_pns']));
            } elseif (isset($row['status'])) {
                $statusName = strtolower(trim($row['status']));
            }
            
            $statusId = $statusMap[$statusName] ?? 2; // Default to Non PNS (id 2)

            // Pendidikan Lookup - Flexible as requested
            $pendidikanVal = isset($row['pendidikan']) ? trim($row['pendidikan']) : 'Sarjana 1';
            $pendidikan = Pendidikan::firstOrCreate(['pendidikan' => $pendidikanVal]);
            $pendidikanId = $pendidikan->id;

            // Date Handling
            $tanggalLahir = null;
            if (isset($row['tanggal_lahir'])) {
                try {
                    if (is_numeric($row['tanggal_lahir'])) {
                        $tanggalLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d');
                    } else {
                        $tanggalLahir = Carbon::parse($row['tanggal_lahir'])->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    $tanggalLahir = null;
                }
            }

            $attributes = [
                'nip' => $nip,
                'nama' => $nama,
                'tempat_lahir' => $row['tempat_lahir'] ?? '-',
                'tanggal_lahir' => $tanggalLahir ?? now()->format('Y-m-d'),
                'alamat' => $row['alamat'] ?? '-',
                'telepon' => $row['telepon'] ?? $row['teleponhp'] ?? null,
                'email' => $row['email'] ?? null,
                'status_pegawai_id' => $statusId,
                'pendidikan_id' => $pendidikanId,
                'jabatan' => $row['jabatan'] ?? '-',
                'sekolah_id' => $sekolah->id
            ];

            Ptk::updateOrCreate(
                ['nip' => $nip, 'sekolah_id' => $sekolah->id],
                $attributes
            );
        }
    }
}
