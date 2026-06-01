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
                    'target'      => null,
                ],
                [
                    'id'          => 'clocher',
                    'yaw'         => 0.8,
                    'pitch'       => 0.4,
                    'rotation'    => 0,
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
                        'yaw'      => 5.7230,
                        'pitch'    => -0.1516,
                        'rotation' => 0,
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
                        'yaw'      => 0.2963,
                        'pitch'    => -0.0517,
                        'rotation' => -0,78,
                        'target'   => 2,
                    ],
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => -0.4692,
                        'rotation' => 3,49,
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
                        'yaw'      => 0.6628,
                        'pitch'    => -0.0248,
                        'rotation' => 0,785398,
                        'label'    => 'Aller vers Panorama 4',
                        'target'   => 3,
                    ],
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => -0.4692,
                        'rotation' => 3,49,
                        'target'   => 0,
                    ],
                ],
            ],
            [
                'title'    => 'Panorama Référence 4',
                'location' => 'Lieu Test 4',
                'file'     => 'pano-images/4.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => 1.5008,
                        'rotation' => -0.1074,
                        'target'   => 5,
                    ],
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => 1.5008,
                        'rotation' => -0.1074,
                        'target'   => 3,
                    ],
                ],
            ],
            [
                'title'    => 'Panorama Référence 4',
                'location' => 'Lieu Test 4',
                'file'     => 'pano-images/5.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'markers'  => [
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => 1.5008,
                        'rotation' => -0.1074,
                        'target'   => 5,
                    ],
                    [
                        'id'       => 'to-pano-1',
                        'yaw'      => 0.2095,
                        'pitch'    => 1.5008,
                        'rotation' => -0.1074,
                        'target'   => 3,
                    ],
                ],
            ],
        ];

        return view('panorama', [
            'photo'   => $gallery[0],
            'gallery' => $gallery,
        ]);
    }
}
