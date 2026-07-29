@php($project = $project ?? null)
<label class="admin-label">Título<input class="{{ $field }}" name="title" value="{{ old('title', $project?->title) }}" required></label>
<label class="admin-label">Ordem<input class="{{ $field }}" type="number" min="0" name="sort_order" value="{{ old('sort_order', $project?->sort_order ?? 0) }}" required></label>
<label class="admin-label sm:col-span-2">Resumo<textarea class="{{ $field }} min-h-24" name="summary" required>{{ old('summary', $project?->summary) }}</textarea></label>
<label class="admin-label sm:col-span-2">Tecnologias <span class="font-normal text-muted-foreground">(separadas por vírgula)</span><input class="{{ $field }}" name="technologies" value="{{ old('technologies', $project ? implode(', ', $project->technologies ?? []) : '') }}" required></label>
<label class="admin-label">Link da demonstração<input class="{{ $field }}" type="url" name="demo_url" value="{{ old('demo_url', $project?->demo_url) }}"></label>
<label class="admin-label">Link do código<input class="{{ $field }}" type="url" name="code_url" value="{{ old('code_url', $project?->code_url) }}"></label>
<label class="admin-label sm:col-span-2">URL da imagem <span class="font-normal text-muted-foreground">(opcional)</span><input class="{{ $field }}" type="url" name="image_url" value="{{ old('image_url', $project?->image_url) }}"></label>
<label class="flex items-center gap-2 text-sm font-medium"><input type="hidden" name="is_demo" value="0"><input class="h-4 w-4 accent-primary" type="checkbox" name="is_demo" value="1" @checked(old('is_demo', $project?->is_demo ?? true))>Exibir selo “Projeto demonstrativo”</label>
