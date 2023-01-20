<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outfit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    var $file = '../../assets';

    private $arrayOutfits = array(
		array(
            'name' => 'Outfit 1',
            'description' => 'Outfit 1 description',
            'imageBin' => '/Applications/XAMPP/xamppfiles/htdocs/closetapp/assets/outfit1.jpg',
            'category' => 'Outfit 1 category',
            'price' => '22',
            'size' => 'S',
            'color' => 'red',
            'likes' => 2,
			),
        array(
            'name' => 'Outfit 2',
            'description' => 'Outfit 2 description',
            'imageBin' => '/Applications/XAMPP/xamppfiles/htdocs/closetapp/assets/outfit2.jpg',
            'category' => 'Outfit 2 category',
            'price' => '130',
            'size' => 'M',
            'color' => 'white cream',
            'likes' => 3892,
        ),
        array(
            'name' => 'Outfit 3',
            'description' => 'Outfit 3 description',
            'imageBin' => '/Applications/XAMPP/xamppfiles/htdocs/closetapp/assets/outfit3.jpg',
            'category' => 'Outfit 3 category',
            'price' => '520',
            'size' => 'M',
            'color' => 'white',
            'likes' => 133892,
        ),
        array(
            'name' => 'Outfit 4',
            'description' => 'Outfit 4 description',
            'imageBin' => '/Applications/XAMPP/xamppfiles/htdocs/closetapp/assets/outfit4.jpg',
            'category' => 'Outfit 4 category',
            'price' => '55',
            'size' => 'XL',
            'color' => 'white',
            'likes' => 89292,
        ),
        array(
            'name' => 'Outfit 5',
            'description' => 'Outfit 5 description',
            'imageBin' => '/Applications/XAMPP/xamppfiles/htdocs/closetapp/assets/outfit5.jpg',
            'category' => 'Outfit 5 category',
            'price' => '10',
            'size' => 'L',
            'color' => 'white',
            'likes' => 126389892,
        )
    );


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->seedOutfits();
        $this->seedUsers();

    }

    private function seedOutfits(){
        DB::table('outfits')->delete();
        foreach($this->arrayOutfits as $outfit){
            $o = new Outfit;
            $o->name = $outfit['name'];
            $o->description = $outfit['description'];
            //$o->imageBin = json_encode(file_get_contents($outfit['imageBin']));
            $o->imageMed = base64_encode(file_get_contents($outfit['imageBin']));
            //$o->imageBin = file_get_contents($outfit['imageBin']);
            $o->imageBin = utf8_encode($outfit['imageBin']);
            $o->category = $outfit['category'];
            $o->price = $outfit['price'];
            $o->size = $outfit['size'];
            $o->color = $outfit['color'];
            $o->likes = $outfit['likes'];
            $o->save();
        }
    }

    

    private function seedUsers(){
        DB::table('users')->delete();

        $user = new User;
        $user->name = 'Juanito';
        $user->email = 'juanito@gmail.com';
        $user->password = Hash::make('juanito');
        $user->save();

        $user2 = new User;
        $user2->name = 'Anita';
        $user2->email = 'anita@gmail.com';
        $user2->password = Hash::make('anita');
        $user2->save();

        $user3 = new User;
        $user3->name = 'admin';
        $user3->email = 'admin';
        $user3->password = Hash::make('admin');
        $user3->save();

        $user4 = new User;
        $user4->name = 'Pepito';
        $user4->email = 'pepito@gmail.com';
        $user4->password = Hash::make('pepito');
        $user4->save();
    }
}
