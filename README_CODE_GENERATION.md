# Code Generation Service

Service ini menyediakan fitur generate code otomatis untuk entity Worker, Material, dan Equipment menggunakan table counter yang terintegrasi dengan database.

## Fitur Utama

- **Auto Code Generation**: Generate code otomatis saat create entity baru
- **Monthly Counter Reset**: Counter di-reset setiap bulan baru
- **Unique Code**: Memastikan code yang di-generate selalu unik
- **Thread Safe**: Menggunakan database lock untuk mencegah race condition
- **ACID Compliant**: Menggunakan database transaction untuk konsistensi data

## Format Code

Format code yang di-generate: `{PREFIX}{YY}{MM}{4-DIGIT-NUMBER}`

### Contoh:
- **Worker**: `WK25010001` (WK = Worker, 25 = 2025, 01 = Januari, 0001 = urutan ke-1)
- **Material**: `MT25010001` (MT = Material, 25 = 2025, 01 = Januari, 0001 = urutan ke-1)
- **Equipment**: `EQ25010001` (EQ = Equipment, 25 = 2025, 01 = Januari, 0001 = urutan ke-1)

## Struktur Database

### Table: `counters`

```sql
CREATE TABLE counters (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    entity_type VARCHAR(255) NOT NULL,      -- worker, material, equipment
    prefix VARCHAR(255) NULL,               -- WK, MT, EQ
    current_number INT UNSIGNED DEFAULT 0,  -- Counter saat ini
    year INT UNSIGNED NOT NULL,             -- Tahun
    month INT UNSIGNED NOT NULL,            -- Bulan (1-12)
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    UNIQUE KEY unique_counter (entity_type, year, month),
    INDEX idx_entity_time (entity_type, year, month)
);
```

## Cara Penggunaan

### 1. Dependency Injection di Controller

```php
use App\Contracts\CodeGenerationServiceInterface;

class WorkerController extends Controller
{
    protected $codeGenerationService;

    public function __construct(CodeGenerationServiceInterface $codeGenerationService)
    {
        $this->codeGenerationService = $codeGenerationService;
    }

    public function store(Request $request)
    {
        // Generate code otomatis
        $code = $this->codeGenerationService->generateCode('worker');
        
        $data = $request->all();
        $data['code'] = $code;
        
        Worker::create($data);
    }
}
```

### 2. Langsung dari Service

```php
use App\Services\CodeGenerationService;

$codeService = new CodeGenerationService();

// Generate code untuk worker
$workerCode = $codeService->generateCode('worker');

// Generate code untuk material
$materialCode = $codeService->generateCode('material');

// Generate code untuk equipment
$equipmentCode = $codeService->generateCode('equipment');
```

### 3. Command Line Testing

```bash
# Test generate 5 code untuk worker
php artisan code:test worker --count=5

# Test generate 10 code untuk material
php artisan code:test material --count=10

# Test generate 3 code untuk equipment
php artisan code:test equipment --count=3
```

## API Methods

### CodeGenerationServiceInterface

```php
interface CodeGenerationServiceInterface
{
    /**
     * Generate unique code untuk entity type tertentu
     */
    public function generateCode(string $entityType): string;

    /**
     * Get next number untuk entity type tertentu
     */
    public function getNextNumber(string $entityType): int;

    /**
     * Reset counter untuk entity type tertentu
     */
    public function resetCounter(string $entityType): bool;

    /**
     * Get available entity types
     */
    public function getAvailableEntityTypes(): array;

    /**
     * Get current counter info untuk entity type
     */
    public function getCurrentCounterInfo(string $entityType): ?array;
}
```

## Keamanan & Konsistensi

### ACID Principles

1. **Atomicity**: Setiap generate code menggunakan database transaction
2. **Consistency**: Counter selalu konsisten dengan data yang ada
3. **Isolation**: Menggunakan `lockForUpdate()` untuk mencegah race condition
4. **Durability**: Data counter tersimpan permanen di database

### Race Condition Prevention

```php
// Menggunakan database lock untuk mencegah race condition
$counter = static::where('entity_type', $entityType)
    ->where('year', $currentYear)
    ->where('month', $currentMonth)
    ->lockForUpdate()  // Lock row untuk update
    ->first();
```

## Error Handling

Service ini memiliki error handling yang robust:

- **Logging**: Semua error di-log dengan detail stack trace
- **Exception**: Throw exception dengan pesan yang informatif
- **Transaction Rollback**: Otomatis rollback jika terjadi error

## Testing

### Unit Tests

```bash
# Run semua test
php artisan test

# Run test khusus untuk code generation
php artisan test tests/Unit/CodeGenerationServiceTest.php

# Run test dengan coverage
php artisan test --coverage
```

### Manual Testing

```bash
# Test generate code
php artisan code:test worker --count=5

# Test reset counter
php artisan tinker
>>> app(\App\Contracts\CodeGenerationServiceInterface::class)->resetCounter('worker')
```

## Migration & Seeding

### 1. Run Migration

```bash
php artisan migrate
```

### 2. Run Seeder

```bash
php artisan db:seed --class=CounterSeeder
```

### 3. Reset & Re-seed

```bash
php artisan migrate:fresh --seed
```

## Monitoring & Maintenance

### Counter Info

```php
// Get info counter saat ini
$counterInfo = $codeService->getCurrentCounterInfo('worker');

// Output:
[
    'entity_type' => 'worker',
    'prefix' => 'WK',
    'current_number' => 15,
    'year' => 2025,
    'month' => 1,
    'next_code' => 'WK25010016'
]
```

### Reset Counter

```php
// Reset counter untuk bulan tertentu
$codeService->resetCounter('worker');
```

## Troubleshooting

### Common Issues

1. **Code Duplicate**: Pastikan tidak ada race condition dengan menggunakan transaction
2. **Counter Reset**: Counter otomatis reset setiap bulan baru
3. **Performance**: Gunakan index pada database untuk query yang optimal

### Debug Mode

```php
// Enable debug logging
Log::debug('Code generation debug', [
    'entity_type' => 'worker',
    'current_counter' => $counterInfo
]);
```

## Best Practices

1. **Always use transaction**: Wrap code generation dalam database transaction
2. **Error handling**: Implement proper error handling dan logging
3. **Testing**: Test dengan concurrent requests untuk memastikan thread safety
4. **Monitoring**: Monitor counter usage dan performance
5. **Backup**: Backup table counters secara berkala

## Future Enhancements

- [ ] Support untuk entity type custom
- [ ] Configurable prefix per entity
- [ ] Support untuk format code yang berbeda
- [ ] API endpoint untuk code generation
- [ ] Dashboard monitoring counter
- [ ] Export/import counter data
