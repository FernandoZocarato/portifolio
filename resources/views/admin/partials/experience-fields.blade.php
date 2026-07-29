@php($experience = $experience ?? null)
<label class="admin-label">Cargo<input class="{{ $field }}" name="role" value="{{ old('role', $experience?->role) }}" required></label>
<label class="admin-label">Empresa<input class="{{ $field }}" name="company" value="{{ old('company', $experience?->company) }}" required></label>
<label class="admin-label">Início<input class="{{ $field }}" type="date" name="start_date" value="{{ old('start_date', $experience?->start_date?->format('Y-m-d')) }}" required></label>
<label class="admin-label">Fim <span class="font-normal text-muted-foreground">(vazio = atual)</span><input class="{{ $field }}" type="date" name="end_date" value="{{ old('end_date', $experience?->end_date?->format('Y-m-d')) }}"></label>
<label class="admin-label sm:col-span-2">Descrição<textarea class="{{ $field }} min-h-28" name="description">{{ old('description', $experience?->description) }}</textarea></label>
<label class="admin-label">Ordem<input class="{{ $field }}" type="number" min="0" name="sort_order" value="{{ old('sort_order', $experience?->sort_order ?? 0) }}" required></label>
