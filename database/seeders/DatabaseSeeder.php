public function run(): void
{
    $this->call([
        RoleSeeder::class,
    ]);
}

$this->call([
    RoleSeeder::class,
    AdminUserSeeder::class,
    TrainingCategorySeeder::class,
]);