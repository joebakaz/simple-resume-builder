<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'start_date' => 'required|date',
            'end_date' => 'date|nullable|end_date_after_or_equal:start_date',
        ], 
        $messages = [
            'end_date_after_or_equal' => 'The :attribute field should not earlier than start date.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $experience = new Experience([
            'user_id' => Auth::user()->id,
            'company' => $request->company,
            'job_title' => $request->job_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'job_description' => $request->job_description,
        ]);
        $experience->save();

        $experiences = Auth::user()->experiences;
        $experienceSection = view('resumes.partials.experience_section', compact('experiences'))->render();

        return response()->json(['experienceSection' => $experienceSection]);
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'date|nullable|end_date_after_or_equal:start_date',
        ], 
        $messages = [
            'end_date_after_or_equal' => 'The :attribute field should not earlier than start date.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $experience = Experience::find($id);

        if (!$experience) {
            return response()->json(['error' => 'Experience record not found'], 404);
        }

        $experience->update($request->all());
        
        $experiences = Auth::user()->experiences;
        $experienceSection = view('resumes.partials.experience_section', compact('experiences'))->render();

        return response()->json(['message' => 'Experience record updated successfully','experienceSection' => $experienceSection]);
    }
    
    public function getDataForEdit($id)
    {
        $experience = Experience::find($id);
        
        if (!$experience) {
            return response()->json(['error' => 'Experience record not found'], 404);
        }

        return response()->json(['experience' => $experience]);
    }

    public function destroy($id)
    {
        $entry = Experience::findOrFail($id);
        
        if ($entry) {
            $entry->delete();

            $experienceSection = view('resumes.partials.experience_section', ['experiences' => auth()->user()->experiences])->render();

            return response()->json([
                'message' => 'Entry deleted successfully',
                'experienceSection' => $experienceSection,
            ]);
            
            return response()->json(['message' => 'Entry not found'], 404);
        }
    }
}
