<?php

namespace App\Http\Controllers\Site;

use App\SupportRequest;
use App\Http\Controllers\Controller;
use App\Mail\SupportRequestCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Cookie, Mail};

class LpController extends Controller
{
    public function showIndex()
    {
        return view('lp.index');
    }

    public function showPrivacy()
    {
        return view('lp.privacy');
    }

    /**
     * Создать обращение
     *
     * @param Request $request
     */
    public function createSupportRequest(Request $request): void
    {
        $request->validate([
            'name' => 'nullable|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $supportRequest = SupportRequest::create([
            'name' => htmlspecialchars($request->input('name')),
            'email' => htmlspecialchars($request->input('email')),
            'message' => htmlspecialchars($request->input('message')),
        ]);

        Mail::to('support@ritofos.com')
            ->send(new SupportRequestCreated($supportRequest));
    }
}
