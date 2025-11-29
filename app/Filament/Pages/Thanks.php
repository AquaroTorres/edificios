<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Inerba\DbConfig\DbConfig;
use Livewire\Attributes\Url;

class Thanks extends Page
{
    protected string $view = 'filament.pages.thanks';

    protected static ?string $title = 'Tu suscripción ha sido registrada correctamente';

    #[Url]
    public ?string $preapproval_id = null;

    protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
        if ($this->preapproval_id == db_config('system.preapproval_plan_id')) {
            DbConfig::set('system.subscription', true);
            DbConfig::set('system.subscription_at', now());
            // redirect without the query $preapproval_id
            // $this->redirect(route('filament.admin.pages.thanks'));
        } else {
            $this->preapproval_id = null;
            // Optionally handle the case where the preapproval_id does not match
        }
    }
}
