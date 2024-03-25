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
                                'text' => 'Student Manger',
                                'icon' => 'mdi-account-school',
                                'is_active' => request()->is('student*'),
                                'has_children' => true,
                                'children' => [
                                    [
                                        'url' => 'student.index',
                                        'text' => 'All Student',
                                        'is_active' => request()->is('student*'),
                                    ],
                                ]
                            ],
                            [
                                'text' => 'Class/Section/Stream',
                                'icon' => 'mdi-google-classroom',
                                'is_active' => (request()->is('class*') ? request()->is('class*') : request()->is('section*')) ? request()->is('section*') : request()->is('stream*'),
                                'has_children' => true,
                                'children' => [
                                    [
                                        'url' => 'class.index',
                                        'text' => 'All Class',
                                        'is_active' => request()->is('class*'),
                                    ],
                                    [
                                        'url' => 'section.index',
                                        'text' => 'All Section',
                                        'is_active' => request()->is('section*'),
                                    ],
                                    [
                                        'url' => 'stream.index',
                                        'text' => 'All Stream',
                                        'is_active' => request()->is('stream*'),
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


