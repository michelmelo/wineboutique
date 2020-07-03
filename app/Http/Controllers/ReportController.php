<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    private $reportingTo = [
        'au@executive-digital.com',
        'vm@executive-digital.com',
        'aj@executive-digital.com',
        'ts@executive-digital.com',
        'james@eepaz.com',
    ];

    public function store(ReportRequest $request)
    {
        $reportText = $request->text;
        $user = Auth::user();
        if (!empty($reportText)) {
            Mail::send('email.bug-report', ['user' => $user, 'text' => $reportText],
                function ($message) use ($user) {
                    $message
                        ->to($this->reportingTo)->subject('Bug report from: ' . $user->firstName . isset($user->lastName) ? ' ' . $user->lastName : '');
                });
            $report = Report::create([
                'user_id' => $user->id,
                'text' => $reportText,
            ]);
            return response()->json($report);
        }

        return response()->json(['error' => "Not sent."]);
    }
}
