<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_page()
    {
        $this->markTestSkipped('Admin dashboard route not implemented');
    }

    public function test_operator_cannot_access_admin_page()
    {
        $this->markTestSkipped('Admin dashboard route not implemented');
    }

    public function test_guest_redirected_from_admin_page()
    {
        $this->markTestSkipped('Admin dashboard route not implemented');
    }
}
