<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Pettycash;
use App\Models\Revenue;
use App\Models\ShortContracts;
use App\Models\storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->can('isAdmin') || auth()->user()->can('isFinance')) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
    }


    // Use Filter Month Automatic
    public function index()
    {

        // dd("asa");

        // Get Data in Some Month
        $now = Carbon::now();
        $currentMonth = $now->format('m');

        // Get Data In Table
        $revenuesData = Revenue::whereMonth('created_at', $currentMonth)->get();
        $shortContracts = ShortContracts::whereMonth('created_at', $currentMonth)->get();
        $expensesData = Expenses::whereMonth('created_at', $currentMonth)->get();
        $pettycashData = Pettycash::whereMonth('created_at', $currentMonth)->get();


        // Month Inventroy
        $revenuesStorage = Revenue::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $shortContractsStorage = ShortContracts::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $expensesStorage = Expenses::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $pettycashStorage = Pettycash::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        // Save All Data In row For Array  Month
        $combinedData = [];

        foreach ($revenuesStorage as $revenue) {
            $combinedData[$revenue->month]['revenue'] = $revenue->sum;
        }

        foreach ($shortContractsStorage as $shortContract) {
            $combinedData[$shortContract->month]['shortContract'] = $shortContract->sum;
        }

        foreach ($expensesStorage as $expense) {
            $combinedData[$expense->month]['expense'] = $expense->sum;
        }

        foreach ($pettycashStorage as $pettycash) {
            $combinedData[$pettycash->month]['pettycash'] = $pettycash->sum;
        }

        // Year Inventroy
        $revenuesStorageYear = Revenue::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $shortContractsStorageYear = ShortContracts::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $expensesStorageYear = Expenses::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $pettycashStorageYear = Pettycash::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();


        // Save All Data In row For Array  Year
        $combinedDataYear = [];

        foreach ($revenuesStorageYear as $revenueYear) {
            $combinedDataYear[$revenueYear->year]['revenueYear'] = $revenueYear->sumYear;
        }


        foreach ($shortContractsStorageYear as $shortContractYear) {
            $combinedDataYear[$shortContractYear->year]['shortContractYear'] = $shortContractYear->sumYear;
        }

        foreach ($expensesStorageYear as $expenseYear) {
            $combinedDataYear[$expenseYear->year]['expenseYear'] = $expenseYear->sumYear;
        }

        foreach ($pettycashStorageYear as $pettycashYear) {
            $combinedDataYear[$pettycashYear->year]['pettycashYear'] = $pettycashYear->sumYear;
        }
        // return $combinedData;

        // return $combinedDataYear;
        // Return View
        return view('admin.fiances.storage', compact('combinedData','combinedDataYear', 'revenuesData', 'shortContracts', 'expensesData', 'pettycashData', 'revenuesStorage', 'shortContractsStorage', 'expensesStorage', 'pettycashStorage'));
    }





    // Filter Day
    public function filterData(Request $request)
    {
        $selectedMonth = $request->input('monthDay');


        // Month Inventroy
        $revenuesStorage = Revenue::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $shortContractsStorage = ShortContracts::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $expensesStorage = Expenses::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $pettycashStorage = Pettycash::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        // Save All Data In row For Array  Month
        $combinedData = [];

        foreach ($revenuesStorage as $revenue) {
            $combinedData[$revenue->month]['revenue'] = $revenue->sum;
        }

        foreach ($shortContractsStorage as $shortContract) {
            $combinedData[$shortContract->month]['shortContract'] = $shortContract->sum;
        }

        foreach ($expensesStorage as $expense) {
            $combinedData[$expense->month]['expense'] = $expense->sum;
        }

        foreach ($pettycashStorage as $pettycash) {
            $combinedData[$pettycash->month]['pettycash'] = $pettycash->sum;
        }

        // Year Inventroy
        $revenuesStorageYear = Revenue::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $shortContractsStorageYear = ShortContracts::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $expensesStorageYear = Expenses::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $pettycashStorageYear = Pettycash::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();


        // Save All Data In row For Array  Year
        $combinedDataYear = [];

        foreach ($revenuesStorageYear as $revenueYear) {
            $combinedDataYear[$revenueYear->year]['revenueYear'] = $revenueYear->sumYear;
        }


        foreach ($shortContractsStorageYear as $shortContractYear) {
            $combinedDataYear[$shortContractYear->year]['shortContractYear'] = $shortContractYear->sumYear;
        }

        foreach ($expensesStorageYear as $expenseYear) {
            $combinedDataYear[$expenseYear->year]['expenseYear'] = $expenseYear->sumYear;
        }

        foreach ($pettycashStorageYear as $pettycashYear) {
            $combinedDataYear[$pettycashYear->year]['pettycashYear'] = $pettycashYear->sumYear;
        }


        if ($selectedMonth) {
            $revenuesData = Revenue::whereMonth('created_at', $selectedMonth)->get();
            $shortContracts = ShortContracts::whereMonth('created_at', $selectedMonth)->get();
            $expensesData = Expenses::whereMonth('created_at', $selectedMonth)->get();
            $pettycashData = Pettycash::whereMonth('created_at', $selectedMonth)->get();
        } else {
            // إذا لم يتم تحديد شهر، استخدم الشهر الحالي كما كنت تفعل سابقا
            $now = Carbon::now();
            $currentMonth = $now->format('m');

            $revenuesData = Revenue::whereMonth('created_at', $currentMonth)->get();
            $shortContracts = ShortContracts::whereMonth('created_at', $currentMonth)->get();
            $expensesData = Expenses::whereMonth('created_at', $currentMonth)->get();
            $pettycashData = Pettycash::whereMonth('created_at', $currentMonth)->get();
        }

        return view('admin.fiances.storage', compact('revenuesData','combinedData','combinedDataYear', 'shortContracts', 'expensesData', 'pettycashData'));
    }

    // Filter Month
    public function filterDataMonth(Request $request)
    {
        $selectedMonth = $request->input('monthStorage'); // تحصل على الشهر المحدد من الطلب

        // All Data
        // Get Data in Some Month
        $now = Carbon::now();
        $currentMonth = $now->format('m');

        // Get Data In Table
        $revenuesData = Revenue::whereMonth('created_at', $currentMonth)->get();
        $shortContracts = ShortContracts::whereMonth('created_at', $currentMonth)->get();
        $expensesData = Expenses::whereMonth('created_at', $currentMonth)->get();
        $pettycashData = Pettycash::whereMonth('created_at', $currentMonth)->get();



        // Year Inventroy
        $revenuesStorageYear = Revenue::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $shortContractsStorageYear = ShortContracts::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $expensesStorageYear = Expenses::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $pettycashStorageYear = Pettycash::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();


        // Save All Data In row For Array  Year
        $combinedDataYear = [];

        foreach ($revenuesStorageYear as $revenueYear) {
            $combinedDataYear[$revenueYear->year]['revenueYear'] = $revenueYear->sumYear;
        }


        foreach ($shortContractsStorageYear as $shortContractYear) {
            $combinedDataYear[$shortContractYear->year]['shortContractYear'] = $shortContractYear->sumYear;
        }

        foreach ($expensesStorageYear as $expenseYear) {
            $combinedDataYear[$expenseYear->year]['expenseYear'] = $expenseYear->sumYear;
        }

        foreach ($pettycashStorageYear as $pettycashYear) {
            $combinedDataYear[$pettycashYear->year]['pettycashYear'] = $pettycashYear->sumYear;
        }


        // =============== End All Data ==========



        if ($selectedMonth) {
            // Month Inventroy
            $revenuesStorage = Revenue::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->whereMonth('created_at', $selectedMonth)
                ->groupBy('month')
                ->get();

            $shortContractsStorage = ShortContracts::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->whereMonth('created_at', $selectedMonth)
                ->groupBy('month')
                ->get();

            $expensesStorage = Expenses::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->whereMonth('created_at', $selectedMonth)
                ->groupBy('month')
                ->get();

            $pettycashStorage = Pettycash::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->whereMonth('created_at', $selectedMonth)
                ->groupBy('month')
                ->get();

            // Save All Data In row For Array  Month
            $combinedData = [];

            foreach ($revenuesStorage as $revenue) {
                $combinedData[$revenue->month]['revenue'] = $revenue->sum;
            }

            foreach ($shortContractsStorage as $shortContract) {
                $combinedData[$shortContract->month]['shortContract'] = $shortContract->sum;
            }

            foreach ($expensesStorage as $expense) {
                $combinedData[$expense->month]['expense'] = $expense->sum;
            }

            foreach ($pettycashStorage as $pettycash) {
                $combinedData[$pettycash->month]['pettycash'] = $pettycash->sum;
            }
        } else {
            // Month Inventroy
            $revenuesStorage = Revenue::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

            $shortContractsStorage = ShortContracts::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->groupBy('month')
                ->get();

            $expensesStorage = Expenses::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->groupBy('month')
                ->get();

            $pettycashStorage = Pettycash::query()
                ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
                ->groupBy('month')
                ->get();

            // Save All Data In row For Array  Month
            $combinedData = [];

            foreach ($revenuesStorage as $revenue) {
                $combinedData[$revenue->month]['revenue'] = $revenue->sum;
            }

            foreach ($shortContractsStorage as $shortContract) {
                $combinedData[$shortContract->month]['shortContract'] = $shortContract->sum;
            }

            foreach ($expensesStorage as $expense) {
                $combinedData[$expense->month]['expense'] = $expense->sum;
            }

            foreach ($pettycashStorage as $pettycash) {
                $combinedData[$pettycash->month]['pettycash'] = $pettycash->sum;
            }
        }

        return view('admin.fiances.storage', compact('revenuesData','combinedData','combinedDataYear', 'shortContracts', 'expensesData', 'pettycashData'));
    }

    // Filter Year
    public function filterDataYear(Request $request)
    {
        $selectedYear = $request->input('filterYear'); // تحصل على الشهر المحدد من الطلب

        // All Data
        // Get Data in Some Month
        $now = Carbon::now();
        $currentMonth = $now->format('m');

        // Get Data In Table
        $revenuesData = Revenue::whereMonth('created_at', $currentMonth)->get();
        $shortContracts = ShortContracts::whereMonth('created_at', $currentMonth)->get();
        $expensesData = Expenses::whereMonth('created_at', $currentMonth)->get();
        $pettycashData = Pettycash::whereMonth('created_at', $currentMonth)->get();



        // Month Inventroy
        $revenuesStorage = Revenue::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $shortContractsStorage = ShortContracts::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $expensesStorage = Expenses::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        $pettycashStorage = Pettycash::query()
            ->select(DB::raw('DATE_FORMAT(created_at, "%M") as month, sum(amount) as sum'))
            ->groupBy('month')
            ->get();

        // Save All Data In row For Array  Month
        $combinedData = [];

        foreach ($revenuesStorage as $revenue) {
            $combinedData[$revenue->month]['revenue'] = $revenue->sum;
        }

        foreach ($shortContractsStorage as $shortContract) {
            $combinedData[$shortContract->month]['shortContract'] = $shortContract->sum;
        }

        foreach ($expensesStorage as $expense) {
            $combinedData[$expense->month]['expense'] = $expense->sum;
        }

        foreach ($pettycashStorage as $pettycash) {
            $combinedData[$pettycash->month]['pettycash'] = $pettycash->sum;
        }



        // =============== End All Data ==========



        if ($selectedYear) {
        // Year Inventroy
        $revenuesStorageYear = Revenue::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->whereYear('created_at', $selectedYear)
        ->groupBy('year')
        ->get();

        $shortContractsStorageYear = ShortContracts::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->whereYear('created_at', $selectedYear)
        ->groupBy('year')
        ->get();

        $expensesStorageYear = Expenses::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->whereYear('created_at', $selectedYear)
        ->groupBy('year')
        ->get();

        $pettycashStorageYear = Pettycash::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->whereYear('created_at', $selectedYear)
        ->groupBy('year')
        ->get();


        // Save All Data In row For Array  Year
        $combinedDataYear = [];

        foreach ($revenuesStorageYear as $revenueYear) {
            $combinedDataYear[$revenueYear->year]['revenueYear'] = $revenueYear->sumYear;
        }


        foreach ($shortContractsStorageYear as $shortContractYear) {
            $combinedDataYear[$shortContractYear->year]['shortContractYear'] = $shortContractYear->sumYear;
        }

        foreach ($expensesStorageYear as $expenseYear) {
            $combinedDataYear[$expenseYear->year]['expenseYear'] = $expenseYear->sumYear;
        }

        foreach ($pettycashStorageYear as $pettycashYear) {
            $combinedDataYear[$pettycashYear->year]['pettycashYear'] = $pettycashYear->sumYear;
        }


        } else {
        // Year Inventroy
        $revenuesStorageYear = Revenue::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $shortContractsStorageYear = ShortContracts::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $expensesStorageYear = Expenses::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();

        $pettycashStorageYear = Pettycash::query()
        ->select(DB::raw('YEAR(created_at) as year, sum(amount) as sumYear'))
        ->groupBy('year')
        ->get();


        // Save All Data In row For Array  Year
        $combinedDataYear = [];

        foreach ($revenuesStorageYear as $revenueYear) {
            $combinedDataYear[$revenueYear->year]['revenueYear'] = $revenueYear->sumYear;
        }


        foreach ($shortContractsStorageYear as $shortContractYear) {
            $combinedDataYear[$shortContractYear->year]['shortContractYear'] = $shortContractYear->sumYear;
        }

        foreach ($expensesStorageYear as $expenseYear) {
            $combinedDataYear[$expenseYear->year]['expenseYear'] = $expenseYear->sumYear;
        }

        foreach ($pettycashStorageYear as $pettycashYear) {
            $combinedDataYear[$pettycashYear->year]['pettycashYear'] = $pettycashYear->sumYear;
        }


        }

        return view('admin.fiances.storage', compact('revenuesData','combinedData','combinedDataYear', 'shortContracts', 'expensesData', 'pettycashData'));
    }
}