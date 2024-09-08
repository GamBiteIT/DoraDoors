<?php

namespace App\Filament\Widgets;

use App\Models\FactureDoors;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DailyChartLiner extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'dailyChartLiner';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'DailyChartLiner';
    protected function getFormSchema(): array
    {
        return [
     
     
            DatePicker::make('day')
                
     
        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        $dateStart = $this->filterFormData['day'];
        
        $day=array();
        $price_in = array();
        $price_out = array();

    $query = FactureDoors::select(DB::raw('SUM(price_in) as total_price_in'), 'day')
    ->groupBy('day');

    if ($dateStart !== null) {
        $query->whereDate('day',$dateStart);
    }
    $sums = $query->get();

      for ($i=0; $i < $sums->count() ; $i++) { 
      $price_in [] = $sums[$i]->total_price_in;
      $day [] = $sums[$i]->day;
      }
        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Price In',
                    'data' => $price_in,
                ],
            ],
            'xaxis' => [
                'categories' => $day,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#FF0000'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
