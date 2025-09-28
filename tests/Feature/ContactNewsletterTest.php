<?php

it('shows updated Human in the Loop newsletter opt-in on contact page', function () {
    $response = $this->get('/contact');
    
    $response->assertStatus(200);
    $response->assertSee('Receive Human in the Loop newsletter', false);
    $response->assertSee('Get practical insights on AI-augmented development and productivity', false);
});
