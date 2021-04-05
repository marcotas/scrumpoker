<?php

use App\Http\Livewire\VotingFeature;
use App\Models\Feature;
use App\Models\Room;
use function Pest\Laravel\assertDatabaseHas;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;
use Illuminate\Support\Str;

it('should save feature name', function () {
    // Arrange
    $room = Room::factory()->create();
    actingAsManager($room);
    /** @var Feature $feature */
    $feature = Feature::factory()
        ->for($room)
        ->createOne();

    // Act
    livewire(VotingFeature::class, [
        'selectedFeatureId' => $feature->id,
    ])
        ->set('feature.name', 'jetete')
        ->call('saveFeature');

    // Assert
    assertDatabaseHas('features', [
        'id' => $feature->id,
        'name' => 'jetete',
    ]);
});

it('cannot be done by non manager', function () {
    $feature = Feature::factory()
        ->for(Room::factory())
        ->createOne();

    livewire(VotingFeature::class, [
        'selectedFeatureId' => $feature->id
    ])->assertSee($feature->name)
        ->set('feature.name', 'jetete')
        ->call('saveFeature');

    assertDatabaseMissing('features', [
        'id' => $feature->id,
        'name' => 'jetete',
    ]);
});

it('dispatches a feature updated event', function () {
    $room = Room::factory()->create();
    actingAsManager($room);
    /** @var Feature $feature */
    $feature = Feature::factory()
        ->for($room)
        ->createOne();

    livewire(VotingFeature::class, [
        'selectedFeatureId' => $feature->id
    ])
        ->set('feature.name', 'jetete')
        ->call('saveFeature')
        ->assertEmitted('featureUpdated.' . $feature->id);
});
it('requires name field', function () {
    $room = Room::factory()->create();
    actingAsManager($room);
    /** @var Feature $feature */
    $feature = Feature::factory()
        ->for($room)
        ->createOne();

    livewire(VotingFeature::class, [
        'selectedFeatureId' => $feature->id
    ])->set('feature.name', '')
        ->call('saveFeature')
        ->assertHasErrors(['feature.name' => 'required'])
        ->assertSee(trans('validation.required', [
            'attribute' => 'name',
        ]));
});
test('name field has max of 255 characters', function () {
    $invalidFeatureName = Str::random(256);
    $validFeatureName = Str::random(255);
    $room = Room::factory()->create();
    actingAsManager($room);
    /** @var Feature $feature */
    $feature = Feature::factory()
        ->for($room)
        ->createOne();

    livewire(VotingFeature::class, [
        'selectedFeatureId' => $feature->id
    ])->set('feature.name', $invalidFeatureName)
        ->call('saveFeature')
        ->assertHasErrors(['feature.name' => 'max'])
        ->assertSee(trans('validation.max.string', [
            'attribute' => 'name',
            'max' => 255,
        ]))
        ->set('feature.name', $validFeatureName)
        ->call('saveFeature');
    assertDatabaseHas('features', [
        'id' => $feature->id,
        'name' => $validFeatureName,
    ]);
});
