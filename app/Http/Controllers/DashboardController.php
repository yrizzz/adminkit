<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /** name => [title, subtitle] */
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

    public function show(string $name)
    {
        abort_unless(isset(self::DASHBOARDS[$name]), 404);

        [$title, $subtitle] = self::DASHBOARDS[$name];

        return view("dashboards.$name", [
            'pageTitle'   => $title,
            'subtitle'    => $subtitle,
            'breadcrumbs' => [['label' => 'Dashboards'], ['label' => ucfirst($name)]],
        ]);
    }
}
