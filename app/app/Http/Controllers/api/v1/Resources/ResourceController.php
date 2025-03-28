<?php

namespace App\Http\Controllers\api\v1\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\ResourceCreateRequest;
use App\Http\Resources\Resource\ResourceEditResource;
use App\Http\Resources\Resource\ResourceCollection;
use App\Repositories\Resource\ResourceRepository;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function __construct(
        private ResourceRepository $repo,
        public $genus = 'male',
        public $subject = 'Ресурс'
    )
    {
        
    }



    /**
     * @OA\Get(
     *      path="/api/resources",
     *      tags={"Ресурсы"},
     *      summary="Список ресурсов",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function index(Request $request)
    {
        $resources = $this->repo->getAll();

        return new ResourceCollection($resources);
    }



    /**
     * @OA\Post(
     *      path="/api/resources",
     *      tags={"Ресурсы"},
     *      summary="Создать ресурс",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ResourceCreateRequest",
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
    public function store(ResourceCreateRequest $request)
    {
        $resource = $this->repo->create(data: $request->validated());

        return new ResourceEditResource($resource);
    }
}
