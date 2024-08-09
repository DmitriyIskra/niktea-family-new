<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OutSiteNav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $nav_points = [
            ['title' => 'Главная', 'link' => 'https://nikteaworld.com/'],
            ['title' => 'О бренде', 'link' => 'https://nikteaworld.com/about-brand.html'],
            ['title' => 'Больше о чае', 'link' => 'https://nikteaworld.com/about-tea.html'],
            ['title' => 'Каталог', 'link' => 'https://nikteaworld.com/catalog.html'],
            ['title' => 'Контакты', 'link' => 'https://nikteaworld.com/contacts.html'],
        ]
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string|array
    {
        return view('components.out-site-nav');
    }
}
