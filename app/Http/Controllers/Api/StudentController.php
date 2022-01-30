<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Events\StudentAdded;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StudentsResource;
class StudentController extends Controller {

    function studentJoin(Request $request) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'school_id' => 'required|exists:schools,id',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
 
        if ($validator->fails())
            return response()->error($validator->errors()->all());
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->school_id = $request->school_id;
        $student->password = Hash::make($request->password);
        $student->save();
        try {
                        event(new StudentAdded($student));

           
     } catch (\Exception $e) {
            
     }
        $studentData = new StudentsResource($student);
        return response()->success($studentData, 'success');
    }
    function all(Request $request){
          $rules = [
         
            'school_id' => 'required|exists:schools,id',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->error($validator->errors()->all());
        $students= Student::where('school_id',$request->school_id)->latest()->paginate(20);
        return response()->success(StudentsResource::collection($students),'success');
    }
}
