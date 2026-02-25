<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterItem;

class FooterItemsSeeder extends Seeder
{
    public function run(): void
    {
        $footerData = [
            
            [
                'section' => 'about',
                'label' => 'About',
                'value' => 'A student-focused digital loan platform providing accessible, transparent, and affordable financing to support academic success.',
                'sort_order' => 1,
                'is_active' => true,
            ],

            
            ['section' => 'links', 'label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['section' => 'links', 'label' => 'About Us', 'url' => '/about', 'sort_order' => 2],
            ['section' => 'links', 'label' => 'Services', 'url' => '/services', 'sort_order' => 3],
            ['section' => 'links', 'label' => 'Contact', 'url' => '/contact', 'sort_order' => 4],

            
            [
                'section' => 'contact',
                'label' => 'Email',
                'value' => 'support@studentloan.com',
                'url' => 'mailto:support@studentloan.com',
                'sort_order' => 1,
            ],
            [
                'section' => 'contact',
                'label' => 'Phone',
                'value' => '+254 700 000 000',
                'sort_order' => 2,
            ],
            [
                'section' => 'contact',
                'label' => 'Hours',
                'value' => 'Mon – Fri, 9:00 AM – 5:00 PM',
                'sort_order' => 3,
            ],
            [
                'section' => 'contact',
                'label' => 'Location',
                'value' => 'Kenya',
                'sort_order' => 4,
            ],

            
            [
                'section' => 'social',
                'label' => 'Facebook',
                'icon' => 'fa-facebook',
                'url' => 'https://facebook.com',
                'sort_order' => 1,
            ],
            [
                'section' => 'social',
                'label' => 'Twitter',
                'icon' => 'fa-x-twitter',
                'url' => 'https://twitter.com',
                'sort_order' => 2,
            ],

           
            [
                'section' => 'disclaimer',
                'label' => 'Disclaimer',
                'value' => 'Loan approval is subject to eligibility verification, institutional validation, and internal assessment.',
                'sort_order' => 1,
            ],

            
            [
                'section' => 'copyright',
                'label' => 'Copyright',
                'value' => '© '.date('Y').' Student Loan Platform. All rights reserved.',
                'sort_order' => 1,
            ],
        ];

        foreach ($footerData as $item) {
            FooterItem::updateOrCreate(
                ['section' => $item['section'], 'label' => $item['label']],
                $item
            );
        }
    }
}