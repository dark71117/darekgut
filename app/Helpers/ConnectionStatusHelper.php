<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

class ConnectionStatusHelper
{
    /**
     * Sprawdza status wszystkich połączeń bazodanowych
     *
     * @return array
     */
    public static function checkAllConnections(): array
    {
        $status = [
            'mysql' => false,
            'sqlsrv' => false,
            'errors' => []
        ];

        // Sprawdź połączenie MySQL
        try {
            DB::connection('mysql')->getPdo();
            $status['mysql'] = true;
        } catch (PDOException $e) {
            $status['errors']['mysql'] = $e->getMessage();
            Log::error('Błąd połączenia MySQL: ' . $e->getMessage());
        }

        // Sprawdź połączenie SQL Server
        try {
            DB::connection('sqlsrv')->getPdo();
            $status['sqlsrv'] = true;
        } catch (PDOException $e) {
            $status['errors']['sqlsrv'] = $e->getMessage();
            Log::error('Błąd połączenia SQL Server: ' . $e->getMessage());
        }

        return $status;
    }

    /**
     * Sprawdza czy aplikacja może działać (przynajmniej MySQL dostępny)
     *
     * @return bool
     */
    public static function canApplicationRun(): bool
    {
        $status = self::checkAllConnections();
        return $status['mysql']; // Aplikacja może działać jeśli MySQL jest dostępny
    }

    /**
     * Zwraca komunikat o statusie połączeń
     *
     * @return string
     */
    public static function getStatusMessage(): string
    {
        $status = self::checkAllConnections();

        if ($status['mysql'] && $status['sqlsrv']) {
            return 'Wszystkie połączenia bazodanowe działają poprawnie.';
        } elseif ($status['mysql'] && !$status['sqlsrv']) {
            return 'Połączenie z lokalną bazą MySQL działa. Brak połączenia z bazą Comarch.';
        } elseif (!$status['mysql'] && $status['sqlsrv']) {
            return 'Połączenie z bazą Comarch działa. Brak połączenia z lokalną bazą MySQL.';
        } else {
            return 'Brak połączenia z żadną bazą danych.';
        }
    }

    /**
     * Sprawdza czy można wyświetlić ostrzeżenie o Comarch
     *
     * @return bool
     */
    public static function shouldShowComarchWarning(): bool
    {
        $status = self::checkAllConnections();
        return $status['mysql'] && !$status['sqlsrv'];
    }
}
