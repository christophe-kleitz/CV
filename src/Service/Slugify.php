<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input): string
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $input);
        $slug = preg_replace('~[^-\w]+~', '', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        $slug = mb_strtolower($slug);

        return $slug;
    }
}
