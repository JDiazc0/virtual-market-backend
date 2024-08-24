<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'barcode' => '78113021671',
                'product_name' => 'Beef - Tenderlion, Center Cut',
                'description' => 'at lorem integer tincidunt ante vel ipsum praesent blandit lacinia',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '94501157686',
                'product_name' => 'Sproutsmustard Cress',
                'description' => 'pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '89134843020',
                'product_name' => 'Wine - Wyndham Estate Bin 777',
                'description' => 'ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo pellentesque',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '88196690892',
                'product_name' => 'Rice - Long Grain',
                'description' => 'vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '27788388720',
                'product_name' => 'Heavy Duty Dust Pan',
                'description' => 'lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '28489368587',
                'product_name' => 'Pork - Shoulder',
                'description' => 'platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '91019146378',
                'product_name' => 'Momiji Oroshi Chili Sauce',
                'description' => 'viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '30562189965',
                'product_name' => 'Bread - Roll, Whole Wheat',
                'description' => 'neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '40575482049',
                'product_name' => 'Bread - White Epi Baguette',
                'description' => 'et magnis dis parturient montes nascetur ridiculus mus etiam vel augue',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '32968825708',
                'product_name' => 'Sauce - Salsa',
                'description' => 'sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '11549912495',
                'product_name' => 'Broom - Corn',
                'description' => 'praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '78173858219',
                'product_name' => 'Dc - Frozen Momji',
                'description' => 'montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '31589428627',
                'product_name' => 'Jolt Cola - Electric Blue',
                'description' => 'sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '65155825476',
                'product_name' => 'Pie Shells 10',
                'description' => 'rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '63194211544',
                'product_name' => 'Appetizer - Chicken Satay',
                'description' => 'vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '34269483676',
                'product_name' => 'Turnip - White',
                'description' => 'consequat ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '43795553523',
                'product_name' => 'Garam Marsala',
                'description' => 'in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '22687613230',
                'product_name' => 'Pork - Sausage Casing',
                'description' => 'nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '66728711115',
                'product_name' => 'Cookie Trail Mix',
                'description' => 'donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi',
                'presentation' => 'unit',
            ],
            [
                'barcode' => '99865039848',
                'product_name' => 'Placemat - Scallop, White',
                'description' => 'consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices',
                'presentation' => 'unit',
            ],
        ]);
    }
}
