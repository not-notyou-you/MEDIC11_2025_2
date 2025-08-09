<?php

namespace App\Imports;

use App\Models\Service;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServicesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $validStatuses = Service::getStatuses();

        foreach ($rows as $row) {
            $validator = Validator::make($row->toArray(), [
                'status' => ['required', Rule::in($validStatuses)],
                'email' => 'required|email',
                'date' => 'required|date',
            ]);

            if ($validator->fails()) {
                continue;
            }

            $medicalEquipment = null;
            if (!empty($row['medical_equipment'])) {
                $medicalEquipment = array_map('trim', explode(',', $row['medical_equipment']));
            }

            $service = Service::updateOrCreate(
                ['id' => $row['id'] ?? null],
                [
                    'name' => $row['name'],
                    'nim' => $row['nim'],
                    'email' => $row['email'],
                    'type' => $row['type'],
                    'phone' => $row['phone'],
                    'line' => $row['line_id'],
                    'organization' => $row['organization'],
                    'title' => $row['title'],
                    'event_name' => $row['event_name'],
                    'description' => $row['description'],
                    'date' => $row['date'],
                    'start_time' => $row['start_time'],
                    'end_time' => $row['end_time'],
                    'location' => $row['location'],
                    'person' => $row['person'],
                    'medical_equipment' => $medicalEquipment,
                    'note' => $row['note'],
                    'status' => $row['status']
                ]
            );
        }
    }
}