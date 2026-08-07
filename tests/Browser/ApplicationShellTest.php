<?php

test('the public site renders its primary content', function (): void {
    visit('/?without-third-party=1')
        ->assertSee("Hey, I'm Joey")
        ->assertNoJavaScriptErrors()
        ->assertNoConsoleLogs();
});
