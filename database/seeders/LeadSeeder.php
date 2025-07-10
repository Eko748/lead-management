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

        $createdByUsers = collect($userIds)->shuffle()->take(50)->values();
        $updatedByUsers = collect($userIds)->shuffle()->take(25)->values();
        $deletedByUsers = collect($userIds)->shuffle()->take(25)->values();

        foreach (range(1, 100) as $i) {
            Lead::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => '08' . rand(100000000, 999999999),
                'status' => collect(LeadStatus::cases())->random()->value,
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
