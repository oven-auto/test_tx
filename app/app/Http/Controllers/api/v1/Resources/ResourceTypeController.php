<?php

namespace App\Http\Controllers\api\v1\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceType\ResourceTypeCreateRequest;
use App\Http\Resources\ResourceType\ResourceTypeCollection;
use App\Repositories\ResourceType\ResourcesTypeRepository;
use App\Http\Resources\ResourceType\ResourceTypeEditResource;

class ResourceTypeController extends Controller
{
    public function __construct(
        private ResourcesTypeRepository $repo,
        public $genus = 'male',
        public $subject = 'Тип ресурса',
    )
    {
        
    }



    /**
     * @OA\Get(
     *      path="/api/resourcetypes",
     *      tags={"Типы ресурсов"},
     *      summary="Список типов ресурсов",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function index()
    {
        $types = $this->repo->getAll();

        return new ResourceTypeCollection($types);
    }



    /**
     * @OA\Post(
     *      path="/api/resourcetypes",
     *      tags={"Типы ресурсов"},
     *      summary="Создать тип ресурса",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ResourceTypeCreateRequest",
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
    public function store(ResourceTypeCreateRequest $request)
    {
        $type = $this->repo->create(data: $request->validated());

        return new ResourceTypeEditResource($type);
    }



    /**
     * @OA\Patch(
     *      path="/api/resourcetypes/{resourceTypeId}",
     *      tags={"Типы ресурсов"},
     *      summary="Изменить тип ресурса",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ResourceTypeCreateRequest",
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
    public function update(int $id, ResourceTypeCreateRequest $request)
    {
        $type = $this->repo->update(id: $id, data: $request->validated());

        return new ResourceTypeEditResource($type);
    }



    /**
     * @OA\Get(
     *      path="/api/resourcetypes/{resourceTypeId}",
     *      tags={"Типы ресурсов"},
     *      summary="Открыть тип ресурса",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function show(int $id)
    {
        $type = $this->repo->getById(id: $id);

        return new ResourceTypeEditResource($type);
    }
}
