<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ValidationTest extends TestCase
{
    /**
     * Тест на не правильный email.
     *
     * @return void
     */
    public function testValidationWrongEmail() {
        $this->seed();
        $response = $this->post( 'login', [ 'email' => 'someWrongEmail', 'password' => '123456' ] );
        // dd( $response );
        $response->assertStatus( 422 );
        $content = $response->getContent();
        // dd( $content );
        $this->assertStringContainsString( 'email', $content );
    }


    /**
     * Тест на отсутствие пароля.
     *
     * @return void
     */
    public function testValidationNoPassword() {
        $this->seed();
        $response = $this->post( 'login', [ 'email' => 'testEmail@example.com' ] );
        $response->assertStatus( 422 );
        $content = $response->getContent();
        $this->assertStringContainsString( 'password', $content );
    }
}
