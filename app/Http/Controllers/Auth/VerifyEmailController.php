<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->is_admin) {
                return redirect()->route('admin.dashboard')->with('verified', 1);
            }
            return redirect()->route('user.books.index')->with('verified', 1);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($request->user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('verified', 1);
        }
        return redirect()->route('user.books.index')->with('verified', 1);
    }
}