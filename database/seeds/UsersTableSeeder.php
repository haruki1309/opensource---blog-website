<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [ 
                'username'=>'trungtin',
                'password'=>bcrypt('13092004'),
                'name'=>'Tôi dại dột',
                'description'=>'Thuở còn là sinh viên, mình từng có những thắc mắc, trăn trở về technical, về con đường nghề nghiệp, nhưng không có ai giải đáp. Blog này là nơi mình chia sẻ những kiến thức, kinh nghiệm mà mình đạt được trong quá trình làm việc và trải nghiệm. Mong rằng nó sẽ giải đáp phần nào những khúc mắc, trăn trở cho những bạn sinh viên như mình ngày xưa.',
                'img_url'=>'1309_admin_avt/q5Ny_trungtin_2.jpg'

            ]
        ];

        DB::table('user')->insert($admin);

        $this->command->info('Insert admin data successful!');
    }
}
