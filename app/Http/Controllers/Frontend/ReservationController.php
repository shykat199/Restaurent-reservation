<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne(Request $request): Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step_one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'tel_number' => ['required'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'guest_number' => ['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }
        return to_route('reservations.step.tow');
    }

    public function stepTow(Request $request): Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        $reservation = $request->session()->get('reservation');

        $res_table_id = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation) {
            return optional($value->res_date)->format('Y-m-d') === optional($reservation->res_date)->format('Y-m-d');
        })->pluck('table_id');

        $tables = Table::where('status', TableStatus::Available)
            ->where('guest_number','>=',$reservation->guest_number)
            ->whereNotIn('id',$res_table_id)->get();

        return view('reservations.step_tow', compact('reservation', 'tables'));

    }

    public function storeStepTow(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated=$request->validate([
            'table_id'=>['required']
        ]);

        $reservation=$request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $request->session()->forget('reservation');

        return to_route('thankyou');


    }
}
