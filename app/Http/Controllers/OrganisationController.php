<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrganisationRequest;
use App\Http\Requests\ListAllOrganisationRequest;
use App\Mail\user\OrganisationCreated;
use App\Organisation;
use App\Services\OrganisationService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{


    /**
     * Creates and attaches a Organisation to the current user.
     *
     * @param CreateOrganisationRequest $request
     * @param OrganisationService       $service
     * @return JsonResponse
     */
    public function create(CreateOrganisationRequest $request, OrganisationService $service)
    {

        $user = auth()->user();

        $organisation = $service->createOrganisation($request->all());

        Mail::to($user->email)->send(new OrganisationCreated($user));

        return $this
            ->transformItem('organisation', $organisation, 'user')
            ->respond();

    }
    

    /**
     * Get all Organisations. The param 'filter'
     * can be passed as 'subbed', 'trial' or 'all'.
     *
     * @param ListAllOrganisationRequest $request
     * @param OrganisationService        $service
     * @return JsonResponse
 */
    public function listAll(ListAllOrganisationRequest $request, OrganisationService $service)
    {
        $organisations = $service->getAll($request->get('filter'));

        return $this
            ->transformCollection('organisations',$organisations,['user'])
            ->respond();
    }
}
