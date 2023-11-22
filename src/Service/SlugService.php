<?php

namespace App\Service;

use Symfony\Component\String\Slugger\AsciiSlugger;

class SlugService
{
    public function generateSlug($text)
    {
        $slugger = new AsciiSlugger();
        return $slugger-> slug($text);
    }
}
