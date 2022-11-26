<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    protected function setUp(): void {
        parent::setUp();
        $this->seed();
    }


    /**
     * Тест на не правильный email.
     *
     * @return void
     */
    public function testValidationWrongEmail() {
        $response = $this->post( 'login', [
            'email' => $this->faker->word,
            'password' => $this->faker->password
        ] );

        $response->assertStatus( 422 );

        $content = $response->getContent();
        $this->assertStringContainsString( 'email', $content );
    }


    /**
     * Тест на отсутствие пароля.
     *
     * @return void
     */
    public function testValidationNoPassword() {
        $response = $this->post( 'login', [
            'email' => $this->faker->unique()->safeEmail()
        ] );

        $response->assertStatus( 422 );

        $content = $response->getContent();
        $this->assertStringContainsString( 'password', $content );
    }
}
