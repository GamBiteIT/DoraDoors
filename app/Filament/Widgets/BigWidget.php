<?php

namespace App\Filament\Widgets;

use Kenepa\MultiWidget\MultiWidget;

class BigWidget extends MultiWidget
{
    public array $widgets = [
       DoorsChartBar::class,
       DailyChartLiner::class
    ];

  
}
