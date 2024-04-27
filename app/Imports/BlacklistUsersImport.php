<?php

namespace App\Imports;

use App\Models\BlacklistUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BlacklistUsersImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $email = $row[0];
        $existingUser = BlacklistUser::where('email', $email)->first();
        if (!$existingUser) {
            return new BlacklistUser([
                'email' => $row[0],
                'ip_address' => $row[1],
            ]);
        }
        return null;
    }

    public function StartRow(): int
    {
        return 2;
    }
}
