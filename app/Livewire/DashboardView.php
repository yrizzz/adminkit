<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardView extends Component
{
    public string $name;

    public const DASHBOARDS = [
        'sales'     => ['Sales Dashboard', 'Pipeline, revenue & rep performance'],
        'crypto'    => ['Crypto Dashboard', 'Portfolio, markets & watchlist'],
        'jobs'      => ['Jobs Dashboard', 'Openings, applicants & hiring pipeline'],
        'crm'       => ['CRM Dashboard', 'Leads, deals & customer activity'],
        'ecommerce' => ['Ecommerce Dashboard', 'Orders, products & store revenue'],
        'analytics' => ['Analytics Dashboard', 'Traffic, engagement & audience'],
        'projects'  => ['Projects Dashboard', 'Tasks, progress & team workload'],
        'nft'       => ['NFT Dashboard', 'Collections, volume & live auctions'],
        'hrm'       => ['HRM Dashboard', 'Employees, attendance & payroll'],
        'personal'  => ['Personal Dashboard', 'Your day, habits, money & goals'],
        'stocks'    => ['Stocks Dashboard', 'Portfolio, holdings & market movers'],
        'course'    => ['Course Dashboard', 'Courses, students & enrollments'],
    ];

    public function mount(string $name): void
    {
        abort_unless(isset(self::DASHBOARDS[$name]), 404);
        $this->name = $name;
    }

    public function render()
    {
        [$title, $subtitle] = self::DASHBOARDS[$this->name];

        return view("livewire.dashboards.{$this->name}", ['pageTitle' => $title, 'subtitle' => $subtitle])
            ->layout('components.layouts.app', [
                'title'       => $title,
                'breadcrumbs' => [['label' => 'Dashboards'], ['label' => ucfirst($this->name)]],
            ]);
    }
}
