<?php

namespace App\Translation;

use App\Models\Translation;

trait Translatable
{
    /**
     * Get all of the models's translations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function translations(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get the translation attribute.
     *
     * @return \App\Models\Translation
     */
    public function getTranslationAttribute(): ?Translation
    {
        return $this->translations->firstWhere('locale', app()->getLocale());
    }

    public function trans(string $field_name)
    {
        return $this->translation->content[$field_name] ?? $this->{$field_name};
    }
}
