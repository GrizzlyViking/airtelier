<?php

namespace App\Traits;

/**
 * Trait SlugTrait
 *
 * @package App\Traits
 * @property string $slug
 */
trait SlugTrait
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function generateSlug(string $text): string
    {
        $slug = preg_replace('/[^\w\s]+/u', '', $text);
        $slug = str_replace(' ', '_', $slug);

        // is that slug already take (except own)
        if (self::where('slug', $slug)->where('id', '<>', $this->id)->exists()) {
            $slug .= '_' . str_replace(' ', '_', $this->address->town);

            if (self::where('slug', $slug)->where('id', '<>', $this->id)->exists()) {
                $slug .= '_'. uniqid();
            }
        }

        return $slug;
    }
}
