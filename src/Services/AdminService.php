<?php

namespace App\Services;

class AdminService
{
    public const CONTRACTCV = [
        'CDI' => 1,
        'CDD' => 2,
        'Stage' => 3,
        'Alternance' => 4
    ];

    public const CONTRACTTYPE = [
        'Alternance 1 an' => 1,
        'Alternance 2 ans' => 2,
        'Stage 2 mois' => 3,
        'Stage 4 mois' => 4,
        'Stage 6 mois' => 5,
    ];

    public const FIELDOFACTIVITY = [
        'Aéronautique et Espace' => 1,
        'Agriculture' => 2,
        'Agroalimentaire' => 3,
        'Artisanat' => 4,
        'Audiovisuel, Cinéma' => 5,
        'Audit, Comptabilité, Gestion' => 6,
        'Automobile' => 7,
        'Banque, Assurance' => 8,
        'Bâtiment, Travaux Publics' => 9,
        'Biologie, Chimie, Pharmacie' => 10,
        'Commerce, Distribution' => 11,
        'Communication' => 12,
        "Création, Métiers D'art" => 13,
        "Culture, Patrimoine" => 14,
        'Défense, Sécurité, Armée' => 15,
        'Documentation, Bibliothèque' => 16,
        'Droit' => 17,
        'Edition, Livre' => 18,
        'Enseignement' => 19,
        'Environnement' => 20,
        'Ferroviaire' => 21,
        'Foires, Salons et Congrès' => 22,
        'Fonction Publique' => 23,
        'Hôtellerie, Restauration' => 24,
        'Humanitaire' => 25,
        'Immobilier' => 26,
        'Industrie' => 27,
        'Informatique, Télécoms, Web' => 28,
        'Jeu Vidéo' => 29,
        'Journaliste' => 30,
        'Langues' => 31,
        'Luxe' => 32,
        'Marketing, Publicité' => 33,
        'Médical' => 34,
        'Mode' => 35,
        'Textile' => 36,
        'Paramédical' => 37,
        'Propreté et Services Associés' => 38,
        'Psychologie' => 39,
        'Ressources Humaines' => 40,
        'Sciences Humaines et Sociales' => 41,
        'Secrétariat' => 42,
        'Social' => 43,
        'Spectacle et Métiers de la Scène' => 44,
        'Sport' => 45,
        'Tourisme' => 46,
        'Transport, Logistique' => 47,
    ];
}
