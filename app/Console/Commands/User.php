<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 23.02.18
 * Time: 19:11
 */

namespace App\Console\Commands;

use App\Providers\AuthServiceProvider;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use App\User as UserModel;
use Illuminate\Support\Facades\Hash;

class User extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:create';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Manage Users in blog";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(){
        $this->fire();
    }
    public function fire()
    {
        if($this->option('login') && $this->option('password')){
            $login = $this->option('login');
            $pass = $this->option('password');
            if (UserModel::getUserByLogin($login)) return $this->error('User already exists');
            $user = new UserModel;
            $user->login = $login;
            $user->password = Hash::make($pass);
            $user->save();
            return $this->info('User has been created');
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('login', 'l', InputOption::VALUE_REQUIRED, 'User login', null),
            array('password', 'p', InputOption::VALUE_REQUIRED, 'User password', null),
        );
    }

    }