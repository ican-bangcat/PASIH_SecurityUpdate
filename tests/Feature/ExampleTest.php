<?php

it('returns successful response on home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
