<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberDetailController extends Controller
{
    public function show($id)
    {
        $member = \App\Models\Member::with(['band'])->findOrFail($id);
        return view('page.member_detail', compact('member'));
    }
}
