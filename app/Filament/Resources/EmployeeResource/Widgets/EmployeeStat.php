<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Filament\Resources\EmployeeResource\Pages\ListEmployees;
use App\Models\Employee;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class EmployeeStat extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    public function getTablePage(): string
    {
        return ListEmployees::class;
    }

    public array $tableColumnSearches = [];

    protected function getStats(): array
    {
        $employeeData = Trend::model(Employee::class)
            ->dateColumn('hired_date')
            ->between(
                now()->subYear(),
                now())
            ->perMonth()
            ->count();
        return [
            Stat::make("Total Active Employees",$this->getPageTableQuery()
                ->where("active",true)->count())
                ->chart(
                    $employeeData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),
            Stat::make("Total Employee In Probation",
                $this->getPageTableQuery()
                    ->where("hired_date",">=",now()->subMonth(3))
                    ->where("hired_date","<=",now())
                    ->count()),

            Stat::make("Total employees hired in this month",
                $this->getPageTableQuery()
                    ->whereBetween("hired_date",[now()->startOfMonth(),now()->endOfMonth()])
                    ->count())
        ];
    }
}
