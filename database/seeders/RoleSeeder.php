<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    private $guard = 'web';

    const SUPER_ADMIN = 'SuperAdmin';
    const ADMIN = 'Admin';
    const USER = 'User';
    const ESPECIALISTA = 'Especialista';
    const AVALIADOR = 'Avaliador';
    const COORDENADOR = 'Coordenador';

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::create([
            'guard_name' => $this->guard,
            'name' => self::SUPER_ADMIN
        ]);

        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create([
            'guard_name' => $this->guard,
            'name' => self::ADMIN
        ]);
        $admin->givePermissionTo(['role.view.all', 'user.view.all', 'user.view', 'user.update']);

        $especialista = Role::create([
            'guard_name' => $this->guard,
            'name' => self::ESPECIALISTA
        ]);
        $especialista->givePermissionTo(['role.view.all', 'user.view.all', 'user.view', 'user.update']);

        Role::create([
            'guard_name' => $this->guard,
            'name' => self::USER
        ]);

        $avaliador = Role::create([
            'guard_name' => $this->guard,
            'name' => self::AVALIADOR
        ]);
        $avaliador->givePermissionTo(['user.view.all', 'user.view']);

        $coordenador = Role::create([
            'guard_name' => $this->guard,
            'name' => self::COORDENADOR
        ]);
        $coordenador->givePermissionTo(['role.view.all', 'user.view.all', 'user.view', 'user.update', 'user.create']);
    }
}