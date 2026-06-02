<?php

namespace Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_locale_is_english(): void
    {
        $this->get('/');

        $this->assertEquals('en', app()->getLocale());
    }

    public function test_locale_can_be_switched_to_english(): void
    {
        $this->get(route('locale.switch', 'en'));
        $this->get('/');

        $this->assertEquals('en', app()->getLocale());
    }

    public function test_locale_can_be_switched_to_spanish(): void
    {
        $this->get(route('locale.switch', 'es'));
        $this->get('/');

        $this->assertEquals('es', app()->getLocale());
    }

    public function test_invalid_locale_ignored(): void
    {
        $this->get(route('locale.switch', 'fr'));
        $this->get('/');

        $this->assertEquals('en', app()->getLocale());
    }
}
