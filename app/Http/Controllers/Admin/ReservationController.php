<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $reservations = Reservation::all();

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $tables = Table::where('status', TableStatus::Available)->get();

        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return RedirectResponse
     */
    public function store(ReservationRequest $request): RedirectResponse
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guest');
        }

        $request_date = Carbon::parse($request->get('res_date'));

        foreach ($table->reservations as $reservation) {
            if (optional($reservation->res_date)->format('Y-m-d') === optional($request_date)->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }

        //Reservation::create($request->validate());
        $reservation = Reservation::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'tel_number' => $request->get('tel_number'),
            'res_date' => $request->get('res_date'),
            'guest_number' => $request->get('guest_number'),
            'table_id' => $request->get('table_id'),
        ]);

        return to_route('admin.reservations.index')->with('success', 'Reservation Created Successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reservation $reservation
     * @return Application|Factory|View
     */
    public function edit(Reservation $reservation): View|Factory|Application
    {
        $tables = Table::all();
        return view('admin.reservations.edit', compact('reservation', 'tables'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationRequest $request
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function update(ReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guest');
        }

        $request_date = Carbon::parse($request->res_date);
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        foreach ($reservations as $res) {
            if (optional($res->res_date)->format('Y-m-d') === optional($request_date)->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }

        $reservation->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'tel_number' => $request->get('tel_number'),
            'res_date' => $request->get('res_date'),
            'guest_number' => $request->get('guest_number'),
            'table_id' => $request->get('table_id'),
        ]);

        return to_route('admin.reservations.index')->with('success', 'Reservation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return RedirectResponse
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();
        return to_route('admin.reservations.index')->with('danger', 'Reservation Deleted Successfully');
    }
}
