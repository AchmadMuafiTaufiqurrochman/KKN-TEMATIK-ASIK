<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Video;
use Carbon\Carbon;

class VideoIsFinishedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function video_is_finished_returns_true_when_event_date_has_passed()
    {
        $video = Video::factory()->create([
            'started_at' => Carbon::yesterday()
        ]);

        $this->assertTrue($video->is_finished);
    }

    /** @test */
    public function video_is_finished_returns_false_when_event_date_is_in_future()
    {
        $video = Video::factory()->create([
            'started_at' => Carbon::tomorrow()
        ]);

        $this->assertFalse($video->is_finished);
    }

    /** @test */
    public function video_is_finished_returns_false_when_no_start_date()
    {
        $video = Video::factory()->create([
            'started_at' => null
        ]);

        $this->assertFalse($video->is_finished);
    }
}
