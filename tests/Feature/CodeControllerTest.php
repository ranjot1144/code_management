<?php

namespace Tests\Feature;

use Database\Factories\CodeFactory;

use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class CodeControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testGenerateUniqueCode()
    {
        \DB::enableQueryLog();

        // Send a POST request to generate a unique code
        $response = $this->postJson(route('generate-code'));

        // Assert the response status code and structure
        $response->assertStatus(200)
            ->assertJsonStructure(['Unique Code Generated successfully']);

        // Get the generated unique code from the response
        $uniqueCode = $response->json('Unique Code Generated successfully');

        // Query the database to check if the record exists
        $codeRecord = Code::where('code', $uniqueCode)->first();
        $this->assertNotNull($codeRecord);

        // The record should be saved in the database
        $this->assertTrue(Code::where('code', $uniqueCode)->exists());

        // Print executed queries for debugging
        dd(\DB::getQueryLog());
    }

    public function testResetAllocatedCode()
    {
        // Create an allocated code
        $allocatedCode = Code::factory()->create(['allocated' => true]);


        // Send a POST request to reset the allocated code
        $response = $this->postJson(route('reset-allocated-code'), ['code' => $allocatedCode->code]);

        // Assert the response status code and structure
        $response->assertStatus(200)
            ->assertJsonStructure(['message']);

        // Assert the allocated code is reset in the database
        $this->assertFalse(Code::where('code', $allocatedCode->code)->where('allocated', true)->exists());
    }


}
