<?php

namespace App\Filament\Widgets;

use App\Models\Form;
use App\Models\FormSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FormStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Forms', Form::count())
                ->description('Active forms: ' . Form::where('is_active', true)->count())
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
                
            Stat::make('Total Submissions', FormSubmission::count())
                ->description('This month: ' . FormSubmission::whereMonth('created_at', now()->month)->count())
                ->descriptionIcon('heroicon-m-inbox-stack')
                ->color('success'),
                
            Stat::make('Most Popular Form', $this->getMostPopularForm())
                ->description($this->getMostPopularFormSubmissions() . ' submissions')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
    
    private function getMostPopularForm(): string
    {
        $form = Form::withCount('submissions')
            ->orderBy('submissions_count', 'desc')
            ->first();
            
        return $form ? $form->title : 'No forms yet';
    }
    
    private function getMostPopularFormSubmissions(): int
    {
        $form = Form::withCount('submissions')
            ->orderBy('submissions_count', 'desc')
            ->first();
            
        return $form ? $form->submissions_count : 0;
    }
}
