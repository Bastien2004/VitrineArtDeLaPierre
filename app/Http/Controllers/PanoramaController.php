<?php

namespace App\Http\Controllers;

class PanoramaController extends Controller
{
    /**
     * Panorama unique (via slug).
     */
    public function show(string $slug)
    {
        $photo = [
            'title'         => 'Cathédrale de Nancy',
            'location'      => 'Nancy, Grand Est — France',
            'file'          => 'pano-images/1.jpg',
            'caption'       => 'Panorama 360° — Cathédrale Notre-Dame-de-l\'Annonciation',
            'default_yaw'   => 0,
            'default_pitch' => 0,
            'markers'       => [
                [
                    'id'          => 'facade',
                    'yaw'         => 0.0,
                    'pitch'       => 0.1,
                    'rotation'    => 1.57, // Optionnel pour les infos de base
                    'label'       => 'Façade principale',
                    'description' => 'Construite au XVIIIe siècle',
                    'target'      => null,
                ],
                [
                    'id'          => 'clocher',
                    'yaw'         => 0.8,
                    'pitch'       => 0.4,
                    'rotation'    => 0,
                    'label'       => 'Clocher',
                    'description' => 'Hauteur : 55 mètres',
                    'target'      => null,
                ],
            ],
        ];

        return view('panorama', [
            'photo'   => $photo,
            'gallery' => [$photo],
        ]);
    }

    /**
     * Galerie complète avec navigation entre panoramas.
     */
    public function gallery()
    {
        $gallery = [
            [
                'title'    => 'Panorama Référence 1',
                'location' => 'Lieu Test 1',
                'file'     => 'pano-images/1.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [
                    [
                        'id'       => 'to-pano-2',
                        'yaw'      => 1.57,
                        'pitch'    => -0.5, // Baissé un peu vers le sol pour l'effet 3D
                        'rotation' => 1.57, // 90° en radians -> Pointe vers la droite
                        'target'   => 1,
                    ],
                ],
            ],
            [
                'title'    => 'Panorama Référence 2',
                'location' => 'Lieu Test 2',
                'file'     => 'pano-images/2.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [
                    [
                        'id'       => 'to-pano-3',
                        'yaw'      => -0.8,
                        'pitch'    => -0.4,
                        'rotation' => -0.8, // S'oriente vers le panorama 3
                        'target'   => 2,
                    ],
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 2.5,
                        'pitch'    => -0.4,
                        'rotation' => 2.5, // Fait demi-tour vers le panorama 1
                        'target'   => 0,
                    ],
                ],
            ],
            [
                'title'    => 'Panorama Référence 3',
                'location' => 'Lieu Test 3',
                'file'     => 'pano-images/3.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [
                    [
                        'id'       => 'to-pano-4',
                        'yaw'      => 1.2,
                        'pitch'    => -0.4,
                        'rotation' => 1.2,
                        'label'    => 'Aller vers Panorama 4',
                        'target'   => 3,
                    ],
                ],
            ],
            [
                'title'    => 'Panorama Référence 4',
                'location' => 'Lieu Test 4',
                'file'     => 'pano-images/4.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [],
            ],
        ];

        return view('panorama', [
            'photo'   => $gallery[0],
            'gallery' => $gallery,
        ]);
    }
}
