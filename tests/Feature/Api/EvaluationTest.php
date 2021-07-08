<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Str;
use App\Models\Evaluation;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_evaluations_empty()
    {
        $response = $this->getJson('/evaluations/{fake-company}');
        // $response->dump();
        $response->assertStatus(200)
                ->assertJsonCount(0, 'data');
    }

    /**
     * Get All Evaluations.
     *
     * @return void
     */
    public function test_get_evaluations_company()
    {
        $company = (string) Str::uuid();
        $evaluations = Evaluation::factory()->count(6)->create([
            'company' => $company
        ]);
        $response = $this->getJson("/evaluations/{$company}");
        // $response->dump();

        $response->assertStatus(200)
                ->assertJsonCount(6, 'data');
    }
    
    /**
     * Test validatios.
     *
     * @return void
     */
    public function test_error_store_evaluations()
    {
        $company = 'fake-company';
        
        $response = $this->postJson("/evaluations/{$company}", [
            'company' => (string) Str::uuid(),
            'comment' => 'New comment',
            'stars' => 5,
        ]);

        $response->assertStatus(404);
    }

    /**
     * Test Store.
     *
     * @return void
     */
    public function test_store_evaluations()
    {
        $company = 'fake-company';
        
        $response = $this->postJson("/evaluations/{$company}", []);

        $response->assertStatus(422);
    }
}
