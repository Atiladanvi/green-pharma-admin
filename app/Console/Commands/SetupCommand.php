<?php

namespace App\Console\Commands;

use App\CreateUser;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SetupCommand extends Command
{
    protected $signature = 'green:setup';

    protected $description = 'Setup assistant';

    private const DEFAULT_ADMIN_NAME = 'Green Administrator';

    private const DEFAULT_ADMIN_EMAIL = 'admin@green.dev';

    private const DEFAULT_ADMIN_PASSWORD = 'greenIsAmazing';

    public function handle()
    {
        $this->info("\nGreen Pharma Installer");
        $this->info("--------------------\n");

        $this->maybeGenerateAppKey();

        $this->info('Migrating database');
        $migrateStatus = $this->call('migrate:status');

        if (!$migrateStatus){
            $overwriteDatabase = $this->choice(
                'Database already migrated, you want overwrite ?',
                [
                    'Not',
                    'Yes'
                ],
                'Not'
            );
            if ($overwriteDatabase === 'Yes'){
                $this->call('migrate:fresh', ['--force' => true]);
                $this->call('db:seed', ['--force' => true]);
                $this->setUpAdminAccount();
            }
        }else{
            $this->call('migrate', ['--force' => true]);
            $this->info('Seeding initial data');
            $this->call('db:seed', ['--force' => true]);
            $this->setUpAdminAccount();
        }

        $this->info("\nImport assets");
        $this->call('adminlte:install', ['--only' => ['assets']]);

        $this->info('✅ Everything succeeded ✅');
    }

    private function setUpAdminAccount(): void
    {
        $this->info("Creating default admin account");

        (new CreateUser())->create([
            'name' => self::DEFAULT_ADMIN_NAME,
            'email' => self::DEFAULT_ADMIN_EMAIL,
            'password' => self::DEFAULT_ADMIN_PASSWORD,
        ],Role::findByName(User::$ADMIN));

        $this->comment(
            sprintf('Log in with email %s and password %s', self::DEFAULT_ADMIN_EMAIL, self::DEFAULT_ADMIN_PASSWORD)
        );
    }

    private function maybeGenerateAppKey(): void
    {
        if (!config('app.key')) {
            $this->info('Generating app key');
            $this->call('key:generate');
        } else {
            $this->comment('App key exists -- skipping');
        }
    }
}
