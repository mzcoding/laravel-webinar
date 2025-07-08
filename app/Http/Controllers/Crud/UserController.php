<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => $this->userRepository->list(),
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
    public function store(CreateRequest $request): RedirectResponse
    {
        $this->userRepository->create($request->validated());

        return redirect()->route('users.index')->with('success', __('Пользователь успешно создан'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View {}

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
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user = $this->userRepository->update($user, $request->validated());
        if ($user) {
            return redirect()->route('users.index')->with('success', __('Пользователь успешно обновлен'));
        }

        return back()->with('success', __('Не удалось сохранить пользователя'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userRepository->delete($user);

        return response()->json('ok');
    }
}
