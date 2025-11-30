<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Subscription extends Page
{
    protected string $view = 'filament.pages.subscription';

    protected static ?string $title = 'Subscripción';

    protected static bool $shouldRegisterNavigation = false;
}
