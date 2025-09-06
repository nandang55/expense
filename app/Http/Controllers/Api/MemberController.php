<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('q', '');
        $limit = $request->get('limit', 20);
        
        $members = Member::active()
            ->search($search)
            ->limit($limit)
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'text' => $member->name . ' - ' . $member->nik,
                    'nik' => $member->nik,
                    'phone' => $member->phone,
                    'name' => $member->name,
                ];
            });

        return response()->json([
            'results' => $members
        ]);
    }
}