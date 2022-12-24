<?php

namespace App\Helpers;

use App\Enums\Advertisements;
use App\Models\Advertisement as AdvertModel;

/**
 * Class ServerInformation.
 */
class Advertisement
{
    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function globalBelowNav($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_JUST_BELOW_NAVBAR)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function globalAboveFooter($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_ABOVE_FOOTER)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function belowRecommended($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_HOMEPAGE_BELOW_LATEST)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function aboveRecommended($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_HOMEPAGE_IN_MIDDLE)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function comicAboveComments($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_COMIC_PAGE_ABOVE_COMMENTS)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function comicBelowDescription($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_COMIC_PAGE_BELOW_DESCRIPTION)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function comicInsideContent($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_COMIC_PAGE_INSIDE_CONTENT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function readerAboveContent($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_READER_ABOVE_CONTENT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function readerBelowContent($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_READER_BELOW_CONTENT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function readerInsideContent($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_READER_INSIDE_CONTENT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */

    public static function homepageLeft($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_HOMEPAGE_IN_LEFT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function homepageRight($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_HOMEPAGE_IN_RIGHT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }

    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function comicBelowContent($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_COMIC_PAGE_BELOW_CONTENT)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }
    /**
     * @param bool $enabled
     * @return mixed
     */
    public static function comicBelowTitle($enabled = true)
    {
        if ($enabled) {
            $advertisement = AdvertModel::where('position', Advertisements::POSITIONS_COMIC_PAGE_BELOW_TITLE)
                ->isEnabled()
                ->first();

            if (!$advertisement) {
                return '';
            }

            return $advertisement->code;
        }
    }
}
