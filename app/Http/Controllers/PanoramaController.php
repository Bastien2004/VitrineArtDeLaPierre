<?php

namespace App\Http\Controllers;

class PanoramaController extends Controller
{
    public function show(string $slug)
    {
        $photo = [
            'title'         => 'L art de la pierre',
            'location'      => 'Bellignies',
            'file'          => 'pano-images/a.jpg',
            'caption'       => 'Panorama 360°',
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
                'title'         => 'Apres parking',
                'location'      => 'Point 1 — Apres parking',
                'file'          => 'pano-images/a.jpg',
                'default_yaw'   => 5.7230,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-2', 'yaw' => 5.7230, 'pitch' => -0.1516, 'rotation' => 0, 'target' => 1, 'label' => ''],
                    ['id' => 'camera', 'yaw' => 5.7230, 'pitch' => 0.3, 'rotation' => 0, 'target' => null, 'label' => 'Site sécurisé par un système de vidéosurveillance.'],
                ],
            ],

            // b — Point 2
            [
                'title'         => 'Allée / Devant Bureau',
                'location'      => 'Point 2 — Allée principale',
                'file'          => 'pano-images/b.jpg',
                'default_yaw'   => 0.8053,
                'default_pitch' => -0.1565,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-3',      'yaw' => 0.2963, 'pitch' => -0.0517, 'rotation' => 0.78, 'target' => 2,  'label' => ''],
                    ['id' => 'to-14',     'yaw' => 1.6524, 'pitch' => -0.1000, 'rotation' => 0.2,  'target' => 10, 'label' => ''],
                    ['id' => 'back-to-1', 'yaw' => 0.2095, 'pitch' => -0.4692, 'rotation' => 3.25, 'target' => 0,  'label' => ''],
                    ['id' => 'back-to-11', 'yaw' => 6.2513, 'pitch' => -0.2194, 'rotation' => 4.71, 'target' => 11,  'label' => ''],
                ],
            ],

            // c — Point 3
            [
                'title'         => 'Carrefour Central',
                'location'      => 'Point 3 — Intersection',
                'file'          => 'pano-images/c.jpg',
                'default_yaw'   => 0.4505,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-4',      'yaw' => 0.6628, 'pitch' => -0.0248, 'rotation' => 0.785398, 'target' => 3, 'label' => ''],
                    ['id' => 'back-to-2', 'yaw' => 0.2095, 'pitch' => -0.4692, 'rotation' => 3.00,     'target' => 1, 'label' => ''],
                    ['id' => 'compresseur', 'yaw' => 0.0207, 'pitch' => 0.3201, 'rotation' => 0, 'target' => null, 'label' => 'Concasseur <br> Machine qui broie les chutes et déchets de pierre <br> pour les transformer en galets, graviers ou matériaux réutilisables.'],
                    ['id' => 'eau', 'yaw' => 6.1487, 'pitch' => 0.5444, 'rotation' => 0, 'target' => null, 'label' => 'fp600/6 installation de clarification des eaux et déshydratation des boues <br> Installation qui récupère, filtre et réutilise <br> l\'eau utilisée par les machines de découpe et de polissage, <br> limitant ainsi le gaspillage et l\'impact environnemental.'],

                ],
            ],

            // d — Point 4
            [
                'title'         => 'Carrefour',
                'location'      => 'Point 4 — Carrefour',
                'file'          => 'pano-images/d.jpg',
                'default_yaw'   => 5.5730,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-5',      'yaw' => 1.4931, 'pitch' => -0.1077, 'rotation' => 1.00, 'target' => 5,  'label' => ''],
                    ['id' => 'back-to-3', 'yaw' => 0.7095, 'pitch' => -0.4692, 'rotation' => 3.00, 'target' => 2,  'label' => ''],
                    ['id' => 'to-6',      'yaw' => 5.2591, 'pitch' => -0.2692, 'rotation' => 0, 'target' => 6,  'label' => ''],
                ],
            ],

            // e — Point 5
            [
                'title'         => 'Devant atelier',
                'location'      => 'Point 5 — Devant atelier',
                'file'          => 'pano-images/e.jpg',
                'default_yaw'   => 0.5708,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-6', 'yaw' => 0.3901, 'pitch' => -0.1500, 'rotation' => 3.14, 'target' => 5, 'label' => ''],
                    ['id' => 'Atelier', 'yaw' => 0.4093, 'pitch' => 0.1596, 'rotation' => 0, 'target' => null, 'label' => 'Atelier <br> Espace de travail où les artisans façonnent la pierre : </br>polissage, meulage, collage des rejingots, finitions et <br> préparation des pièces avant leur livraison ou leur pose.'],

                ],
            ],

            // f — Point 6
            [
                'title'         => 'Atelier',
                'location'      => 'Point 6 — atelier',
                'file'          => 'pano-images/f.jpg',
                'default_yaw'   => 1.7657,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -3,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-5',      'yaw' => 1.8819, 'pitch' => -0.2000, 'rotation' => 0.3,  'target' => 4, 'label' => ''],
                    ['id' => 'back-to-4', 'yaw' => 2.1097, 'pitch' => -0.2000, 'rotation' => 1.57, 'target' => 3, 'label' => ''],
                    ['id' => 'Débiteuse', 'yaw' => 3.9186, 'pitch' => 0.3209, 'rotation' => 0, 'target' => null, 'label' => 'Débiteuse <br> Grande machine équipée d\'un disque diamanté <br> permettant de découper avec précision <br> les blocs et les plaques de pierre selon <br> les dimensions souhaitées.'],

                ],
            ],

            // g — Point 7
            [
                'title'         => 'Cour Centrale',
                'location'      => 'Point 7 — Cour Centrale',
                'file'          => 'pano-images/g.jpg',
                'default_yaw'   => 1.6960,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.7,
                'markers'       => [
                    ['id' => 'to-11', 'yaw' => 1.9, 'pitch' => 0, 'rotation' => 0.78, 'target' => 3, 'label' => ''],                    ['id' => 'to-9', 'yaw' => 2.0790, 'pitch' => -0.0660, 'rotation' => 1,    'target' => 9,  'label' => ''],
                    ['id' => 'back-to-3', 'yaw' => 2.2172, 'pitch' => -0.1500, 'rotation' => 1.57,    'target' => 7,  'label' => ''],
                    ['id' => 'Tremies', 'yaw' => 1.5585, 'pitch' => 0.1999, 'rotation' => 0, 'target' => null, 'label' => 'Trémies de vieillissement <br> Grands bacs vibrants dans lesquels les pierres sont <br> brassées afin de leur donner un aspect vieilli et authentique, <br> recherché pour certains aménagements et restaurations.'],
                ],
            ],

            // h — Point 8
            [
                'title'         => 'Coin Bas Gauche',
                'location'      => 'Point 8 — Angle bâtiment',
                'file'          => 'pano-images/h.jpg',
                'default_yaw'   => 5.5624,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'to-9',      'yaw' => 5.2032, 'pitch' => -0.1000, 'rotation' => 4.71, 'target' => 8, 'label' => ''],
                    ['id' => 'back-to-7', 'yaw' => 6.0431, 'pitch' => -0.2000, 'rotation' => 3.14, 'target' => 6, 'label' => ''],
                    ['id' => 'Polissoir', 'yaw' => 4.7415, 'pitch' => 0.2631, 'rotation' => 0, 'target' => null, 'label' => 'Polissoir <br> Machine montée sur rails qui lisse et polit la surface <br> des dalles de pierre afin d\'obtenir une finition uniforme, <br> brillante ou satinée selon le rendu souhaité.'],

                ],
            ],

            // i — Point 9
            [
                'title'         => 'Tour',
                'location'      => 'Point 9 — Tour',
                'file'          => 'pano-images/i.jpg',
                'default_yaw'   => 0.2905,
                'default_pitch' => 0,
                'default_zoom'  => 0,
                'min_yaw'       => -0.001,
                'max_yaw'       =>  0.001,
                'min_pitch'     => -0.001,
                'max_pitch'     =>  0.001,
                'markers'       => [
                    ['id' => 'back-to-8', 'yaw' => 0.1809, 'pitch' => -0.2000, 'rotation' => 3.14, 'target' => 7, 'label' => ''],
                    ['id' => 'Tour', 'yaw' => 0.0273, 'pitch' => 0.1601, 'rotation' => 0, 'target' => null, 'label' => 'Tour <br> Machine permettant de réaliser des <br> éléments de forme ronde ou cylindrique <br> tels que des piliers, balustres, colonnes <br> et autres pièces décoratives sur mesure.'],
                ],
            ],

            // j — Point 10
            [
                'title'         => 'Armure',
                'location'      => 'Point 10 — Armure',
                'file'          => 'pano-images/j.jpg',
                'video_id'      => 'Bvz3O6yqzwo',
                'video_title'   => 'Démonstration Armure',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'min_yaw'       => -0.001,
                'max_yaw'       =>  0.001,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'markers'       => [
                    ['id' => 'back-to-9', 'yaw' => 0.0927, 'pitch' => -0.7010, 'rotation' => 3.14, 'target' => 6, 'label' => ''],
                    ['id' => 'Armure', 'yaw' => 0.0721, 'pitch' => -0.1768, 'rotation' => 0, 'target' => null, 'label' => 'Armure <br> Machine de sciage utilisée pour transformer les gros blocs de pierre <br> en plaques de différentes épaisseurs, prêtes à être travaillées ou façonnées.'],                ],
            ],

            // k — Point 11
            [
                'title'         => 'Bureau',
                'location'      => 'Point 14 — Intérieur Bureau',
                'file'          => 'pano-images/k.jpg',
                'default_yaw'   => 0,
                'default_pitch' => 0,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'back-to-1', 'yaw' => 1.4390, 'pitch' => -0.3000, 'rotation' => 3.35, 'target' => 1, 'label' => ''],
                ],
            ],

            // L — Point 12
            [
                'title'         => 'Allée / Or',
                'location'      => 'Point 11 — Or',
                'file'          => 'pano-images/l.jpg',
                'default_yaw'   => 0.8053,
                'default_pitch' => -0.1565,
                'min_pitch'     => -1,
                'max_pitch'     =>  1,
                'min_yaw'       =>  -2,
                'max_yaw'       =>  2.5,
                'markers'       => [
                    ['id' => 'back-to-1', 'yaw' => 0.6799, 'pitch' => -0.0678, 'rotation' => 0.78, 'target' => 1, 'label' => ''],
                    ['id' => 'Plaque', 'yaw' => 5.9684, 'pitch' => 0.1320, 'rotation' => 0, 'target' => null, 'label' => 'Tranches de Pierres Naturelles & Granits <br> Ces plaques prêtes pour le façonnage dévoilent la beauté brute de la roche. <br> Qu\'il s\'agisse de Pierre Bleue, de granit ou de marbre, chaque tranche porte <br> les marques de son histoire géologique : veines subtiles, sédiments fossilisés <br> et variations de teintes uniques. <br> Soigneusement sélectionnées, ces tranches seront découpées et polies <br> pour donner vie à vos projets de plans de travail, appuis de fenêtre ou dallages sur-mesure.'],
                    ['id' => 'Or', 'yaw' => 1.7190, 'pitch' => -0.0928, 'rotation' => 0, 'target' => null, 'label' => 'Bloc de Pierre Bleue Belge brut <br> Ce bloc révèle toute la richesse de la pierre naturelle : <br> fossiles marins, veines minérales, cristallisations et nuances de couleurs formées <br> il y a plusieurs centaines de millions d\'années.  <br>Certaines zones peuvent également présenter des reflets dorés dus à la <br> présence de minéraux naturellement intégrés à la roche. <br> Ces particularités témoignent de l\'histoire géologique exceptionnelle de la Pierre <br> Bleue Belge et rendent chaque bloc absolument unique.'],

                ],
            ],
        ];

        return view('panorama', [
            'photo'   => $gallery[0],
            'gallery' => $gallery,
        ]);
    }
}
