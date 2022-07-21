<?php

namespace App\Enums;

class Advertisements
{
    // Positions
    const POSITIONS_JUST_BELOW_NAVBAR = 'just-below-navbar';

    const POSITIONS_ABOVE_FOOTER = 'above-footer';

    const POSITIONS_HOMEPAGE_BELOW_LATEST= 'homepage-below-latest';

    const POSITIONS_HOMEPAGE_IN_MIDDLE = 'homepage-in-middle';

    const POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION = 'comic-page-below-description';

    const POSITIONS_COMIC_PAGE_ABOVE_COMMENTS = 'comic-page-above-comments';

    // Global
    const GLOBAL = [
        [
            'name' => 'Global - Below Navigation',
            'description' => 'At the top of every page, under the navigation.',
            'position' => self::POSITIONS_JUST_BELOW_NAVBAR,
        ],
        [
            'name' => 'Global - Above Footer',
            'description' => 'At the bottom of every page, above the footer.',
            'position' => self::POSITIONS_ABOVE_FOOTER,
        ],
    ];

    // Homepage
    const HOMEPAGE = [
        [
            'name' => 'Homepage - Below Recommended',
            'description' => 'On the Homepage, under the recommended comics.',
            'position' => self::POSITIONS_HOMEPAGE_BELOW_LATEST,
        ],
        [
            'name' => 'Homepage - Above Comments',
            'description' => 'On the Homepage, above the comments.',
            'position' => self::POSITIONS_HOMEPAGE_IN_MIDDLE,
        ],
    ];

    // Comic Detailed View
    const COMIC_DETAIL = [
        [
            'name' => 'Comic Detailed View - Below Description',
            'description' => 'On the Comic Detailed View, below the description.',
            'position' => self::POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION,
        ],
        [
            'name' => 'Comic Detailed View - Above Comments',
            'description' => 'On the Comic Detailed View, above the comments.',
            'position' => self::POSITIONS_COMIC_PAGE_ABOVE_COMMENTS,
        ],
    ];
}
