<?php

use App\Models\User;
use Laravel\Jetstream\Features;

test('a tela de confirmação de senha pode ser renderizada', function () {
    $user = Features::hasTeamFeatures()
                    ? User::factory()->withPersonalTeam()->create()
                    : User::factory()->create();

    $response = $this->actingAs($user)->get('/user/confirm-password');

    $response->assertStatus(200);
});

test('a senha pode ser confirmada', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'errou-password',
    ]);

    $response->assertSessionHasErrors();
});
