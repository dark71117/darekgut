<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

class FastConnectionChecker
{
    /**
     * Szybko sprawdza połączenie z Comarch z timeoutem
     *
     * @return bool
     */
    public static function isComarchAvailable(): bool
    {
        try {
            // Ustaw timeout na poziomie systemu
            set_time_limit(10); // Zwiększone z 5 na 10 sekund

            // Próba połączenia z dłuższym timeoutem
            $connection = DB::connection('sqlsrv');

            // Pobierz połączenie PDO bez ustawiania nieobsługiwanego atrybutu
            $pdo = $connection->getPdo();

            // Wykonaj prosty test połączenia
            $pdo->query('SELECT 1');

            return true;
        } catch (PDOException $e) {
            Log::warning('Szybkie sprawdzenie połączenia Comarch nie powiodło się: ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::warning('Błąd podczas sprawdzania połączenia Comarch: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sprawdza połączenie z timeoutem i zwraca status
     *
     * @return array
     */
    public static function checkConnectionWithTimeout(): array
    {
        $startTime = microtime(true);

        try {
            $isAvailable = self::isComarchAvailable();
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2); // w milisekundach

            return [
                'available' => $isAvailable,
                'duration_ms' => $duration,
                'error' => null
            ];
        } catch (\Exception $e) {
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            return [
                'available' => false,
                'duration_ms' => $duration,
                'error' => $e->getMessage()
            ];
        }
    }
}
