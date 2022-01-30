<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Resources\SchoolsResource;
class SchoolController extends Controller
{
    function index(Request $request){
        $schools= School::latest()->get();
         $data= SchoolsResource::collection($schools);
        return response()->success($data,'success');
    }
}
