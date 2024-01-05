<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = DB::table('employees')
            ->when(
                $request->input('search'),
                fn ($query, $search) =>
                $query->where('name', 'like', '%' . $search . '%')
            )->latest()->paginate(10);
        
        // 3 karyawan yang pertama kali bergabung
        $oldEmployees = DB::table('employees')
            ->oldest()->limit(3)->get();

        // Daftar karyawan yang saat ini pernah mengambil cuti
        $employeeEverLeave = Employee::when(
            $request->input('search'),
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        )->whereHas('leaves', function ($query) {
            $query->whereYear('date', date('Y'));
        })->paginate(10);

        // sisa cuti setiap karyawan
        $employeeLeave = Employee::when(
            $request->input('search'),
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        )->withSum([
            'leaves' => function ($query) {
                $query->whereYear('date', date('Y'));
            }
        ], 'duration')->paginate(10);
        return view('employees.index', compact('employees', 'oldEmployees', 'employeeEverLeave', 'employeeLeave'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['id_number'] = $this->generateIdNumber();
            $data['join_date'] = Carbon::now()->toDateString();

            DB::beginTransaction();
            Employee::create($data);
            DB::commit();
            return redirect('/employees')->with('success', 'Berhasil Menambah Data Pegawai!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/employees/create')->with('failed', 'Gagal Menambah Data Pegawai!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.edit', compact('employee', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        try {
            $employee = Employee::find($id);

            DB::beginTransaction();
            $employee->update($request->validated());
            DB::commit();
            return redirect('employees')->with('success', 'Berhasil Mengubah Data Pegawai!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('employees')->with('failed', 'Gagal Mengubah Data Pegawai!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            Employee::destroy($id);
            DB::commit();
            return back()->with('success', 'Berhasil Menghapus Pegawai!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('failed', 'Gagal Menghapus Pegawai!');
        }
    }

    private function generateIdNumber()
    {
        do {
            $code = random_int(100000, 999999);
            $id = "IP06$code";
        } while (Employee::where("id_number", "=", $id)->first());

        return $id;
    }
}
