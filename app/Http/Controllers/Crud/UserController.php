<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Services\Contracts\CrudInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $locale): View
    {
        if ((int)request()->query('set') === 1) {
            session()->put('locale', $locale);
        }

        if ((int)request()->query('d') === 1) {
            session()->remove('locale');
        }

        app()->setLocale($locale);
        $users = User::query()->get();

        return view('users.index', [
            'users' => $users,
            'locale' => $locale,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CrudInterface $crud): RedirectResponse
    {
        $crud->create($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user, CrudInterface $crud): RedirectResponse
    {
        $crud->update($user, $request->validated());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, CrudInterface $crud): RedirectResponse
    {
       $crud->delete($user);
        return redirect()->route('users.index');
    }
}
