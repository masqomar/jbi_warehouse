<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $activities = ActivityLog::with('user');

            return DataTables::of($activities)
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('waktu', function ($row) {
                    return Carbon::parse($row->created_at)->diffForHumans();
                })
                ->addColumn('properties', function ($row) {
                    if ($row->properties == 1) {
                        return '0';
                    }
                    return $row->properties;
                })->toJson();
        }
        return view('log-activities.index');
    }
}
