<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanoramaController extends Controller
{
    /**
     * Affiche un panorama simple (via un slug).
     */
    public function show(string $slug)
    {
        // Exemple : récupérer depuis la BDD (futur)
        // $photo = Photo::where('slug', $slug)->firstOrFail();

        // Données en dur pour le test
        $photo = [
            'title'         => 'Cathédrale de Nancy',
            'location'      => 'Nancy, Grand Est — France',
            'file'          => 'panoramas/1.jpg', // Utilise une de vos images pour le test
            'caption'       => 'Panorama 360° — Cathédrale Notre-Dame-de-l\'Annonciation',
            'default_yaw'   => 0,
            'default_pitch' => 0,

            // Marqueurs optionnels (points d'intérêt)
            'markers' => [
                [
                    'id'          => 'facade',
                    'yaw'         => 0.0,
                    'pitch'       => 0.1,
                    'label'       => 'Façade principale',
                    'description' => 'Construite au XVIIIe siècle',
                ],
                [
                    'id'          => 'clocher',
                    'yaw'         => 0.8,
                    'pitch'       => 0.4,
                    'label'       => 'Clocher',
                    'description' => 'Hauteur : 55 mètres',
                ],
            ],
        ];

        return view('panoramas', compact('photo'));
    }

    /**
     * Affiche la galerie complète de panoramas.
     */
    public function gallery()
    {
        $photo = [
            'title' => 'Panorama Référence 1',
            'location' => 'Lieu Test 1',
            'file' => 'panoramas/1.jpg',
            'caption' => 'Vue de l\'image 1',
            'default_yaw' => 0,
            'default_pitch' => 0,
            // On ajoute la flèche qui pointe vers l'image 2 depuis l'image 1
            'markers' => [
                [
                    'id' => 'to-photo-2',
                    'yaw' => 0.5,       // Oriente la flèche horizontalement (entre -3.14 et 3.14)
                    'pitch' => -0.2,      // Oriente la flèche vers le sol (entre -1.57 et 1.57)
                    'target' => 'panoramas/2.jpg', // Le fichier à charger au clic
                    'title' => 'Aller vers le Panorama 2',
                ]
            ],
        ];

        $gallery = [
            [
                'title' => 'Panorama Référence 1',
                'location' => 'Lieu Test 1',
                'file' => 'panoramas/1.jpg',
            ],
            [
                'title' => 'Panorama Référence 2',
                'location' => 'Lieu Test 2',
                'file' => 'panoramas/2.jpg',
            ],
            [
                'title' => 'Panorama Référence 3',
                'location' => 'Lieu Test 3',
                'file' => 'panoramas/3.jpg',
            ],
            [
                'title' => 'Panorama Référence 4',
                'location' => 'Lieu Test 4',
                'file' => 'panoramas/4.jpg',
            ],
        ];

        return view('panorama', compact('photo', 'gallery'));
    }
}
