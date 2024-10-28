<?php

namespace App\Http\Controllers;

use App\Models\MedicalQuiz;
use Illuminate\Http\Request;

class MedicalQuizController extends Controller
{
    public function index()
    {
        $quiz_list = MedicalQuiz::all();
        return view('setting.medical.medical_quiz_index', compact('quiz_list'));
    }

    public function create()
    {
        return view('setting.medical.medical_quiz_create');
    }


    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'quiz' => 'required',
            'status' => 'required|boolean',
        ]);

        $medicalQuiz = new MedicalQuiz();
        $medicalQuiz->quiz = $validatedData['quiz'];
        $medicalQuiz->status = $validatedData['status'];

        $medicalQuiz->save();

        notify()->success('Medical Question added successfully.. ⚡️', 'Success');
        return redirect()->back();
    }


    public function edit($id)
    {
        $quiz = MedicalQuiz::findOrFail($id);
        return view('setting.medical.medical_quiz_edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quiz' => 'required',
            'status' => 'required|boolean',
        ]);

        $quiz = MedicalQuiz::findOrFail($id);
        $quiz->quiz = $validatedData['quiz'];
        $quiz->status = $validatedData['status'];
        $quiz->save();

        notify()->success('Medical Question updated successfully.. ⚡️', 'Success');
        return redirect()->route('quiz.index');
    }




    public function destroy($id)
    {
        $quiz = MedicalQuiz::findOrFail($id);
        $quiz->delete();

        notify()->success('Medical Question deleted successfully.. ⚡️', 'Success');
        return redirect()->back();
    }

}
