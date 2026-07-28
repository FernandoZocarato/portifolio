<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('portfolio', [
            'profile' => Profile::query()->first(),
            'skills' => Skill::query()->orderBy('sort_order')->get(),
            'projects' => Project::query()->orderBy('sort_order')->get(),
            'experiences' => Experience::query()->orderByDesc('start_date')->get(),
        ]);
    }

    public function contact(StoreContactRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->safe()->except('website'),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Contato registrado com sucesso. Obrigado pela mensagem!');
    }
}
