<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ContactForm;
use App\Models\User;
use App\Notifications\ContactMessageNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_contact_form(): void
    {
        Notification::fake();

        User::factory()->create(['role' => 'admin']);

        Livewire::test(ContactForm::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('message', 'Hello, this is a test message.')
            ->call('save')
            ->assertSet('success', true);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Notification::assertSentTo(
            User::admins()->get(),
            ContactMessageNotification::class
        );
    }

    public function test_validates_required_fields(): void
    {
        Livewire::test(ContactForm::class)
            ->call('save')
            ->assertHasErrors(['name', 'email', 'message']);
    }

    public function test_validates_email_format(): void
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'not-an-email')
            ->call('save')
            ->assertHasErrors(['email']);
    }
}
