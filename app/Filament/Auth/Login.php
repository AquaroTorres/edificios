<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseAuth;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('run')
            ->translateLabel()
            ->required()
            ->autocomplete('run')
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        // clean $data['run'] only numbers and K
        $data['run'] = preg_replace('/[^0-9kK]/', '', $data['run']);
        // format run xxxxx-x
        $data['run'] = substr($data['run'], 0, -1).'-'.substr($data['run'], -1);

        return [
            'run' => $data['run'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.run' => __('filament-panels::auth/pages/login.messages.failed'),
        ]);
    }
}
