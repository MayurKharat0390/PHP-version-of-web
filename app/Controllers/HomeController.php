<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Models\Innovation;
use App\Models\Faculty;

class HomeController {
    public function index(): void {
        try {
            $featured_innovations = Innovation::getFeatured(3);
            $faculties = Faculty::all();

            // Fetch DB core values
            $db_values = Database::fetchAll("SELECT * FROM `core_corevalue` ORDER BY `order` ASC");
            $values = [];
            foreach ($db_values as $v) {
                $examples = Database::fetchAll("SELECT level, text FROM `core_valueexample` WHERE core_value_id = :cid", ['cid' => $v['id']]);
                $exampleDict = [];
                foreach ($examples as $ex) {
                    $exampleDict[$ex['level']] = $ex['text'];
                }
                $values[] = [
                    'name' => $v['name'],
                    'desc' => $v['description'],
                    'icon' => $v['icon'],
                    'examples' => $exampleDict
                ];
            }
        } catch (\Throwable $e) {
            $featured_innovations = [];
            $faculties = [];
            $values = [];
        }

        // Hardcoded fallback values for Universal Human Values (4 Levels of Living)
        if (empty($values)) {
            $values = [
                [
                    'name' => 'Harmony in Self',
                    'desc' => 'Realizing the co-existence of the Self (I) and the Body, ensuring right understanding and feelings.',
                    'icon' => '🧘',
                    'theme' => 'primary',
                    'examples' => [
                        'Knowing' => 'Self-exploration.',
                        'Doing' => 'Right behavior.',
                        'Being' => 'Happiness.',
                        'Living' => 'Health.'
                    ]
                ],
                [
                    'name' => 'Harmony in Family',
                    'desc' => 'The basic unit of human interaction, where values like trust and respect are nurtured through right relationship.',
                    'icon' => '🏡',
                    'theme' => 'accent',
                    'examples' => [
                        'Trust' => 'Foundational value.',
                        'Respect' => 'Right evaluation.',
                        'Affection' => 'Kinship.',
                        'Gratitude' => 'Honoring efforts.'
                    ]
                ],
                [
                    'name' => 'Harmony in Society',
                    'desc' => 'Extending relationship from family to the entire society, aiming for an undivided human race.',
                    'icon' => '🤝',
                    'theme' => 'violet',
                    'examples' => [
                        'Trust' => 'Fearlessness.',
                        'Prosperity' => 'Right production.',
                        'Co-existence' => 'Universal system.',
                        'Work' => 'Service.'
                    ]
                ],
                [
                    'name' => 'Harmony in Nature',
                    'desc' => 'Living in harmony and co-existence with the animal, plant, and material worlds.',
                    'icon' => '🌱',
                    'theme' => 'emerald',
                    'examples' => [
                        'Restraint' => 'Cyclic usage.',
                        'Nurture' => 'Protection.',
                        'Balance' => 'Ecological health.',
                        'Unity' => 'Inseparable link.'
                    ]
                ]
            ];
        }

        View::render('home.index', [
            'values' => $values,
            'featured_innovations' => $featured_innovations,
            'faculties' => $faculties
        ]);
    }

    public function uhvCell(): void {
        $objectives = [
            "Develop and implement programs such as SIP, UHV-I, UHV-II, and Minor Degree in UHV as per institute policy.",
            "Coordinate co-curricular programs like Faculty Mentor Program and Student Buddy Program.",
            "Guide extracurricular activities aligned with human values.",
            "Conduct training and orientation of faculty and staff in UHV and HVBE.",
            "Organize value-based outreach programs for the community.",
            "Regularly track, evaluate, and share progress with stakeholders."
        ];

        $members = [
            ["sr" => 1, "role" => "Chairperson", "name" => "Dr Govind N. Kulkarni", "dept" => "Director, PCCOE", "image" => "images/team/chairperson.png"],
            ["sr" => 2, "role" => "Convener", "name" => "Dr. Mrs. K. Rajeswari", "dept" => "Dean – Academics, PCCOE", "image" => "images/team/k_rajeswari.jpg"],
            ["sr" => 3, "role" => "Coordinator", "name" => "Ms Manjusha Devkule", "dept" => "Institute UHV Coordinator", "image" => "images/team/manjusha_devkule.png"],
            ["sr" => 4, "role" => "Faculty Representative", "name" => "Dr Mahesh Kolte", "dept" => "Professor - E&TC, Dean Library and Learning Resource Development", "image" => "images/team/mahesh_kolte.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Dr Sandeep Patil", "dept" => "Asst. Professor - AS&H", "image" => "images/team/sandeep_patil.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Mrs. Rakhi Pagar", "dept" => "Asst. Professor - IT", "image" => "images/team/rakhi_pagar.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Dr Mrs. Shraddha Ovale", "dept" => "Asst. Professor - Computer Engineering", "image" => "images/team/shraddha_ovale.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Dr. Varsha Pandagare", "dept" => "Asst. Professor - Computer Engineering (Reg.)", "image" => "images/team/varsha_pandagare.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Dr. Jayesh Chordiya", "dept" => "Asst. Professor - Mechanical Engineering", "image" => "images/team/jayesh_chordiya.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Ms. Vaishnavi Pujari", "dept" => "Asst. Professor - Computer Science and Engineering (AIML)", "image" => "images/team/vaishnavi_pujari.png"],
            ["sr" => "", "role" => "Faculty Representative", "name" => "Ms Pratima Kalokhe", "dept" => "Asst. Professor - Civil Engineering", "image" => "images/team/pratima_kalokhe.png"],
            ["sr" => 5, "role" => "Staff Representative", "name" => "Mr. Sanjeev Upendra Aboti", "dept" => "Registrar - Office", "image" => "images/team/sanjeev_aboti.png"],
            ["sr" => "", "role" => "Staff Representative", "name" => "Mr. Ganesh Borade", "dept" => "Campus Incharge"],
        ];

        View::render('core.uhv_cell', [
            'objectives' => $objectives,
            'members' => $members
        ]);
    }
}
