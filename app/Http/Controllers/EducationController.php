<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request and save the education
        $validator = Validator::make($request->all(), [
            'graduation_year' => 'required|integer|between:' . (date('Y')-50) . ',' . date('Y')  . '|graduation_year_not_greater',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $education = new Education([
            'user_id' => Auth::user()->id,
            'school' => $request->school,
            'degree' => $request->degree,
            'graduation_year' => $request->graduation_year,
            
            'faculty' => $request->faculty,
        ]);
        $education->save();

        $educations = Auth::user()->educations;
        $educationSection = view('resumes.partials.education_section', compact('educations'))->render();

        return response()->json(['educationSection' => $educationSection]);
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'graduation_year' => 'required|integer|between:' . (date('Y')-50) . ',' . date('Y') . '|graduation_year_not_greater',
        ]);

        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $education = Education::find($id);

        if (!$education) {
            return response()->json(['error' => 'Education record not found'], 404);
        }

        $education->update($request->all());
        
        $educations = Auth::user()->educations;
        $educationSection = view('resumes.partials.education_section', compact('educations'))->render();

        return response()->json(['message' => 'Education record updated successfully','educationSection' => $educationSection]);
    }

    public function getDataForEdit($id)
    {
        $education = Education::find($id);
        
        if (!$education) {
            return response()->json(['error' => 'Education record not found'], 404);
        }

        return response()->json(['education' => $education]);
    }

    public function destroy($id)
    {
        $entry = Education::findOrFail($id);
        
        if ($entry) {
            $entry->delete();

            $educationSection = view('resumes.partials.education_section', ['educations' => auth()->user()->educations])->render();

            return response()->json([
                'message' => 'Entry deleted successfully',
                'educationSection' => $educationSection,
            ]);

            return response()->json(['message' => 'Entry not found'], 404);
        }
    }
}
