<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class PortfolioApiController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::query()->firstOrFail();

        return response()->json($profile->only([
            'name', 'tagline', 'about', 'location', 'email', 'github', 'linkedin',
        ]));
    }

    public function skills(): JsonResponse
    {
        return response()->json(
            Skill::query()->orderBy('sort_order')->get(['name', 'category'])
        );
    }

    public function projects(): JsonResponse
    {
        return response()->json(Project::query()->orderBy('sort_order')->get()->map(fn (Project $project) => [
            'id' => $project->id,
            'title' => $project->title,
            'summary' => $project->summary,
            'technologies' => $project->technologies,
            'demoUrl' => $project->demo_url,
            'codeUrl' => $project->code_url,
            'imageUrl' => $project->image_url,
            'isDemo' => $project->is_demo,
        ]));
    }

    public function experiences(): JsonResponse
    {
        return response()->json(Experience::query()->orderByDesc('start_date')->get()->map(fn (Experience $experience) => [
            'id' => $experience->id,
            'role' => $experience->role,
            'company' => $experience->company,
            'startDate' => $experience->start_date?->toDateString(),
            'endDate' => $experience->end_date?->toDateString(),
            'description' => $experience->description,
        ]));
    }
}
