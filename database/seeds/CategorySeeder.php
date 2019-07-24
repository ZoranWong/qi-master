<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\CategoryProperty;
use App\Models\ServiceRequirement;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $categories = factory(Category::class, 10)->create();
        Category::truncate();

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
        $faker = app(\Faker\Generator::class);
        $key = 0;
        foreach ($names as $k => $v) {
            foreach ($v as $i => $item) {
                $category = new Category([
                    'parent_id' => 0,
                    'classification_id' => $k+1,
                    'name' => $item,
                    'sort' => $faker->randomDigit
                ]);
                $category->save();
                $brand = new \App\Models\Brand();
                $brand->name = $brands[$key];
                $brand->status = 1;
                $brand->sort = random_int(0, 100);
                $category->brands()->save($brand);
                $properties = [];
                for ($i = 0; $i < 2; $i ++) {
                    $property = new CategoryProperty([
                        'title' => $faker->name,
                        'value' => $faker->randomElements( [
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                        ], $faker->randomDigit % 3 + 1)
                    ]);
                    array_push($properties, $property);
                }
                $category->properties()->saveMany($properties);
                $requirements = [];
                for ($i = 0; $i < 2; $i ++) {
                    $requirement =new ServiceRequirement([
                        'name' => $faker->name,
                        'value' => $faker->randomElements( [
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                            ['title' => $faker->name],
                        ], $faker->randomDigit % 3 + 1),
                        'service_id' => $category->classification->services->random(1)->first()->id
                    ]);
                    array_push($requirements, $requirement);
                }
                $category->requirements()->saveMany($requirements);
                $key ++;
            }
        }
    }
}
