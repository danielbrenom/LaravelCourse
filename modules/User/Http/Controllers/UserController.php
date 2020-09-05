<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\ApiBaseController;
use App\Mail\UserVerification;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("transform.input:" . UserTransformer::class)->only(['store', 'update']);
    }

    public function index(): JsonResponse
    {
        $user = User::all();
        return $this->showAll($user);
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
        return $this->showOne($user, Response::HTTP_CREATED);
    }

    public function show(User $user): JsonResponse
    {
        return $this->showOne($user);
    }

    public function update(Request $request, User $user): JsonResponse
    {
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
            return $this->errorResponse(trans('user::messages.only_verified'), Response::HTTP_CONFLICT);
        }
        $user->fill($data);
        if (!$user->isDirty()) {
            return $this->errorResponse(trans('messages.model.no_update'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->update();
        return $this->showOne($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return $this->showOne($user);
    }

    public function verify($token)
    {
        $user = User::query()->where('verification_token', $token)->firstOrFail();
        $user->verified = true;
        $user->verification_token = null;
        $user->save();
        return $this->showMessage('User verification complete');
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('User already verified', Response::HTTP_CONFLICT);
        }
        Mail::to($user)->send(new UserVerification($user));
        return $this->showMessage('Verification email sent');
    }
}
