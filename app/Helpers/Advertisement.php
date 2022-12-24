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
}
