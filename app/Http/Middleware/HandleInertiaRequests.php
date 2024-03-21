<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'Auth' => Auth::check() ? [
                'name' => Auth::user()->name,
                'school_name' => Auth::user()->school_name,
                'time' => \Carbon\Carbon::now()->format('h:i A'),
                'logged' => Auth::check(),
            ] : '',
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'NavUrl' => function () use ($request) {
                if (Auth::check()) {
                    if (Auth::user()->role == 'Admin') {
                        return [
                            [
                                'url' => 'home',
                                'text' => 'Dashboard',
                                'icon' => 'mdi-view-dashboard',
                                'is_active' => request()->is('dashboard'),
                                'has_children' => false,
                            ],
                            [
                                'text' => 'Class/Section',
                                'icon' => 'mdi-google-classroom',
                                'is_active' => request()->is('class*') ? request()->is('class*') : request()->is('section*'),
                                'has_children' => true,
                                'children' => [
                                    [
                                        'url' => 'class.index',
                                        'text' => 'All Class',
                                        'is_active' => request()->routeIs('class.index'),
                                    ],
                                    [
                                        'url' => 'class.create',
                                        'text' => 'Create Class',
                                        'is_active' => request()->routeIs('class.create'),
                                    ],
                                    [
                                        'url' => 'section.index',
                                        'text' => 'All Section',
                                        'is_active' => request()->routeIs('section.index'),
                                    ],
                                    [
                                        'url' => 'section.create',
                                        'text' => 'Create Section',
                                        'is_active' => request()->routeIs('section.create'),
                                    ],
                                ]
                            ],
                        ];
                    }
                }
            }
        ]);
    }
}


