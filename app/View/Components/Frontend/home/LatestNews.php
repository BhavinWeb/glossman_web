<?php

namespace App\View\Components\frontend\home;

use Illuminate\View\Component;

class LatestNews extends Component
{
    public $latestNews;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($latestNews)
    {
        $this->latestNews = $latestNews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.home.latest-news');
    }
}
