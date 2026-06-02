<?php

namespace App\Http\Controllers;

class PanoramaController extends Controller
{
    public function show(string $slug)
    {
        $photo = [
            'title'         => 'Cathédrale de Nancy',
            'location'      => 'Nancy, Grand Est — France',
            'file'          => 'pano-images/a.jpg',
            'caption'       => 'Panorama 360° — Cathédrale Notre-Dame-de-l\'Annonciation',
            'default_yaw'   => 0,
            'default_pitch' => 0,
            'markers'       => [
                ['id' => 'facade',  'yaw' => 0.0, 'pitch' => 0.1, 'rotation' => 1.57, 'target' => null],
                ['id' => 'clocher', 'yaw' => 0.8, 'pitch' => 0.4, 'rotation' => 0,    'target' => null],
            ],
        ];

        return view('panorama', [
            'photo'   => $photo,
            'gallery' => [$photo],
        ]);
    }

    /**
     * Galerie complète (Points 1 à 14).
     *
     * VisibleRangePlugin accepte yawRange en valeurs positives même si min > max
     * (il gère lui-même la plage qui traverse le 0).
     * Pas besoin de convertir en négatif.
     */
    public function gallery()
    {
        $gallery = [
            // a — Point 1
            [
                'title'         => 'Parking',
                'location'      => 'Point 1 — Entrée côté Parking',
                'file'          => 'pano-images/a.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-2', 'yaw' => 5.7230, 'pitch' => -0.1516, 'rotation' => 0, 'target' => 1, 'label' => ''],
                ],
            ],

            // b — Point 2
            [
                'title'         => 'Allée / Devant Bureau',
                'location'      => 'Point 2 — Allée principale',
                'file'          => 'pano-images/b.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-3',      'yaw' => 0.2963, 'pitch' => -0.0517, 'rotation' => 0.78, 'target' => 2,  'label' => ''],
                    ['id' => 'to-14',     'yaw' => 1.6524, 'pitch' => -0.1000, 'rotation' => 0.2,  'target' => 10, 'label' => ''],
                    ['id' => 'back-to-1', 'yaw' => 0.2095, 'pitch' => -0.4692, 'rotation' => 3.25, 'target' => 0,  'label' => ''],
                ],
            ],

            // c — Point 3
            [
                'title'         => 'Carrefour Central',
                'location'      => 'Point 3 — Intersection',
                'file'          => 'pano-images/c.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-4',      'yaw' => 0.6628, 'pitch' => -0.0248, 'rotation' => 0.785398, 'target' => 3, 'label' => ''],
                    ['id' => 'back-to-2', 'yaw' => 0.2095, 'pitch' => -0.4692, 'rotation' => 3.00,     'target' => 1, 'label' => ''],
                ],
            ],

            // d — Point 4
            [
                'title'         => 'Devant Déchetterie',
                'location'      => 'Point 4 — Bâtiment Déchetterie',
                'file'          => 'pano-images/d.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-5',      'yaw' => 1.4931, 'pitch' => -0.1077, 'rotation' => 1.00, 'target' => 5,  'label' => ''],
                    ['id' => 'back-to-3', 'yaw' => 0.7095, 'pitch' => -0.4692, 'rotation' => 3.00, 'target' => 2,  'label' => ''],
                    ['id' => 'to-10',     'yaw' => 5.49,   'pitch' => -0.2692, 'rotation' => 0.78, 'target' => 10, 'label' => ''],
                    ['id' => 'to-6',      'yaw' => 5.2591, 'pitch' => -0.2692, 'rotation' => 5.49, 'target' => 6,  'label' => ''],
                ],
            ],

            // e — Point 5
            [
                'title'         => 'Côté Déchetterie',
                'location'      => 'Point 5 — Allée Déchetterie',
                'file'          => 'pano-images/e.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-6', 'yaw' => 0.3901, 'pitch' => -0.1500, 'rotation' => 3.14, 'target' => 5, 'label' => ''],
                ],
            ],

            // f — Point 6
            [
                'title'         => 'Fond d\'allée (Haut Droite)',
                'location'      => 'Point 6 — Extrémité impasse',
                'file'          => 'pano-images/f.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-5',      'yaw' => 1.8819, 'pitch' => -0.2000, 'rotation' => 0.3,  'target' => 4, 'label' => ''],
                    ['id' => 'back-to-4', 'yaw' => 2.1097, 'pitch' => -0.2000, 'rotation' => 1.57, 'target' => 3, 'label' => ''],
                ],
            ],

            // g — Point 7
            [
                'title'         => 'Cour Centrale',
                'location'      => 'Point 7 — Esplanade',
                'file'          => 'pano-images/g.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-8',      'yaw' => 2.8055, 'pitch' => -0.1000, 'rotation' => 0.78, 'target' => 7,  'label' => ''],
                    ['id' => 'to-11',     'yaw' => 1.2000, 'pitch' => -0.0500, 'rotation' => 0.78, 'target' => 10, 'label' => ''],
                    ['id' => 'back-to-3', 'yaw' => 2.2172, 'pitch' => -0.1500, 'rotation' => 0,    'target' => 2,  'label' => ''],
                ],
            ],

            // h — Point 8
            [
                'title'         => 'Coin Bas Gauche',
                'location'      => 'Point 8 — Angle bâtiment',
                'file'          => 'pano-images/h.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-9',      'yaw' => 0.8000, 'pitch' => -0.1000, 'rotation' => 0,    'target' => 8, 'label' => ''],
                    ['id' => 'back-to-7', 'yaw' => 3.1400, 'pitch' => -0.2000, 'rotation' => 3.14, 'target' => 6, 'label' => ''],
                ],
            ],

            // i — Point 9
            [
                'title'         => 'Petit Local (Entrée)',
                'location'      => 'Point 9 — Devant l\'Annexe',
                'file'          => 'pano-images/i.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'to-10',     'yaw' => 0.0000, 'pitch' => -0.1000, 'rotation' => 0,    'target' => 9, 'label' => ''],
                    ['id' => 'back-to-8', 'yaw' => 3.1400, 'pitch' => -0.2000, 'rotation' => 3.14, 'target' => 7, 'label' => ''],
                ],
            ],

            // j — Point 10
            [
                'title'         => 'Annexe (À refaire)',
                'location'      => 'Point 10 — Intérieur',
                'file'          => 'pano-images/j.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'back-to-9', 'yaw' => 3.1400, 'pitch' => -0.2000, 'rotation' => 3.14, 'target' => 8, 'label' => ''],
                ],
            ],

            // k — Point 11
            [
                'title'         => 'Bureau',
                'location'      => 'Point 14 — Intérieur Bureau',
                'file'          => 'pano-images/k.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'       => [
                    ['id' => 'exit-bureau', 'yaw' => 3.1400, 'pitch' => -0.3000, 'rotation' => 3.14, 'target' => 1, 'label' => ''],
                ],
            ],
        ];

        return view('panorama', [
            'photo'   => $gallery[0],
            'gallery' => $gallery,
        ]);
    }
}
