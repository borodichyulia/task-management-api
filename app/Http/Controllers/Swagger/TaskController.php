<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/tasks",
 *     summary="Adds a new task",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title", type="string", example="Task name"),
 *                     @OA\Property(property="description", type="string", example="Task description"),
 *                     @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="description", type="string", example="Task description"),
 *             @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *             @OA\Property(property="created_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *             @OA\Property(property="updated_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *    path="/api/tasks",
 *    summary="Get all tasks",
 *    tags={"Task"},
 *    security={{ "bearerAuth": {} }},
 *
 *    @OA\Response(
 *        response=200,
 *        description="OK",
 *        @OA\JsonContent(
 *            @OA\Property(property="data", type="array",
 *                @OA\Items(
 *                    @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="description", type="string", example="Task description"),
 *                    @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *                    @OA\Property(property="created_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *                    @OA\Property(property="updated_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *                )
 *            )
 *        )
 *    )
 *),
 *
 * @OA\Get(
 *     path="/api/tasks/{task}",
 *     summary="Get task by id",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Task id",
 *         in="path",
 *         name="task",
 *         required=true,
 *         example=1,
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="description", type="string", example="Task description"),
 *                 @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *                 @OA\Property(property="created_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Put(
 *      path="/api/tasks/{task}",
 *      summary="Update task by id",
 *      tags={"Task"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Parameter(
 *          description="Task id",
 *          in="path",
 *          name="task",
 *          required=true,
 *          example=2,
 *      ),
 *
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="title", type="string", example="Task name"),
 *                      @OA\Property(property="description", type="string", example="Task description"),
 *                      @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *                  )
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="description", type="string", example="Task description"),
 *                  @OA\Property(property="status", type="string", enum={"pending", "in_progress", "done"}, example="pending"),
 *                  @OA\Property(property="created_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *                  @OA\Property(property="updated_at", type="string", example="2025-10-24T08:46:16.000000Z"),
 *              )
 *          )
 *      )
 *  ),
 *
 * @OA\Delete(
 *     path="/api/tasks/{task}",
 *     summary="Delete task by id",
 *     tags={"Task"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Task id",
 *         in="path",
 *         name="task",
 *         required=true,
 *         example=3,
 *     ),
 *
 *     @OA\Response(
 *         response=204,
 *         description="No Content",
 *     )
 * ),
 */
class TaskController extends Controller
{
    //
}
