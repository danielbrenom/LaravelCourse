<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserController extends Controller

{

    public function index(): JsonResponse
    {
        $user = User::all();
        return response()->json(['data' => $user], Response::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = false;
        $data['verification_token'] = User::generateVerificationToken();
        $data['admin'] = false;
        $user = User::create($data);
        return response()->json(['data' => $user], Response::HTTP_CREATED);
    }

    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json(['data' => $user], Response::HTTP_OK);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => Rule::in(true, false),
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        if ($request->has('password')) {
            $data = bcrypt($request->password);
        }
        if ($request->has('email')) {
            $user->verified = false;
            $user->verification_token = User::generateVerificationToken();
        }
        if ($request->has('admin') && !$user->isVerified()) {
            return response()->json(['error' => 'Only verified user can modify admin field'], Response::HTTP_CONFLICT);
        }
        $user->fill($data);
        if (!$user->isDirty()) {
            return response()->json(['error' => 'No value to update'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return response()->json(['data' => $user], Response::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => $user], Response::HTTP_OK);
    }
}
