<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    //
    public function index(){

        $users = User::all();
        
      
        $pendings = Task::where('status','pending')->get();
        $ongoings = Task::where('status','ongoing')->get();
        $dones = Task::where('status','done')->get();
        return view('task', compact('users', 'pendings', 'ongoings', 'dones'));
    }

    public function store(Request $request)
    {
        // Validate inputs
   

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'file' => 'file|mimes:pdf,jpg,jpeg,png|max:10240', 
            'user_id' => 'nullable|integer|exists:users,id',
            'created_by' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

    
        // Handle file upload after validation
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '_file.' . $file->getClientOriginalExtension();

            // Store the file and get the path
            $path = $file->storeAs('files', $fileName, 'public');

            // Add the path to validated data
            $validatedData['file'] = $path;
        }

        // Check validation
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create task
        try {
            $validatedData = $validator->validated();

       

            Task::create($validatedData);

            return redirect()
                ->route('taks')
                ->with('success', 'New task added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'Failed to create task: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->status; // The status passed from the frontend
        $task->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
