<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\LeadStatus;
use Illuminate\Support\Facades\DB;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $createdByUsers = collect($userIds)->shuffle()->values();
        $updatedByUsers = collect($userIds)->shuffle()->values();
        $deletedByUsers = collect($userIds)->shuffle()->values();

        foreach (range(1, 100) as $i) {
            Lead::create([
                'name' => "Lead $i",
                'email' => "lead$i@example.com",
                'phone' => "08123456" . str_pad($i, 4, '0', STR_PAD_LEFT),
                'status' => LeadStatus::cases()[$i % count(LeadStatus::cases())]->value,
                'created_by' => $createdByUsers->random(),
                'updated_by' => $updatedByUsers->random(),
                'deleted_by' => $i <= 25 ? $deletedByUsers->random() : null,
                'deleted_at' => $i <= 25 ? now() : null,
            ]);
        }

        DB::table('lead')->updateOrInsert(
            ['public_id' => '4e5d8c32-3a8b-4bdf-9d20-1a3f3e6d1f01'],
            [
                'name' => 'Lead 1',
                'email' => 'lead1@mail.com',
                'phone' => '081234567890',
                'status' => LeadStatus::NEW->value,
                'created_by' => $createdByUsers->random(),
                'updated_by' => $updatedByUsers->random(),
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
