<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Установка Passport
        $this->artisan('passport:install');
    }

    public function testGetToken()
    {
        $pass = 'pass123';
        $userParams = [
            'email' => 'test@test.ru',
            'password' => bcrypt($pass)
        ];
        $user = User::factory()->create($userParams);
        $oauthClient = DB::table('oauth_clients')->where('provider', 'users')->first();
        $response = $this->postJson('/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oauthClient->id,
            'client_secret' => $oauthClient->secret,
            'username' => $userParams['email'],
            'password' => $pass
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token'
        ]);
        $this->assertEquals('Bearer', $response->json('token_type'));
    }
}
