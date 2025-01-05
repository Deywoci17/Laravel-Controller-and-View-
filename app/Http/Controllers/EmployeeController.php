<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Employee List';

        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name')
            ->get();

        return view('employee.index', compact('pageTitle', 'employees'));
    }

    public function create()
    {
        $pageTitle = 'Create Employee';
        $positions = DB::table('positions')->get();

        return view('employee.create', compact('pageTitle', 'positions'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar.',
            'numeric' => 'Isi :attribute dengan angka.',
        ];

        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'age' => 'required|numeric|min:1',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], $messages);

        $originalFilename = null;
        $encryptedFilename = null;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            $file->store('public/files');
        }

        $employee = new Employee();
        $employee->firstname = $validatedData['firstName'];
        $employee->lastname = $validatedData['lastName'];
        $employee->email = $validatedData['email'];
        $employee->age = $validatedData['age'];
        $employee->position_id = $request->position;

        if ($originalFilename && $encryptedFilename) {
            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        $employee = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name')
            ->where('employees.id', $id)
            ->first();

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        $employee = DB::table('employees')
            ->select('id', 'firstname', 'lastname', 'email', 'age', 'position_id')
            ->where('id', $id)
            ->first();

        $positions = DB::table('positions')->get();

        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar.',
            'numeric' => 'Isi :attribute dengan angka.',
        ];

        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|numeric|min:1',
        ], $messages);

        DB::table('employees')
            ->where('id', $id)
            ->update([
                'firstname' => $validatedData['firstName'],
                'lastname' => $validatedData['lastName'],
                'email' => $validatedData['email'],
                'age' => $validatedData['age'],
                'position_id' => $request->position,
            ]);

        return redirect()->route('employees.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        DB::table('employees')->where('id', $id)->delete();

        return redirect()->route('employees.index')->with('success', 'Data berhasil dihapus.');
    }

    public function downloadFile($employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee || !$employee->encrypted_filename) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $encryptedFilename = 'public/files/' . $employee->encrypted_filename;
        $downloadFilename = Str::lower($employee->firstname . '_' . $employee->lastname . '_cv.pdf');

        if (Storage::exists($encryptedFilename)) {
            return Storage::download($encryptedFilename, $downloadFilename);
        }

        return redirect()->back()->with('error', 'File tidak tersedia di server.');
    }
}
