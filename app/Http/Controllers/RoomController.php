<?php

namespace App\Http\Controllers;


use App\Models\Room;
use App\Http\Requests\{StoreRoomRequest, UpdateRoomRequest};
use App\Models\Building;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view room')->only('index', 'show');
        $this->middleware('permission:create room')->only('create', 'store');
        $this->middleware('permission:edit room')->only('edit', 'update');
        $this->middleware('permission:delete room')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $rooms = Room::with('building:id,name', 'company:id,code,name')
                ->where('company_id', auth()->user()->company_id);

            return DataTables::of($rooms)
                ->addColumn('building', function ($row) {
                    return $row->building ? $row->building->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->name : '-';
                })->addColumn('action', 'rooms.include.action')
                ->toJson();
        }


        return view('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gedung = Building::where('company_id', auth()->user()->company_id)->get();

        return view('rooms.create', compact('gedung'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated() + (['company_id' => auth()->user()->company_id]));

        return redirect()
            ->route('rooms.index')
            ->with('success', __('Room created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room->load(
            'building:id,name',

            'company:id,code'
        );

        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $room->load(
            'building:id,name',

            'company:id,code'
        );

        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('success', __('Room updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();

            return redirect()
                ->route('rooms.index')
                ->with('success', __('Room deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('rooms.index')
                ->with('error', __('The Room can`t be deleted because it is related to another table.'));
        }
    }
}
