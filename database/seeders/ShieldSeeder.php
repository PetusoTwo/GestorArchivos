namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User; // Asegúrate de importar el modelo User

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"panel_user","guard_name":"web","permissions":["view_archivo","view_any_archivo","view_categoria","view_any_categoria","view_folder","view_any_folder","view_media","view_any_media"]},{"name":"super_admin","guard_name":"web","permissions":["view_archivo","view_any_archivo","create_archivo","update_archivo","restore_archivo","restore_any_archivo","replicate_archivo","reorder_archivo","delete_archivo","delete_any_archivo","force_delete_archivo","force_delete_any_archivo","view_categoria","view_any_categoria","create_categoria","update_categoria","restore_categoria","restore_any_categoria","replicate_categoria","reorder_categoria","delete_categoria","delete_any_categoria","force_delete_categoria","force_delete_any_categoria","view_folder","view_any_folder","create_folder","update_folder","restore_folder","restore_any_folder","replicate_folder","reorder_folder","delete_folder","delete_any_folder","force_delete_folder","force_delete_any_folder","view_media","view_any_media","create_media","update_media","restore_media","restore_any_media","replicate_media","reorder_media","delete_media","delete_any_media","force_delete_media","force_delete_any_media","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->createSuperAdminUser();

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }

    protected function createSuperAdminUser(): void
    {
        $superAdminRole = Utils::getRoleModel()::where('name', 'super_admin')->first();

        if (!$superAdminRole) {
            $this->command->error('Super Admin role not found.');
            return;
        }

        // Crea un usuario con el rol super_admin
        $user = User::firstOrCreate([
            'email' => 'superadmin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'), // Cambia esta contraseña por una segura
        ]);

        // Asigna el rol super_admin al usuario
        $user->roles()->sync([$superAdminRole->id]);

        $this->command->info('Super Admin user created.');
    }
}
