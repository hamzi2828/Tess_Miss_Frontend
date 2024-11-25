<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('department')->get();

        return view('pages.users.users-list', compact('users'));
    }

    public function profile()
    {
        $user = Auth::user();
        $departments = Department::all();

        $permissions = UserPermission::firstOrNew(['user_id' => $user->id]);


        return view('pages.profile.profile', compact('user',  'departments'));
    }


    public function create(){

        $departments = Department::all();

        return view('pages.users.create-user', compact('departments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'userFullname' => 'required|string|max:255',
            'userPassword' => 'required|string|min:5',
            'userEmail' => 'required|email|unique:users,email',
            'userPhone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'user_role' => 'nullable|string',
            'userStatus' => 'required|in:active,inactive',
            'userAddress' => 'nullable|string|max:500',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'userGender' => 'nullable|in:male,female',
        ]);

        // Use the UserService to create the user and get the created user object
        $user = $this->userService->createUser($validatedData);

        // Redirect with success message to edit the newly created user
        return redirect()->route('users.edit', ['user_id' => $user->id])->with('success', 'User created successfully.');
    }
    public function edit(Request $request)
    {
        // Get the user ID from the request
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $departments = Department::all();

        // Get the user's permissions
        $permissions = UserPermission::firstOrNew(['user_id' => $user->id]);


        $permissionsArray = is_string($permissions->permissions) ? json_decode($permissions->permissions, true) : $permissions->permissions ?? [];

        return view('pages.users.edit-user', compact('user', 'permissionsArray', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'userFullname' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255',
            'userPhone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'user_role' => 'nullable|string|max:50',
            'userStatus' => 'required|string|in:active,inactive',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permissions' => 'nullable|array',
            'userAddress' => 'nullable|string|max:500',
            'userGender' => 'nullable|in:male,female',
            'deleteUserPicture'=>'nullable',
            'new_password' => 'nullable|string|min:5',

        ]);


        // Use the UserService to update the user
        $this->userService->updateUser($user, $validatedData);


        if ($request->has('permissions')) {
            $this->userService->updateUserPermissions($user, $request->input('permissions', []));
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Use the UserService to delete the user
        $this->userService->deleteUser($user);

        // Redirect with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }



        public function activityLogs()
        {
            $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(10);
            return view('pages.activity_logs.activity_logs', compact('logs'));
        }

        public function activityMyLogs()
        {
            $logs = ActivityLog::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            return view('pages.activity_logs.activity_logs', compact('logs'));
        }


        public function markAsRead($id, Request $request)
        {
         
            $notification = Auth::user()->notifications->where('id', $id)->first();

            if ($notification) {
                $notification->markAsRead();
                $activityType = $notification->data['activity_type'] ?? null;
                $merchant_id =  $request->get('merchant_id');
                

                if (\App\Models\Merchant::where('id', $merchant_id)->exists() && $activityType == 'store') {

                    return redirect()->route('merchants.preview', ['merchant_id' => $merchant_id]);
                }
                // if (\App\Models\Merchant::where('id', $merchant_id)->exists() && $activityType == 'approve') {

                //     return redirect()->route('edit.merchants.services', ['merchant_id' => $merchant_id]);
                // }
                if (\App\Models\Merchant::where('id', $merchant_id)->exists() && $activityType == 'approve' || $activityType == 'decline') {
                    $userStage = auth()->user()->getDepartmentStage(auth()->user()->department);
                    
                    // Determine the route name dynamically based on stage
                    $routeName = $userStage == 1 
                        ? 'edit.merchants.kyc' 
                        : ($userStage == 2 
                            ? 'edit.merchants.documents' 
                            : ($userStage == 3 
                                ? 'edit.merchants.sales' 
                                : 'edit.merchants.services'));
        
                    // Redirect to the appropriate route
                    return redirect()->route($routeName, ['merchant_id' => $merchant_id]);
                }

            }

            return redirect()->back();
        }






    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }


    public function getLatestNotifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications()
            ->where('type', '=', 'App\Notifications\MerchantActivityNotification')
            ->take(10)
            ->get();

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }


}
