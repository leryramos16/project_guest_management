<?php

namespace Database\Seeders;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $rooms = [
            '101', '102', '103', '105', '106', '107',
            '201', '202', '203', '205', '206', '207',
            'Office 1', 'Extra 1', 'Extra 2', 'Extra 3', 'Extra 4',
        ];

        foreach ($rooms as $room) {
            Room::create([
                'room_number' => $room
            ]);
        }
    }
}
