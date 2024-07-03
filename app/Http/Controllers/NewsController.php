<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Response;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
        /**
     * @OA\Get(
    
     * 
     *      path="/api/news/list_news",
     *      operationId="list_news",
     *      tags={"News"},
     *      summary="Get list news",
     *      description="Returns list news information",
     *    
     *      @OA\Parameter(
     *         description="page of news to return",
     *         in="query",
     *         name="page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="limit of news to return",
     *         in="query",
     *         name="limit",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *    
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     * 
     *     
     * )
     */
    public function list_news(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $limit = $request->limit ?? 10;

            
            $query = News::where('is_show', 1);

            // Paginate the results
            $news = $query->paginate($limit, ['*'], 'page', $page);
            return Response::json(true, 'Get list news successfully', $news->items(), [
                'current_page' => $news->currentPage(),
                'last_page' => $news->lastPage(),
                'per_page' => $news->perPage(),
                'total' => $news->total(),
                'next_page_url' => $news->nextPageUrl(),
                'prev_page_url' => $news->previousPageUrl(),
            ]);
        } catch (Exception $e) {
            return Response::json(false, 'An error occurred while listing news', $e->getMessage());
        }
    }



    /**
 * @OA\Get(

 * 
 *      path="/api/news/{slug}",
 *      operationId="get news detail",
 *      tags={"News"},
 *      summary="Get News Information",
 *      description="Returns news information",
 *    @OA\Parameter(
*          name="slug",
*          description="News slug",
*          required=true,
*          in="path",
*          @OA\Schema(
*              type="string"
*          )
*      ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid ID supplied"
 *     ),
 * 
 *     
 * )
 */
    public function news_detail($slug)
    {
        try {
            if (!$slug) {
                return Response::json(false, 'Missing parameters Slug', null);
            }


            $news = News::where('slug', $slug)
                ->with(['user'])
                ->first();

            if (!$news) {
                return Response::json(false, 'News not found', null);
            }

            return Response::json(true, 'Get news detail successfully', $news);

        } catch (Exception $e) {
            return Response::json(false, 'An error occurred while getting news detail', $e->getMessage());
        }
    }
}
