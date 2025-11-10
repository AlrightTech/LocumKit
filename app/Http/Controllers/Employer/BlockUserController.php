<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\BlockUser;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'can:is_employer', 'is_employer_active']);
    }

    public function index(Request $request)
    {
        $query = BlockUser::where("employer_id", Auth::user()->id)
            ->with(['freelancer.user_acl_profession']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('freelancer', function($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }
        
        // Filter by profession
        if ($request->has('profession') && $request->profession) {
            $query->whereHas('freelancer', function($q) use ($request) {
                $q->where('user_acl_profession_id', $request->profession);
            });
        }
        
        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $block_locums = $query->get();
        
        // Get all professions for filter dropdown
        $professions = \App\Models\UserAclProfession::where('is_active', 1)->orderBy('name')->get();
        
        return view("employer.block-freelancer-index", compact("block_locums", "professions"));
    }

    public function blockUser(Request $request)
    {
        try {
            $employer_id = decrypt($request->query("employer_id"));
            $freelancer_id = decrypt($request->query("freelancer_id"));
        } catch (DecryptException $e) {
            return abort(404);
        }
        if ($employer_id != Auth::user()->id) {
            return abort(404);
        }
        $freelancer = User::findOrFail($freelancer_id);

        return view('employer.block-user', compact('freelancer'));
    }

    public function blockUserPost($id)
    {
        $freelancer = User::findOrFail($id);
        
        // Ensure the user is a freelancer
        if ($freelancer->user_acl_role_id != User::USER_ROLE_LOCUM) {
            return redirect()->back()->with("error", "Only locums can be blocked.");
        }

        $count = BlockUser::where("freelancer_id", $freelancer->id)
            ->where("employer_id", Auth::user()->id)
            ->count();
            
        if ($count > 0) {
            return redirect(route('employer.manage-block-freelancer'))
                ->with("error", "This locum is already in your blocked list.");
        }
        
        BlockUser::create([
            "freelancer_id" => $freelancer->id,
            "employer_id" => Auth::user()->id
        ]);

        return redirect(route('employer.manage-block-freelancer'))
            ->with("success", "Locum blocked successfully. They will not receive invitations to your future jobs.");
    }
    
    public function unblock($id)
    {
        $blockUser = BlockUser::where("id", $id)
            ->where("employer_id", Auth::user()->id)
            ->firstOrFail();
        
        $blockUser->delete();
        
        return redirect(route('employer.manage-block-freelancer'))
            ->with("success", "Locum unblocked successfully. They can now receive invitations to your jobs.");
    }
    
    public function searchLocums(Request $request)
    {
        $search = $request->input('search', '');
        
        if (strlen($search) < 2) {
            return response()->json(['locums' => []]);
        }
        
        // Get already blocked locum IDs
        $blockedIds = BlockUser::where("employer_id", Auth::user()->id)
            ->pluck('freelancer_id')
            ->toArray();
        
        // Search for locums (exclude already blocked ones)
        $query = User::where("user_acl_role_id", User::USER_ROLE_LOCUM)
            ->whereNotIn('id', $blockedIds)
            ->with('user_acl_profession');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }
        
        $locums = $query->limit(20)->get();
        
        $results = $locums->map(function($locum) {
            return [
                'id' => $locum->id,
                'name' => $locum->firstname . ' ' . $locum->lastname,
                'email' => $locum->email,
                'profession' => $locum->user_acl_profession ? $locum->user_acl_profession->name : 'N/A',
            ];
        });
        
        return response()->json(['locums' => $results]);
    }
}