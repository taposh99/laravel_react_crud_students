<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $student;
    public function __construct(){
        $this->student = new Students();
        
    }
    public function index()
    {
        $allData = Students::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'allData' => $allData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $request->validate([

            'name' => 'required',
            'address' => 'required',

            'phone' => 'required',


        ]);

        // Check if an image is provided for 'banner'
       

        Students::create([

            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => 'Data created successfully'], JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
   

    public function show(string $id)
{
    $student = Students::find($id);

    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Student not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    return response()->json(['success' => true, 'student' => $student]);
}

    /**
     * Update the specified resource in storage.
     */
   


    public function update(Request $request, string $id)
    {
         $student = $this->student->find($id);
         $student->update($request->all());
         return $student;
    }
    public function destroy(string $id)
    {
     $student = $this->student->find($id);
    return $student->delete();   
    }
}
