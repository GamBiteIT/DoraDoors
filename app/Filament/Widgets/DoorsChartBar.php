<?php

namespace App\Filament\Widgets;

use App\Models\Door;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DoorsChartBar extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'doorsChartBar';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'DoorsChartBar';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        $door = array();
        $price_in = array();
       
        $doors = Door::all();

        for ($i=0; $i < $doors->count() ; $i++) { 
           $door [] = $doors[$i]->ref;
           $number = $doors[$i]->facturesdoors()->get('price_net')->sum('price_net');
            $price_in []  = number_format($number, 2);
     
        }
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Door Income',
                    'data' => $price_in,
                ],
            ],
            'xaxis' => [
                'categories' => $door,
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
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }
}
