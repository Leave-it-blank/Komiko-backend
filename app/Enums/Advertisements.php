<?php

namespace App\Enums;

class Advertisements
{
    // Positions
    const POSITIONS_JUST_BELOW_NAVBAR = 'just-below-navbar';
    const POSITIONS_ABOVE_FOOTER = 'above-footer';

    //Reader

    const POSITIONS_READER_ABOVE_CONTENT = 'reader-above-content';
    const POSITIONS_READER_BELOW_CONTENT = 'reader-below-content';
    const POSITIONS_READER_INSIDE_CONTENT = 'reader-inside-content';

    //Homepage
    const POSITIONS_HOMEPAGE_BELOW_LATEST = 'homepage-below-latest';
    const POSITIONS_HOMEPAGE_IN_MIDDLE = 'homepage-in-middle';
    const POSITIONS_HOMEPAGE_IN_LEFT = 'homepage-in-left';
    const POSITIONS_HOMEPAGE_IN_RIGHT = 'homepage-in-right';


    //comic
    const POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION = 'comic-page-below-description';  //1
    const POSITIONS_COMIC_PAGE_ABOVE_COMMENTS = 'comic-page-above-comments'; //2
    const POSITIONS_COMIC_PAGE_INSIDE_CONTENT = 'comic-page-inside-content'; //3
    const POSITIONS_COMIC_PAGE_BELOW_CONTENT = 'comic-page-below-content'; //4
    const POSITIONS_COMIC_PAGE_BELOW_TITLE = 'comic-page-below-title'; //5


    // Global
    const GLOBAL = [
        [
            'name' => 'Global - Below Navigation',
            'description' => 'At the top of every page, under the navigation.',
            'position' => self::POSITIONS_JUST_BELOW_NAVBAR,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_JUST_BELOW_NAVBAR . '</div>'
        ],
        [
            'name' => 'Global - Above Footer',
            'description' => 'At the bottom of every page, above the footer.',
            'position' => self::POSITIONS_ABOVE_FOOTER,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_ABOVE_FOOTER . '</div>',
        ],
    ];

    // Reader
    const READER = [
        [
            'name' => 'Reader - Above Content',
            'description' => 'On the Reader, above the content.',
            'position' => self::POSITIONS_READER_ABOVE_CONTENT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_READER_ABOVE_CONTENT . '</div>',
        ],
        [
            'name' => 'Reader - Below Content',
            'description' => 'On the Reader, below the content.',
            'position' => self::POSITIONS_READER_BELOW_CONTENT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_READER_BELOW_CONTENT . '</div>',
        ],
        [
            'name' => 'Reader - Inside Content',
            'description' => 'On the Reader, inside the content.',
            'position' => self::POSITIONS_READER_INSIDE_CONTENT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_READER_INSIDE_CONTENT . '</div>',
        ],
    ];

    // Homepage
    const HOMEPAGE = [
        [
            'name' => 'Homepage - Below Recommended BELOW_LATEST',
            'description' => 'On the Homepage, under the recommended comics.',
            'position' => self::POSITIONS_HOMEPAGE_BELOW_LATEST,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_HOMEPAGE_BELOW_LATEST . '</div>',
        ],
        [
            'name' => 'Homepage - Above Comments IN_MIDDLE',
            'description' => 'On the Homepage, above the comments.',
            'position' => self::POSITIONS_HOMEPAGE_IN_MIDDLE,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_HOMEPAGE_IN_MIDDLE . '</div>',
        ],
        [
            'name' => 'Homepage -  ASIDE CONTENT IN_LEFT',
            'description' => 'On the Homepage, aside content left.',
            'position' => self::POSITIONS_HOMEPAGE_IN_LEFT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_HOMEPAGE_IN_LEFT . '</div>',
        ],
        [
            'name' => 'Homepage - ASIDE CONTENT IN_RIGHT',
            'description' => 'On the Homepage, aside content Right.',
            'position' => self::POSITIONS_HOMEPAGE_IN_RIGHT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_HOMEPAGE_IN_RIGHT . '</div>',
        ],
    ];

    // Comic Detailed View
    const COMIC_DETAIL = [
        [
            'name' => 'Comic Detailed View - Below Description',
            'description' => 'On the Comic Detailed View, below the description.',
            'position' => self::POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION . '</div>'
        ],
        [
            'name' => 'Comic Detailed View - Above Comments',
            'description' => 'On the Comic Detailed View, above the comments.',
            'position' => self::POSITIONS_COMIC_PAGE_ABOVE_COMMENTS,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_COMIC_PAGE_ABOVE_COMMENTS . '</div>'
        ],
        [
            'name' => 'Comic Detailed View - Inside Content',
            'description' => 'On the Comic Detailed View, inside content.',
            'position' => self::POSITIONS_COMIC_PAGE_INSIDE_CONTENT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_COMIC_PAGE_INSIDE_CONTENT . '</div>'
        ],
        [
            'name' => 'Comic Detailed View - Below Content',
            'description' => 'On the Comic Detailed View, below content.',
            'position' => self::POSITIONS_COMIC_PAGE_BELOW_CONTENT,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_COMIC_PAGE_BELOW_CONTENT . '</div>'
        ],
        [
            'name' => 'Comic Detailed View - Below Title',
            'description' => 'On the Comic Detailed View, below title.',
            'position' => self::POSITIONS_COMIC_PAGE_BELOW_TITLE,
            'code' => '<div class="w-full bg-blue-500 h-20 ">' . self::POSITIONS_COMIC_PAGE_BELOW_TITLE . '</div>'
        ],

    ];
}
