<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;
class StudentController extends Controller
{

    public function index()
    {
        return view('dashboard.students.index');
    }

    public function create()
    {
        return view('dashboard.students.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|',
            'phone' =>'required'
        ]);
        Student::create($validatedData);
        return redirect()->route('dashboard.students.index')->with('success', 'User created successfully.');
    }
    public function edit(Student $student)
    {
        return view('dashboard.students.edit',compact('student'));
    }

    public function update(Request $request,Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'phone' =>'required'
        ]);
        $student->update( $validatedData);
        return redirect()->route('dashboard.students.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {

        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {

        $student = Student::findOrFail($request->student_id);
        $student->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function getStudents(Request $request)
    {
        // if ($request->ajax()) {
            $data = Student::latest()->get();
          return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.Route('dashboard.students.edit',$row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                    <form class="delete d-inline-block" action="'.route('dashboard.students.delete').'" method="post">
                    '.csrf_field().'
                    <input type="hidden" name="student_id" value="'.$row->id.'">
                    <button type="submit" class="btn btn-danger btn-sm deletebtn">
                        <span class="btn-label">
                            <i class="fas fa-trash"></i>
                        </span>
                        delete
                    </button>
                </form>';
                    return $actionBtn;
                })

                ->rawColumns(['action'])

                ->make(true);

    }

}
