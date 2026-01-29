<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;
use PDO;

class ComarchHelper
{
    /**
     * Bezpiecznie wykonuje zapytanie do bazy Comarch
     *
     * @param callable $callback Funkcja do wykonania z połączeniem DB
     * @param mixed $default Wartość domyślna w przypadku błędu
     * @return mixed
     */
    public static function safeQuery(callable $callback, $default = [])
    {
        try {
            return $callback(DB::connection('sqlsrv'));
        } catch (PDOException $e) {
            Log::warning('Błąd połączenia z Comarch podczas wykonywania zapytania: ' . $e->getMessage());
            return $default;
        }
    }

            /**
     * Sprawdza czy połączenie z Comarch jest dostępne
     *
     * @return bool
     */
    public static function isConnectionAvailable(): bool
    {
        return FastConnectionChecker::isComarchAvailable();
    }

    /**
     * Wykonuje zapytanie SELECT z obsługą błędów
     *
     * @param string $query Zapytanie SQL
     * @param array $params Parametry zapytania
     * @param mixed $default Wartość domyślna w przypadku błędu
     * @return array
     */
    public static function select(string $query, array $params = [], $default = [])
    {
        return self::safeQuery(function($connection) use ($query, $params) {
            return $connection->select($query, $params);
        }, $default);
    }

    /**
     * Wykonuje zapytanie z obsługą błędów i zwraca pierwszy wynik
     *
     * @param string $query Zapytanie SQL
     * @param array $params Parametry zapytania
     * @param mixed $default Wartość domyślna w przypadku błędu
     * @return mixed
     */
    public static function selectFirst(string $query, array $params = [], $default = null)
    {
        $results = self::select($query, $params, []);
        return !empty($results) ? $results[0] : $default;
    }

    /**
     * Wykonuje zapytanie COUNT z obsługą błędów
     *
     * @param string $query Zapytanie SQL
     * @param array $params Parametry zapytania
     * @return int
     */
    public static function count(string $query, array $params = []): int
    {
        $result = self::selectFirst($query, $params, ['count' => 0]);
        return is_object($result) ? $result->count : 0;
    }

    /**
     * Pobiera dane z tabeli z obsługą błędów
     *
     * @param string $table Nazwa tabeli
     * @param array $columns Kolumny do pobrania
     * @param int $limit Limit wyników
     * @param mixed $default Wartość domyślna w przypadku błędu
     * @return array
     */
    public static function getTableData(string $table, array $columns = ['*'], int $limit = null, $default = [])
    {
        return self::safeQuery(function($connection) use ($table, $columns, $limit) {
            $query = $connection->table($table)->select($columns);

            if ($limit) {
                $query->limit($limit);
            }

            return $query->get()->toArray();
        }, $default);
    }
}
