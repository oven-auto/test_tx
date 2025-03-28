<?php

namespace App\Http\Controllers\api\v1\Bookings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingCreateRequest;
use App\Http\Resources\Booking\BookingEditResource;
use App\Repositories\Booking\BookingRepository;

class BookingController extends Controller
{
    public function __construct(
        private BookingRepository $repo,
        public $subject = 'Бронирование',
        public $genus = 'neuter'
    )
    {
        
    }



    /**
     * @OA\Post(
     *      path="/api/bookings",
     *      tags={"Бронирование"},
     *      summary="Создать бронирование",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/BookingCreateRequest",
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function store(BookingCreateRequest $request)
    {
        $booking = $this->repo->create(data: $request->validated());

        return new BookingEditResource($booking);
    }



    /**
     * @OA\Delete(
     *      path="/api/bookings/{bookingId}",
     *      tags={"Бронирование"},
     *      summary="Удалить бронирование",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function destroy(int $id)
    {
        $this->repo->delete(id: $id);

        return response()->json([
            'success' => 1,
        ]);
    }
}
