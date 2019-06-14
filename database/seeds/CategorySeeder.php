<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(Category::class, 10)->create();

        $names = [
            [
                '沙发',
                '床'
            ],
            [
                '浴缸',
                '马桶'
            ],
            [
                '吊灯',
                '照明灯'
            ],
            [
                '贴瓷砖',
                '刷油漆'
            ],
            [
                '冰箱',
                '洗衣机'
            ]
        ];

        $brands = [
            '宜家',
            '义乌',
            'Spear',
            'Opa',
            'Lida',
            'Face Man',
            '罗马',
            'Marry',
            '美菱',
            '海尔'
        ];

        foreach ($categories as $key => $category) {
            /**@var Category $category * */
            $category->name = $names[$key % 5][$key % 2];
            $category->classificationId = (($key % 5) + 1);
            $category->save();
            $brand = new \App\Models\Brand();
            $brand->name = $brands[$key];
            $brand->status = 1;
            $brand->sort = random_int(0, 100);
//            $brand->categoryId = $category->id;
            $category->brands()->save($brand);
        }
    }
}
