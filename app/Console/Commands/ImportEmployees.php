<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;

class ImportEmployees extends Command
{
    protected $signature = 'employees:import {file}';
    protected $description = 'Import employees from CSV and create default user accounts';

    public function handle(): int
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File tidak ditemukan: {$file}");
            return self::FAILURE;
        }

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        $imported = 0;
        $usersCreated = 0;

        foreach ($records as $row) {
            $row = array_combine(
                array_map(fn($k) => trim((string)$k), array_keys($row)),
                array_map(fn($v) => is_string($v) ? trim($v) : $v, array_values($row))
            );

            $employeeId = $row['id_karyawan'] ?? null;
            $name       = $row['nama'] ?? null;
            $email      = $row['email'] ?? null;
            $department = $row['departemen'] ?? null;
            $position   = $row['jabatan'] ?? null;

            if (!$employeeId || !$name) {
                continue;
            }

            $employee = Employee::updateOrCreate(
                ['employee_id' => $employeeId],
                [
                    'name'       => $name,
                    'email'      => $email ?: null,
                    'department' => $department ?: null,
                    'position'   => $position ?: null,
                    'is_active'  => true,
                ]
            );

            $imported++;

            $user = User::firstOrCreate(
                ['employee_id' => $employeeId],
                [
                    'name'       => $name,
                    'email'      => $email ?: null,
                    'password'   => Hash::make('balimed1'),
                    'role_label' => 'user',
                    'is_active'  => true,
                ]
            );

            if ($user->wasRecentlyCreated) {
                $user->assignRole('user');
                $usersCreated++;
            }
        }

        $this->info("Import selesai.");
        $this->info("Data karyawan diproses: {$imported}");
        $this->info("User baru dibuat: {$usersCreated}");

        return self::SUCCESS;
    }
}