<?php

namespace App\Http\Controllers\api\v1\Bookings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingCollection;
use App\Repositories\Resource\ResourceRepository;

class BookingListController extends Controller
{
    public function __construct(
        private ResourceRepository $repo,
    )
    {
        
    }



    /**
     * @OA\Get(
     *      path="/api/resources/{resourceId}/bookings",
     *      tags={"Бронирование"},
     *      summary="Просмотреть все брони указаного ресурса",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function list(int $id)
    {
        $resource = $this->repo->getById(id: $id);

        return new BookingCollection($resource->bookings);
    }
}
