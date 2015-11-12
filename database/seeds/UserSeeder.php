<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User;

        $user1->name            = "Van Reeth";
        $user1->surname         = "Jonas";
        $user1->email           = "Jonasvanreeth@gmail.com";
        $user1->password        = Hash::make('1234test');
        $user1->street          = "Plantinkaai";
        $user1->nr              = 1;
        $user1->additive        = "23";
        $user1->city            = "Antwerp";
        $user1->postalcode      = "2000";
        $user1->country         = "Belgie";
        $user1->loginname       = "jonasvr";
        $user1->admin           = 1;
        
        $user1->save();

        $tester = new User;

        $tester->name            = "testers";
        $tester->surname         = "test";
        $tester->email           = "test@gmail.com";
        $tester->password        = Hash::make('1234test');
        $tester->street          = "testersstreet";
        $tester->nr              = 1;
        $tester->city            = "TestersVille";
        $tester->postalcode      = "1111";
        $tester->country         = "Belgie";
        $tester->loginname       = "testie1";
         
        $tester->save();

        $tester1 = new User;

        $tester1->name            = "testers";
        $tester1->surname         = "test2";
        $tester1->email           = "test2@gmail.com";
        $tester1->password        = Hash::make('1234test');
        $tester1->street          = "testersstreet";
        $tester1->nr              = 2;
        $tester1->city            = "TestersVille";
        $tester1->postalcode      = "1111";
        $tester1->country         = "Belgie";
        $tester1->loginname       = "testie2";
         
        $tester1->save();
    }
}