<?php

test('connectivity endpoint reports database and redis ok', function () {
    $response = $this->getJson(route('connectivity'));

    $response->assertSuccessful()
        ->assertJson([
            'database' => ['ok' => true, 'error' => null],
            'redis' => ['ok' => true, 'error' => null],
        ]);
});
