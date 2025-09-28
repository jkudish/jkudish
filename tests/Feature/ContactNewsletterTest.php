<?php

it('shows updated Human in the Loop newsletter opt-in on contact page', function () {
    $response = $this->get('/contact');
    
    $response->assertStatus(200);
    $response->assertSee('Human in the Loop');
    $response->assertSee('newsletter');
});
