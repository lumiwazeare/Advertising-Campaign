<?php

namespace Tests\Feature;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    /**
     * Test campaign creation.
     *
     * @return void
     */
    public function test_create_campaign()
    {
        //generate dummy image
        Storage::fake('campaign');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $data = [
            'name' => $this->faker->name,
            'dailyBudget' => $this->faker->numberBetween(100,1000),
            'totalBudget' => $this->faker->numberBetween(4000,10000),
            'startDate' => '2021-02-02',
            'endDate' => '2021-05-10',
            'images' => [$file]
        ];
        $response = $this->post('api/campaign/add', $data);
        $response->assertStatus(200);

        Storage::assertExists($file->hashName());
    }

    public function test_edit_campaign()
    {

        $campaignModel = Campaign::create(
            [
                'name' => $this->faker->name,
                'daily_budget' => $this->faker->numberBetween(100,1000),
                'total_budget' => $this->faker->numberBetween(4000,10000),
                'start_date' => '2021-02-02',
                'end_date' => '2021-05-10',
                'campaign_image_id' => 1
            ]
        );

        $data = [
            'name' => $this->faker->name,
            'dailyBudget' => $this->faker->numberBetween(100,1000),
            'totalBudget' => $this->faker->numberBetween(4000,10000),
            'startDate' => '2021-02-02',
            'endDate' => '2021-05-10',
            'campaignId' => $campaignModel->id
        ];
        $response = $this->post('api/campaign', $data);
        $response->assertStatus(200);

    }
}
