<?php

use App\Jobs\CleanOldRooms;
use App\Models\Room;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('deletes rooms older than 24 hours', function () {
    $newestRoom = Room::factory()->createOne();
    $oldRoom = Room::factory()->createOne(['created_at' => now()->subHours(24)]);
    $room23HoursOld = Room::factory()->createOne(['created_at' => now()->subHours(23)]);

    assertDatabaseCount('rooms', 3);
    CleanOldRooms::dispatchNow();
    assertDatabaseCount('rooms', 2);
    assertDatabaseHas('rooms', ['id' => $newestRoom->id]);
    assertDatabaseHas('rooms', ['id' => $room23HoursOld->id]);
    assertDatabaseMissing('rooms', ['id' => $oldRoom->id]);
});
