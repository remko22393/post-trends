<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    /**
     * @var $url -- JSON Data Source URL
     */
    public static $url = 'https://www.instagram.com/kicksta.co/?__a=1';


    /**
     * Get the best & worst posts details with engagement scores.
     *
     * Engagement Score Calculation:
     * ===
     * 1 like = 1 point
     * 1 comment = 2 points
     * Engagement score = like points + comment points
     * ===
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Start Date of a given period -- current/last week or current/last month
        $period = $request->input('period', '1w');
        $lastDayOfLastMonth = new Carbon('last day of last month');
        switch ($period) {
            case '1w':
                $startDate = Carbon::now()->startOfWeek()->timestamp;
                break;
            case '1m':
                $startDate = Carbon::now()->firstOfMonth()->timestamp;
                break;
            case '1pw':
                $startDate = $lastDayOfLastMonth->startOfWeek()->timestamp;
                break;
            case '1pm':
                $startDate = $lastDayOfLastMonth->firstOfMonth()->timestamp;
                break;
            default:
                $startDate = Carbon::now()->startOfWeek()->timestamp;
                break;
        }

        // Handle JSON data source
        $data = self::handle();
        $username = $data['graphql']['user']['username'];
        $fullname = $data['graphql']['user']['full_name'];

        $postsCnt = $data['graphql']['user']['edge_owner_to_timeline_media']['count'];
        $followersCnt = $data['graphql']['user']['edge_followed_by']['count'];
        $followingCnt = $data['graphql']['user']['edge_follow']['count'];

        Log::info('Username: ' . print_r($username, true));
        Log::info('Full Name: ' . print_r($fullname, true));
        Log::info('Summary: ' . print_r([
                $postsCnt . ' posts',
                $followersCnt . ' followers',
                $followingCnt . ' following',
            ], true));

        $ownerEdges = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'];
        $bestPost = null;
        $worstPost = null;

        foreach($ownerEdges as $edge) {
            $aPost = [];

            $aPost['thumbnail'] = $edge['node']['thumbnail_src'];
            $aPost['likes_cnt'] = $edge['node']['edge_liked_by']['count'];
            $aPost['comments_cnt'] = $edge['node']['edge_media_to_comment']['count'];
            $aPost['engagement_score'] = 1 * $aPost['likes_cnt'] + 2 * $aPost['comments_cnt'];
            $aPost['taken_at'] = Carbon::createFromTimeStamp($edge['node']['taken_at_timestamp'])->toFormattedDateString();
            $aPost['taken_at_timestamp'] = $edge['node']['taken_at_timestamp'];

            // Highest engagement score = best, lowest engagement score = worst
            if ($aPost['taken_at_timestamp'] >= $startDate) {
                $bestPost = $bestPost == null ? $aPost : $bestPost;
                $bestPost = $bestPost['engagement_score'] >= $aPost['engagement_score'] ? $bestPost : $aPost;

                $worstPost = $worstPost == null ? $aPost : $worstPost;
                $worstPost = $worstPost['engagement_score'] <= $aPost['engagement_score'] ? $worstPost : $aPost;
            }
        }

        $posts = [
            'best_post' => $bestPost,
            'worst_post' => $worstPost
        ];

        Log::info('Posts Details: ' . print_r($posts, true));

        return response()->json($posts, 200);
    }


    /**
     * Handle the api request payloads.
     *
     * @return mixed|null
     */
    public static function handle()
    {
        try {
            $client = new Client();

            $response = $client->get(self::$url);

            $output = $response->getBody()->getContents();

            $result = json_decode($output, true, 512, JSON_OBJECT_AS_ARRAY);

//            Log::info(print_r($result, true));

            return $result;

        } catch (ClientException $ex) {

            Log::error(print_r($ex->getMessage(), true));

            return null;

        }
    }
}
