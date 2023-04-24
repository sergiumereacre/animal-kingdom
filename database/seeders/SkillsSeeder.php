<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Skill::factory(10)->create();
        
        $data = [
            [
                'skill_name' => 'Gambling',
                'skill_description' => 'A user\'s proficiency in the art of leaving their fate to Lady Luck.'    
            ],
        ];


        Skill::insert($data);

        // Skill::factory()->create([
        //     'skill_name' => 'Gambling',
        //     'skill_description' => 'A user\'s proficiency in the art of leaving their fate to Lady Luck.'
        // ]);

        $data = [
            [
                'skill_name' => 'Speed',
            ],
            [
                'skill_name' => 'Electroreception',
            ],
            [
                'skill_name' => 'Night Vision',
            ],
            [
                'skill_name' => 'Olfacation',
            ],
            [
                'skill_name' => 'Echolocation',
            ],
            [
                'skill_name' => 'Hunting',
            ],
            [
                'skill_name' => 'Camoflage',
            ],
            [
                'skill_name' => 'Bubble coralling',
            ],
            [
                'skill_name' => 'Immortality',
            ],
            [
                'skill_name' => 'Poison',
            ],
            [
                'skill_name' => 'Venom',
            ],
            [
                'skill_name' => 'UV resistance',
            ],
            [
                'skill_name' => 'Liquidification at will',
            ],
            [
                'skill_name' => 'Limb regeneration',
            ],
            [
                'skill_name' => 'Adobe',
            ],
            [
                'skill_name' => 'Affinity',
            ],
            [
                'skill_name' => 'Audio Editing',
            ],
            [
                'skill_name' => 'AutoCad',
            ],
            [
                'skill_name' => 'Blogging',
            ],
            [
                'skill_name' => 'Bootstrap',
            ],
            [
                'skill_name' => 'C Programming',
            ],
            [
                'skill_name' => 'C#',
            ],
            [
                'skill_name' => 'C++',
            ],
            [
                'skill_name' => 'CSS',
            ],
            [
                'skill_name' => 'Computer Networking',
            ],
            [
                'skill_name' => 'Data Analytics',
            ],
            [
                'skill_name' => 'Data Management',
            ],
            [
                'skill_name' => 'Databases',
            ],
            [
                'skill_name' => 'DevOps',
            ],
            [
                'skill_name' => 'Digital Marketing',
            ],
            [
                'skill_name' => 'Docker',
            ],
            [
                'skill_name' => 'Economics',
            ],
            [
                'skill_name' => 'Editing',
            ],
            [
                'skill_name' => 'Event Management',
            ],
            [
                'skill_name' => 'Flash',
            ],
            [
                'skill_name' => 'Git',
            ],
            [
                'skill_name' => 'HTML',
            ],
            [
                'skill_name' => 'Horse-Riding',
            ],
            [
                'skill_name' => 'iOS Development',
            ],
            [
                'skill_name' => 'Infographics',
            ],
            [
                'skill_name' => 'Java',
            ],
            [
                'skill_name' => 'Java Swing',
            ],
            [
                'skill_name' => 'JavaScript',
            ],
            [
                'skill_name' => 'Linux',
            ],
            [
                'skill_name' => 'Lua',
            ],
            [
                'skill_name' => 'MacOS',
            ],
            [
                'skill_name' => 'Matlab',
            ],
            [
                'skill_name' => 'Microsoft Office',
            ],
            [
                'skill_name' => 'Oracle',
            ],
            [
                'skill_name' => 'PHP',
            ],
            [
                'skill_name' => 'Pascal',
            ],
            [
                'skill_name' => 'Photoshop',
            ],
            [
                'skill_name' => 'Photography',
            ],
            [
                'skill_name' => 'Python',
            ],
            [
                'skill_name' => 'Rust',
            ],
            [
                'skill_name' => 'Shorthand',
            ],
            [
                'skill_name' => 'Social Media Marketing',
            ],
            [
                'skill_name' => 'Software Interface Design',
            ],
            [
                'skill_name' => 'SolidWorks',
            ],
            [
                'skill_name' => 'Storyboarding',
            ],
            [
                'skill_name' => 'Statistics',
            ],
            [
                'skill_name' => 'Technical Graphics',
            ],
            [
                'skill_name' => 'Typescript',
            ],
            [
                'skill_name' => 'Unity',
            ],
            [
                'skill_name' => 'Unix',
            ],
            [
                'skill_name' => 'Video Editing',
            ],
            [
                'skill_name' => 'Videography',
            ],
            [
                'skill_name' => 'Virtual Reality',
            ],
            [
                'skill_name' => 'Web Design',
            ],
            [
                'skill_name' => 'Web Development',
            ],
            [
                'skill_name' => 'Windows',
            ],
            [
                'skill_name' => 'Wordpress',
            ],
            [
                'skill_name' => 'Writing',
            ],
            [
                'skill_name' => 'XML',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ],
            [
                'skill_name' => 'XHTML',
            ],
            [
                'skill_name' => 'XQuery',
            ],
            [
                'skill_name' => 'XSLT',
            ],
            [
                'skill_name' => 'XSL-FO',
            ]

        ];
        Skill::insert($data);
    }
}
