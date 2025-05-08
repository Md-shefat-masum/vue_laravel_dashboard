<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                "title" => "Basic Settings",
                "is_default" => 1,
                "sub_groups" => [
                    [
                        "title" => "Logo",
                        "is_default" => 1,
                        "is_multiple" => 1,
                        "values" => [
                            [
                                "title" => "Main Logo",
                                "value" => "logo.png",
                                "is_default" => 1,
                                "type" => 'file',
                            ],
                            [
                                "title" => "Footer Logo",
                                "value" => "logo.png",
                                "is_default" => 1,
                                "type" => 'file',
                            ],
                            [
                                "title" => "Fabicon",
                                "value" => "fabicon.ico",
                                "is_default" => 1,
                                "type" => 'file',
                            ],
                        ]
                    ],
                ]
            ],
            [
                "title" => "SEO",
                "is_default" => 1,
                "sub_groups" => [
                    [
                        "title" => "Main page SEO",
                        "is_default" => 1,
                        "is_multiple" => 1,
                        "values" => [
                            [
                                "title" => "Title",
                                "value" => "Dhaka news",
                                "is_default" => 1,
                            ],
                            [
                                "title" => "Description",
                                "value" => "Dhaka news",
                                "is_default" => 1,
                            ],
                            [
                                "title" => "Keywords",
                                "value" => "Dhaka news",
                                "is_default" => 1,
                            ],
                            [
                                "title" => "Author",
                                "value" => "Dhaka news",
                                "is_default" => 1,
                            ],
                        ]
                    ],
                ],
            ],
            [
                "title" => "Custom Code",
                "is_default" => 1,
                "sub_groups" => [
                    [
                        "title" => "Custom Css",
                        "is_default" => 1,
                        "is_multiple" => 1,
                        "values" => [
                            [
                                "title" => "Header CSS",
                                "value" => "",
                                "is_default" => 1,
                            ],
                            [
                                "title" => "Footer CSS",
                                "value" => "",
                                "is_default" => 1,
                            ],
                        ]
                    ],
                    [
                        "title" => "Custom JS",
                        "is_default" => 1,
                        "is_multiple" => 1,
                        "values" => [
                            [
                                "title" => "Header JS",
                                "value" => "",
                                "is_default" => 1,
                            ],
                            [
                                "title" => "Footer JS",
                                "value" => "",
                                "is_default" => 1,
                            ],
                        ]
                    ],
                ]
            ],
        ];

        DB::table('setting_groups')->truncate();
        DB::table('setting_sub_groups')->truncate();
        DB::table('setting_sub_group_values')->truncate();

        foreach ($groups as $group) {
            $group_id = DB::table('setting_groups')->insertGetId([
                "title" => $group["title"],
                "is_default" => $group["is_default"],
            ]);

            foreach ($group["sub_groups"] as $sub_group) {
                $sub_group_id = DB::table('setting_sub_groups')
                    ->insertGetId([
                        "setting_group_id" => $group_id,
                        "setting_group_title" => $group["title"],

                        "title" => $sub_group["title"],
                        "is_default" => $sub_group["is_default"],
                        "is_multiple" => $sub_group["is_multiple"],
                    ]);

                foreach ($sub_group["values"] as $value) {
                    DB::table('setting_sub_group_values')->insert([
                        "setting_group_id" => $group_id,
                        "setting_group_title" => $group["title"],

                        "setting_sub_group_id" => $sub_group_id,
                        "setting_sub_group_title" => $sub_group["title"],

                        "title" => $value["title"],
                        "value" => $value["value"],
                        "is_default" => $value["is_default"],

                        "type" => $value["type"] ?? 'text',
                    ]);
                }
            }
        }
    }
}
