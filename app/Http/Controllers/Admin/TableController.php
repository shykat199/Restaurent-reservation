<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TableRequest $request
     * @return RedirectResponse
     */
    public function store(TableRequest $request): RedirectResponse
    {
        Table::create([
            'name' => $request->get('name'),
            'guest_number' => $request->get('guest_number'),
            'status' => $request->get('status'),
            'location' => $request->get('location'),
        ]);

        return to_route('admin.tables.index')->with('success', 'Table Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Table $table
     * @return Application|Factory|View
     */
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TableRequest $request
     * @param Table $table
     * @return RedirectResponse
     */
    public function update(TableRequest $request, Table $table): RedirectResponse
    {
        $table->update([
            'name' => $request->get('name'),
            'guest_number' => $request->get('guest_number'),
            'status' => $request->get('status'),
            'location' => $request->get('location'),
        ]);

        return to_route('admin.tables.index')->with('success', 'Table Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Table $table
     * @return RedirectResponse
     */
    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();
        $table->reservations()->delete();
        return to_route('admin.tables.index')->with('danger', 'Table Deleted Successfully');
    }
}
