<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Inertia\Inertia;
use App\Models\Karyawan;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $countEmployee = Karyawan::count()->get();
        // $countDepartment = Karyawan::select('department')->groupBy('department')->get();
        $upcomingBirthdays = Karyawan::whereMonth('tgllahir', now()->month)
            ->orderBy('tgllahir')
            ->get()
            ->map(function ($employee) {
                $ultah = Carbon::parse($employee->tgllahir);
                $brpHari = $ultah->diffInDays(now(), false);
                $umur = $ultah->diffInYears(now());

                return [
                    // 'id' => $employee->id,
                    'namakaryawan' => $employee->name,
                    'tgllahir' => $employee->tgllahir,
                    'brpHari' => $brpHari,
                    'umur' => $umur,
                    'formattedDate' => $ultah->format('M d'),
                ];
            });
        return Inertia::render('Dashboard', [
            'countEmployee' => $countEmployee,
            // 'countDepartment' => $countDepartment,
            'upcomingBirthdays' => $upcomingBirthdays,
        ]);
    }
}
