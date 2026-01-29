# ComarchHelper - Bezpieczne połączenie z bazą Comarch

## Opis

`ComarchHelper` to klasa pomocnicza, która zapewnia bezpieczne wykonywanie zapytań do bazy danych Comarch (SQL Server). W przypadku braku połączenia z bazą Comarch, helper zwraca wartości domyślne zamiast rzucać błędy, co pozwala aplikacji działać dalej z lokalną bazą MySQL.

## Metody

### `safeQuery(callable $callback, $default = [])`
Bezpiecznie wykonuje dowolne zapytanie do bazy Comarch.

```php
$result = ComarchHelper::safeQuery(function($connection) {
    return $connection->select("SELECT * FROM ARTYKUL WHERE ID_MAGAZYNU = 1");
}, []);
```

### `select(string $query, array $params = [], $default = [])`
Wykonuje zapytanie SELECT z obsługą błędów.

```php
$produkty = ComarchHelper::select(
    "SELECT ID_ARTYKULU, NAZWA FROM ARTYKUL WHERE ID_MAGAZYNU = ?",
    [1],
    []
);
```

### `selectFirst(string $query, array $params = [], $default = null)`
Wykonuje zapytanie i zwraca pierwszy wynik.

```php
$produkt = ComarchHelper::selectFirst(
    "SELECT * FROM ARTYKUL WHERE ID_ARTYKULU = ?",
    [$id],
    null
);
```

### `count(string $query, array $params = [])`
Wykonuje zapytanie COUNT i zwraca liczbę.

```php
$ilosc = ComarchHelper::count(
    "SELECT COUNT(*) as count FROM ARTYKUL WHERE ID_MAGAZYNU = ?",
    [1]
);
```

### `isConnectionAvailable()`
Sprawdza czy połączenie z Comarch jest dostępne.

```php
if (ComarchHelper::isConnectionAvailable()) {
    // Wykonaj zapytanie do Comarch
} else {
    // Użyj danych z lokalnej bazy
}
```

## Przykład użycia w kontrolerze

```php
public function produkt_wfmag()
{
    $produkty_wfmag = ComarchHelper::select(
        "SELECT ID_ARTYKULU id_tow, NAZWA, STAN 
         FROM ARTYKUL 
         WHERE ID_MAGAZYNU = 1 AND (STAN > 0 OR ZAREZERWOWANO > 0) 
         ORDER BY NAZWA",
        [],
        [] // Pusta tablica jako wartość domyślna
    );
    
    $ile = count($produkty_wfmag);
    return view('info.produkt_stan_wfmag', compact('produkty_wfmag', 'ile'));
}
```

## Migracja z DB::connection('sqlsrv')

### Przed:
```php
$data = DB::connection('sqlsrv')->select("SELECT * FROM ARTYKUL");
```

### Po:
```php
$data = ComarchHelper::select("SELECT * FROM ARTYKUL", [], []);
```

## Korzyści

1. **Bezpieczeństwo** - aplikacja nie crashuje gdy Comarch jest niedostępny
2. **Graceful degradation** - system działa dalej z lokalną bazą
3. **Logowanie** - błędy są logowane dla administratorów
4. **Przyjazne komunikaty** - użytkownicy widzą jasne komunikaty zamiast błędów technicznych

## Uwagi

- Zawsze podawaj wartość domyślną jako trzeci parametr
- Używaj parametrów `?` zamiast interpolacji stringów dla bezpieczeństwa
- Helper automatycznie loguje błędy połączenia 
