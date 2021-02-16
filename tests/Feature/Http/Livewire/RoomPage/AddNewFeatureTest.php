<?php

use App\Http\Livewire\RoomPage;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Tests\TestCase;

it('sees as a manager', function () {
    livewire(RoomPage::class)
    ->assertSee('You are the Manager');

    expect(Session::get('isManager'))->toBeTrue();
});

it('creates a new feature', function () {
    livewire(RoomPage::class)
        ->set('newFeature', 'Jetete')
        ->call('addNewFeature');

    assertDatabaseCount('features', 1);
    assertDatabaseHas('features', [
        'name' => 'Jetete',
    ]);
});

it('requires feature name')
    ->livewire(RoomPage::class)
    ->set('newFeature', '')
    ->call('addNewFeature')
    ->assertHasErrors(['newFeature' => 'required']);

it('has max of 255 characters', function () {
    $invalidFeature = Str::random(256);
    $validFeature = Str::random(255);
    $errorMessage = trans('validation.max.string', [
        'attribute' => 'new feature',
        'max' => 255
    ]);

    livewire(RoomPage::class)
        ->set('newFeature', $invalidFeature)
        ->call('addNewFeature')
        ->assertHasErrors(['newFeature' => 'max'])
        ->assertSee($errorMessage)
        ->set('newFeature', $validFeature)
        ->call('addNewFeature')
        ->assertDontSee($errorMessage);

    $this->assertDatabaseCount('features', 1);
});
