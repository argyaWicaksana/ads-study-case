<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeLeaveCollection;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeApiController extends Controller
{
    public function index(Request $request)
    {
        $employees = DB::table('employees')
            ->when(
                $request->input('search'),
                fn ($query, $search) =>
                $query->where('name', 'like', '%' . $search . '%')
            )->latest()->paginate(10);

        return new EmployeeCollection($employees);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['id_number'] = $this->generateIdNumber();
            $data['join_date'] = Carbon::now()->toDateString();

            DB::beginTransaction();
            $data = Employee::create($data);
            DB::commit();
            return response()->json([
                'message' => 'Berhasil Menambah Data Pegawai!',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal Menambah Data Pegawai!',
            ]);
        }
    }

    public function update(EmployeeRequest $request, string $id)
    {
        try {
            $employee = Employee::find($id);

            DB::beginTransaction();
            $employee->update($request->validated());
            DB::commit();

            return response()->json([
                'message' => 'Berhasil Mengubah Data Pegawai!',
                'data' => $employee,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal Mengubah Data Pegawai!',
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            Employee::destroy($id);
            DB::commit();

            return response()->json([
                'message' => 'Berhasil Menghapus Data Pegawai!',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal Menghapus Data Pegawai!',
            ]);
        }
    }

    public function oldEmployee()
    {
        $employees = DB::table('employees')
            ->oldest()->limit(3)->get();

        return new EmployeeCollection($employees);
    }

    public function employeeEverLeave(Request $request)
    {
        $employees = Employee::when(
            $request->input('search'),
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        )->whereHas('leaves', function ($query) {
            $query->whereYear('date', date('Y'));
        })->paginate(10);

        return new EmployeeCollection($employees);
    }

    public function leaveEmployee(Request $request)
    {
        $employees = Employee::when(
            $request->input('search'),
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        )->withSum([
            'leaves' => function ($query) {
                $query->whereYear('date', date('Y'));
            }
        ], 'duration')->paginate(10);

        return new EmployeeLeaveCollection($employees);
    }
}
