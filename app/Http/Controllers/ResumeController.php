<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $resumes = $user->resumes()->paginate(10);
        return view('resumes.index', compact('resumes'));
    }

    public function create()
    {
        $user = Auth::user();
        $educations = $user->educations; 
        $experiences = $user->experiences; 
        return view('resumes.create', compact('educations','experiences'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'about_me' => 'nullable',
        ]);

        $data['user_id'] = Auth::id();
        $data['public_url'] = Str::uuid();
        $resume = Resume::create($data);

        return redirect()->route('resumes.index')->with('success', 'Resume created successfully');
    }

    public function edit(Resume $resume)
    {
        $user = Auth::user();
        $educations = $user->educations; 
        $experiences = $user->experiences; 
        return view('resumes.edit', compact('resume','educations','experiences'));
    }

    public function update(Request $request, Resume $resume)
    {
        $data = $request->validate([
            'title' => 'required',
            'about_me' => 'nullable',
        ]);

        $resume->update($data);

        return redirect()->route('resumes.index')->with('success', 'Resume updated successfully');
    }

    public function destroy(Resume $resume)
    {
        $resume->delete();
        return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully');
    }

    public function showPublic($public_url)
    {
        $resume = Resume::where('public_url', $public_url)->firstOrFail();
        $user = User::where('id',$resume->user_id)->firstOrFail();
        $educations = $user->educations; 
        $experiences = $user->experiences; 
        return view('resumes.public', compact('resume','educations','experiences'));
    }
}
