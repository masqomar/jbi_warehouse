<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Models\Company;
use App\Models\Devision;
use App\Models\Placement;
use App\Models\PlacementItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class UserController extends Controller
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    protected $avatarPath = '/uploads/images/avatars/';

    public function __construct()
    {
        $this->middleware('permission:view user')->only('index', 'show');
        $this->middleware('permission:create user')->only('create', 'store');
        $this->middleware('permission:edit user')->only('edit', 'update');
        $this->middleware('permission:delete user')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles:id,name', 'devision', 'company');

            return Datatables::of($users)
                ->addColumn('devision', function ($row) {
                    return $row->devision ? $row->devision->name : '-';
                })->addColumn('company', function ($row) {
                    return $row->company ? $row->company->code : '-';
                })->addColumn('action', 'users.include.action')
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->toArray() !== [] ? $row->getRoleNames()[0] : '-';
                })
                ->addColumn('avatar', function ($row) {
                    if ($row->avatar == null) {
                        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($row->email))) . '&s=500';
                    }
                    return asset($this->avatarPath . $row->avatar);
                })
                ->toJson();
        }

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $companies = Company::get();
        $query = Devision::query();

        if ($request->ajax()) {
            $devisions = Devision::where("company_id", $request->company_id)
                ->get(["name", "id"]);

            return response(['devisions' => $devisions]);
        }
        $devisions = $query->get();

        return view('users.create', compact('companies', 'devisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $attr = User::create([
            'name' => $request->name,
            'devision_id' => $request->devision_id,
            'company_id' => $request->company_id,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($request->file('avatar') && $request->file('avatar')->isValid()) {

            $filename = $request->file('avatar')->hashName();

            if (!file_exists($folder = public_path($this->avatarPath))) {
                mkdir($folder, 0777, true);
            }

            Image::make($request->file('avatar')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->avatarPath . $filename);

            $attr['avatar'] = $filename;
        }

        // $user = User::create($attr);

        $attr->assignRole($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', __('User created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles:id,name', 'devision', 'company');
        $placementAssets = PlacementItem::with('asset_item', 'placement')->where('status', 'yes')->where('staff_id', $user->id)->get();

        // return json_decode($placementAssets);
        // dd($placementAssets);
        return view('users.show', compact('user', 'placementAssets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $user->load('roles:id,name');
        $companies = Company::get();
        $query = Devision::query();

        if ($request->ajax()) {
            $devisions = Devision::where("company_id", $request->company_id)
                ->get(["name", "id"]);

            return response(['devisions' => $devisions]);
        }
        $devisions = $query->get();

        return view('users.edit', compact('user', 'companies', 'devisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $attr = $request->validated();

        if ($request->file('avatar') && $request->file('avatar')->isValid()) {

            $filename = $request->file('avatar')->hashName();

            // if folder dont exist, then create folder
            if (!file_exists($folder = public_path($this->avatarPath))) {
                mkdir($folder, 0777, true);
            }

            // Intervention Image
            Image::make($request->file('avatar')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path($this->avatarPath) . $filename);

            // delete old avatar from storage
            if ($user->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath .
                $user->avatar))) {
                unlink($oldAvatar);
            }

            $attr['avatar'] = $filename;
        } else {
            $attr['avatar'] = $user->avatar;
        }

        if (is_null($request->password)) {
            unset($attr['password']);
        } else {
            $attr['password'] = bcrypt($request->password);
        }

        $user->update($attr);

        $user->syncRoles($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', __('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->avatar != null && file_exists($oldAvatar = public_path($this->avatarPath . $user->avatar))) {
            unlink($oldAvatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', __('User deleted successfully.'));
    }
}
