<?php

namespace App\Http\Controllers;

use App\Support\Menu;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    /** Generic scaffold page for any menu leaf without a dedicated view. */
    public function generic(string $path)
    {
        $trail = Menu::trail($path);
        $title = $trail ? end($trail) : Str::of($path)->replace('-', ' ')->title();

        $crumbs = ! empty($trail)
            ? array_map(fn ($label) => ['label' => $label], $trail)
            : [['label' => $title]];

        return view('pages.generic', [
            'pageTitle' => $title,
            'crumbs'    => $crumbs,
            'section'   => $trail[0] ?? 'Pages',
        ]);
    }

    public function uiElements()
    {
        return view('pages.ui-elements');
    }

    public function icons()
    {
        return view('pages.icons');
    }

    public function widgets()
    {
        return view('pages.widgets');
    }

    public function tables()
    {
        return view('pages.tables');
    }

    public function charts()
    {
        return view('pages.charts');
    }

    public function forms()
    {
        return view('pages.forms');
    }

    public function settings()
    {
        return view('pages.settings');
    }
}
