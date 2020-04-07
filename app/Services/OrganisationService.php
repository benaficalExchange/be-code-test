<?php
declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use Illuminate\Support\Carbon;

/**
 * Class OrganisationService
 *
 * @package App\Services
 */
class OrganisationService
{


    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function create(array $attributes): Organisation
    {
        $organisation = Organisation::create([
                'name'          => $attributes['name'],
                'subscribed'    => $attributes['subscribed'],
                'trial_end'     => Carbon::now()->add(30, 'day'),
                'owner_user_id' => auth()->user()->id
            ]
        );
        return $organisation;
    }

    /**
     *  Query organisations and filter.
     *
     * @param null $filter
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($filter = null)
    {

        $organisations = Organisation::query();

        if ($filter == 'subbed') {
            $organisations->where('subscribed', 1);
        } elseif ($filter == 'trial') {
            $organisations->where('trial_end', '>', Carbon::now());
        }
        return $organisations->get();

    }
}
