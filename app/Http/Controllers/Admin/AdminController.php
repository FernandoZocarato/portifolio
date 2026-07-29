<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'profile' => Profile::query()->firstOrNew(),
            'skills' => Skill::query()->orderBy('sort_order')->get(),
            'projects' => Project::query()->orderBy('sort_order')->get(),
            'experiences' => Experience::query()->orderByDesc('start_date')->get(),
            'messages' => ContactMessage::query()->latest()->limit(50)->get(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'tagline' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string', 'max:5000'],
            'location' => ['nullable', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
        ]);

        $profile = Profile::query()->first() ?? new Profile();
        $profile->fill($data)->save();

        return $this->saved('Perfil atualizado.');
    }

    public function storeSkill(Request $request): RedirectResponse
    {
        Skill::create($this->validateSkill($request));

        return $this->saved('Tecnologia adicionada.');
    }

    public function updateSkill(Request $request, Skill $skill): RedirectResponse
    {
        $skill->update($this->validateSkill($request, $skill));

        return $this->saved('Tecnologia atualizada.');
    }

    public function destroySkill(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return $this->saved('Tecnologia removida.');
    }

    public function storeProject(Request $request): RedirectResponse
    {
        Project::create($this->validateProject($request));

        return $this->saved('Projeto adicionado.');
    }

    public function updateProject(Request $request, Project $project): RedirectResponse
    {
        $project->update($this->validateProject($request));

        return $this->saved('Projeto atualizado.');
    }

    public function destroyProject(Project $project): RedirectResponse
    {
        $project->delete();

        return $this->saved('Projeto removido.');
    }

    public function storeExperience(Request $request): RedirectResponse
    {
        Experience::create($this->validateExperience($request));

        return $this->saved('Experiência adicionada.');
    }

    public function updateExperience(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validateExperience($request));

        return $this->saved('Experiência atualizada.');
    }

    public function destroyExperience(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return $this->saved('Experiência removida.');
    }

    public function destroyMessage(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return $this->saved('Mensagem removida.');
    }

    private function validateSkill(Request $request, ?Skill $skill = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:80', Rule::unique('skills')->ignore($skill)],
            'category' => ['nullable', 'string', 'max:80'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);
    }

    private function validateProject(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'summary' => ['required', 'string', 'max:2000'],
            'technologies' => ['required', 'string', 'max:1000'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'code_url' => ['nullable', 'url', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'is_demo' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['technologies'] = collect(explode(',', $data['technologies']))
            ->map(fn (string $technology) => trim($technology))
            ->filter()
            ->unique()
            ->values()
            ->all();
        $data['is_demo'] = $request->boolean('is_demo');

        return $data;
    }

    private function validateExperience(Request $request): array
    {
        return $request->validate([
            'role' => ['required', 'string', 'max:160'],
            'company' => ['required', 'string', 'max:160'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);
    }

    private function saved(string $message): RedirectResponse
    {
        return back()->with('admin_success', $message);
    }
}
