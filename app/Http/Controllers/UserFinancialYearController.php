<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class UserFinancialYearController extends Controller
{
    public function userFinancialYear($date)
    {
        $date = Carbon::parse($date);
        $startYear = $date->month < 7 ? $date->subYear()->year : $date->year;
        $endYear = $startYear + 1;
        $start_financial_year = '01-07-'.$startYear;
        $end_financial_year = '30-06-'.$endYear;

        $start_financial_year =  Carbon::createFromDate($start_financial_year)->startOfDay();
        $end_financial_year = Carbon::createFromDate($end_financial_year)->endOfDay();

        $users = User::whereBetween('created_at', [$start_financial_year, $end_financial_year])->get();

        return response()->json([
            'data' => $users
        ]);
    }
}
