<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poster;
use App\Models\UniqueVisitor;
use App\Models\Tag;
use App\Models\TagType;
use Carbon\Carbon;
use DB;


class StatisticsCreatorController extends Controller
{

    public function membersRegistrationGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        $datasets = [];

        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month', 'custom range'])) {
                return response()->json(['error' => 'Invalid range'], 400);
            }
            if ($range == 'day') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                $interval = 'hour';
            } elseif ($range == 'week') {
                $startDate = Carbon::today()->subDays(6)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $interval = 'day';
            } elseif ($range == 'month') {
                $startDate->startOfMonth()->startOfDay();
                $endDate->endOfDay();
                $interval = 'day';
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                if ($startDate->diffInDays($endDate) == 0) {
                    $interval = 'hour';
                } else {
                    $interval = 'day';
                }
            }
        }

        $users = User::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();
        $userCounts = $users->groupBy(function ($user) use ($interval) {
            return $interval === 'hour' ? $user->created_at->format('h a') : $user->created_at->format('Y-m-d');
        });

        $startDateCopy = $startDate->copy();
        while ($startDateCopy->lte($endDate)) {
            $date = $interval === 'hour' ? $startDateCopy->format('h a') : $startDateCopy->format('Y-m-d');
            $count = isset($userCounts[$date]) ? $userCounts[$date]->count() : 0;
            $labels[] = $date;
            $data[] = $count;

            $startDateCopy->add(1, $interval);
        }

        if ($interval == 'hour') {
            $totalDays = 1;
            $total = array_sum($data);
        } else {
            $totalDays = count($labels);
            $total = array_sum($data);
        }
        $average = $totalDays > 0 ? $total / $totalDays : 0.00;
        $average = round($average, 2);

        $pluginText = trans("cruds.registered_members.fields.num_graph");
        $xAxisText = '';
        $yAxisText = trans("cruds.registered_members.fields.count");
        $labelText = trans("cruds.registered_members.fields.graph");

        $datasets[] = [
            'label' => trans("cruds.registered_members.fields.count"),
            'data' => $data,
            'backgroundColor' => '#ff6359',
            'borderColor' => '#ff6359',
            'fill' => false,
            'borderWidth' => 0.5,
            'tension' => 0.5,
            'pointBorderColor' => "#fd463b",
            'pointBackgroundColor' => "#fd463b",
            'pointBorderWidth' => 6,
            'pointHoverRadius' => 6,
            'pointHoverBackgroundColor' => "#000000",
            'pointHoverBorderColor' => "#000000",
            'pointHoverBorderWidth' => 3,
            'pointRadius' => 1,
            'borderWidth' => 3,
            'pointHitRadius' => 30
        ];

        $html = view('statistics.creator-graph', compact('total', 'average', 'labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function visitingUsersGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        $datasets = [];

        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month', 'custom range'])) {
                return response()->json(['error' => 'Invalid range'], 400);
            }
            if ($range == 'day') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                $interval = 'hour';
            }
            if ($range == 'week') {
                $startDate = Carbon::today()->subDays(6)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $interval = 'day';
            }
            if ($range == 'month') {
                $startDate->startOfMonth()->startOfDay();
                $endDate->endOfDay();
                $interval = 'day';
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                if ($startDate->diffInDays($endDate) == 0) {
                    $interval = 'hour';
                } else {
                    $interval = 'day';
                }
            }
        }

        $visitingUsers = UniqueVisitor::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();

        $visitCounts = $visitingUsers->groupBy(function ($visit) use ($interval) {
            if ($interval === 'hour') {
                return $visit->created_at->format('h a');
            } else {
                return $visit->created_at->format('Y-m-d');
            }
        });

        $startDateCopy = $startDate->copy();

        while ($startDateCopy->lte($endDate)) {
            if ($interval === 'hour') {
                $date = $startDateCopy->format('h a');
            } else {
                $date = $startDateCopy->format('Y-m-d');
            }

            $count = isset($visitCounts[$date]) ? $visitCounts[$date]->count() : 0;

            $labels[] = $date;
            $data[] = $count;

            $startDateCopy->add(1, $interval);
        }

        if ($interval == 'hour') {
            $totalDays = 1;
            $total = array_sum($data);
        } else {
            $totalDays = count($labels);
            $total = array_sum($data);
        }
        $average = $totalDays > 0 ? $total / $totalDays : 0.00;
        $average = round($average, 2);

        $pluginText = trans("cruds.visiting_users.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.visiting_users.fields.count");
        $labelText =  trans("cruds.visiting_users.fields.graph");

        $datasets[] = [
            'label' => trans("cruds.visiting_users.fields.count"),
            'data' => $data,
            'backgroundColor' => '#ff6359',
            'borderColor' => '#ff6359',
            'fill' => false,
            'borderWidth' => 0.5,
            'tension' => 0.5,
            'pointBorderColor' => "#fd463b",
            'pointBackgroundColor' => "#fd463b",
            'pointBorderWidth' => 6,
            'pointHoverRadius' => 6,
            'pointHoverBackgroundColor' => "#000000",
            'pointHoverBorderColor' => "#000000",
            'pointHoverBorderWidth' => 3,
            'pointRadius' => 1,
            'borderWidth' => 3,
            'pointHitRadius' => 30
        ];

        $html = view('statistics.creator-graph', compact('total', 'average', 'labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function mobileAccessGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        $datasets = [];

        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month', 'custom range'])) {
                return response()->json(['error' => 'Invalid range'], 400);
            }
            if ($range == 'day') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                $interval = 'hour';
            }
            if ($range == 'week') {
                $startDate = Carbon::today()->subDays(6)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $interval = 'day';
            }
            if ($range == 'month') {
                $startDate->startOfMonth()->startOfDay();
                $endDate->endOfDay();
                $interval = 'day';
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                if ($startDate->diffInDays($endDate) == 0) {
                    $interval = 'hour';
                } else {
                    $interval = 'day';
                }
            }
        }

        $mobilesAccess = UniqueVisitor::whereBetween('created_at', [$startDate, $endDate])->where('device_name', 0)->orderBy('created_at')->get();

        $accessCounts = $mobilesAccess->groupBy(function ($access) use ($interval) {
            if ($interval === 'hour') {
                return $access->created_at->format('h a');
            } else {
                return $access->created_at->format('Y-m-d');
            }
        });

        $startDateCopy = $startDate->copy();

        while ($startDateCopy->lte($endDate)) {
            if ($interval === 'hour') {
                $date = $startDateCopy->format('h a');
            } else {
                $date = $startDateCopy->format('Y-m-d');
            }

            $count = isset($accessCounts[$date]) ? $accessCounts[$date]->count() : 0;

            $labels[] = $date;
            $data[] = $count;

            $startDateCopy->add(1, $interval);
        }

        if ($interval == 'hour') {
            $totalDays = 1;
            $total = array_sum($data);
        } else {
            $totalDays = count($labels);
            $total = array_sum($data);
        }

        $average = $totalDays > 0 ? $total / $totalDays : 0.00;
        $average = round($average, 2);

        $pluginText = trans("cruds.mobile_access.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.mobile_access.fields.count");
        $labelText =  trans("cruds.mobile_access.fields.graph");


        $datasets[] = [
            'label' => trans("cruds.mobile_access.fields.count"),
            'data' => $data,
            'backgroundColor' => '#ff6359',
            'borderColor' => '#ff6359',
            'fill' => false,
            'borderWidth' => 0.5,
            'tension' => 0.5,
            'pointBorderColor' => "#fd463b",
            'pointBackgroundColor' => "#fd463b",
            'pointBorderWidth' => 6,
            'pointHoverRadius' => 6,
            'pointHoverBackgroundColor' => "#000000",
            'pointHoverBorderColor' => "#000000",
            'pointHoverBorderWidth' => 3,
            'pointRadius' => 1,
            'borderWidth' => 3,
            'pointHitRadius' => 30
        ];

        $html = view('statistics.creator-graph', compact('total', 'average', 'labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function numberPostsGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        $datasets = [];
        $tagTypes = $request->has('tagTypes') ? $request->input('tagTypes') : null;
        $colors = ['#00ff00', '#0000ff', '#fc0b03', '#605f6b', '#1e1b42', '#421b3d', '#ff0000'];

        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month', 'custom range'])) {
                return response()->json(['error' => 'Invalid range'], 400);
            }
            if ($range == 'day') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                $interval = 'hour';
            } elseif ($range == 'week') {
                $startDate = Carbon::today()->subDays(6)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $interval = 'day';
            } elseif ($range == 'month') {
                $startDate->startOfMonth()->startOfDay();
                $endDate->endOfDay();
                $interval = 'day';
            }
        } else {
            if ($request->range == 'custom range') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                if ($startDate->diffInDays($endDate) == 0) {
                    $interval = 'hour';
                } else {
                    $interval = 'day';
                }
            }
        }

        $posts = Poster::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();
        $postCounts = $posts->groupBy(function ($access) use ($interval) {
            if ($interval === 'hour') {
                return $access->created_at->format('h a');
            } else {
                return $access->created_at->format('Y-m-d');
            }
        });


        $startDateCopy = $startDate->copy();
        while ($startDateCopy->lte($endDate)) {
            if ($interval === 'hour') {
                $date = $startDateCopy->format('h a');
            } else {
                $date = $startDateCopy->format('Y-m-d');
            }
            $count = isset($postCounts[$date]) ? $postCounts[$date]->count() : 0;
            $labels[] = $date;
            $data[] = $count;
            $startDateCopy->add(1, $interval);
        }

        // avg
        if ($interval == 'hour') {
            $totalDays = 1;
            $total = array_sum($data);
        } else {
            $totalDays = count($labels);
            $total = array_sum($data);
        }
        $average = $totalDays > 0 ? $total / $totalDays : 0.00;
        $average = round($average, 2);

        $pluginText = trans("cruds.number_of_posts.fields.num_graph");
        $xAxisText = '';
        $yAxisText = trans("cruds.number_of_posts.fields.count");
        $labelText = trans("cruds.number_of_posts.fields.graph");

        $datasets[0] = [
            'label' => trans("cruds.number_of_posts.fields.count"),
            'data' => $data,
            'backgroundColor' => '#ff6359',
            'borderColor' => '#ff6359',
            'fill' => false,
            'borderWidth' => 0.5,
            'tension' => 0.5,
            'pointBorderColor' => "#fd463b",
            'pointBackgroundColor' => "#fd463b",
            'pointBorderWidth' => 6,
            'pointHoverRadius' => 6,
            'pointHoverBackgroundColor' => "#000000",
            'pointHoverBorderColor' => "#000000",
            'pointHoverBorderWidth' => 3,
            'pointRadius' => 1,
            'borderWidth' => 3,
            'pointHitRadius' => 30
        ];

        if ($tagTypes != null) {
            $colorIndex = 0;
            foreach ($tagTypes as $key => $tagType) {
                $dataCount = [];
                $tagIds = Tag::where('tag_type', $tagType)->pluck('id')->toArray();

                // Fetch posts using raw query to match tags correctly
                $tagTypeCount = Poster::whereBetween('created_at', [$startDate, $endDate])
                    ->where(function ($query) use ($tagIds) {
                        foreach ($tagIds as $tagId) {
                            $query->orWhereRaw('FIND_IN_SET(?, tags)', [$tagId]);
                        }
                    })
                    ->get();


                $tagTypePostCounts = $tagTypeCount->groupBy(function ($post) use ($interval) {
                    return $interval === 'hour' ? $post->created_at->format('Y-m-d H:00:00') : $post->created_at->format('Y-m-d');
                });

                $startDateCopy = $startDate->copy();
                while ($startDateCopy->lte($endDate)) {
                    $date = $interval === 'hour' ? $startDateCopy->format('Y-m-d H:00:00') : $startDateCopy->format('Y-m-d');
                    $count = isset($tagTypePostCounts[$date]) ? $tagTypePostCounts[$date]->count() : 0;
                    $dataCount[] = $count;
                    $startDateCopy->add(1, $interval === 'hour' ? 'hour' : 'day');
                }

                $getName = TagType::where('id', $tagType)->first();
                $tagTypeName = app()->getLocale() == 'en' ? $getName->name_en : $getName->name_ch;

                $datasets[$key + 1] = [
                    'label' => $tagTypeName,
                    'data' => $dataCount,
                    'backgroundColor' => $colors[$colorIndex],
                    'borderColor' => $colors[$colorIndex],
                    'fill' => false,
                    'borderWidth' => 1,
                    'tension' => 0.5,
                    'pointBorderColor' => "#fd463b",
                    'pointBackgroundColor' => "#fd463b",
                    'pointBorderWidth' => 6,
                    'pointHoverRadius' => 6,
                    'pointHoverBackgroundColor' => "#000000",
                    'pointHoverBorderColor' => "#000000",
                    'pointHoverBorderWidth' => 3,
                    'pointRadius' => 1,
                    'borderWidth' => 3,
                    'pointHitRadius' => 30
                ];
                $colorIndex++;
            }
        }
        $html = view('statistics.creator-graph', compact('total', 'average', 'labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function popularPostersGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $tagTypes = $request->has('tagTypes') ? $request->input('tagTypes') : null;
        $filterType = $request->has('filterType') ? $request->filterType  : 'visited';
        $data = [];
        $labels = [];
        $datasets = [];
        $colors = ['#00ff00', '#0000ff', '#fc0b03', '#605f6b', '#1e1b42', '#421b3d', '#ff0000'];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if ($range == 'day') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                $interval = 'hour';
            }
            if ($range == 'week') {
                if(isset($request->isCustomWeek)){
                    $startDate->startOfDay();
                    $endDate->endOfDay();
                    $interval = 'day';
                }else{  
                    $startDate = Carbon::today()->subDays(6)->startOfDay();
                    $endDate = $endDate->endOfDay();
                    $interval = 'day';
                }
            }
            if ($range == 'month') {
                $startDate->startOfMonth()->startOfDay();
                $endDate->endOfDay();
                $interval = 'day';
            }
        } else {
            if ($request->range == 'custom range') {
                $startDate->startOfDay();
                $endDate->endOfDay();
                if ($startDate->diffInDays($endDate) == 0) {
                    $interval = 'hour';
                } else {
                    $interval = 'day';
                }
            }
        }

        $interval = $startDate->diffInDays($endDate) == 0 ? 'hour' : 'day';
        $popularPostersCounts = [];
        $queryDateFormat = $interval === 'hour' ? "%Y-%m-%d %H:00:00" : "%Y-%m-%d";
        if ($filterType == 'visited') {
            $popularPostersCounts = DB::table(DB::raw('(
                SELECT
                    DATE_FORMAT(poster_read_counts.created_at, "' . $queryDateFormat . '") AS createddate,
                    COUNT(poster_read_counts.poster_id) AS poster_count
                FROM
                    poster_read_counts
                INNER JOIN
                    posters ON poster_read_counts.poster_id = posters.id
                INNER JOIN
                    tags ON FIND_IN_SET(tags.id, posters.tags) > 0 AND tags.tag_type = ' . $tagTypes . '
                WHERE
                    poster_read_counts.created_at BETWEEN :start_date AND :end_date
                GROUP BY
                    createddate
                ORDER BY
                    createddate ASC
            ) AS subquery_alias'))
                ->setBindings([
                    'start_date' => $startDate->format('Y-m-d H:i:s'),
                    'end_date' => $endDate->format('Y-m-d H:i:s')
                ])
                ->pluck('poster_count', 'createddate');
        } else if ($filterType == 'purchased') {
            $popularPostersCounts = DB::table(DB::raw('(
                SELECT
                    DATE_FORMAT(user_episodes.created_at, "' . $queryDateFormat . '") AS createddate,
                    COUNT(user_episodes.poster_id) AS poster_count
                FROM
                    user_episodes
                INNER JOIN
                    posters ON user_episodes.poster_id = posters.id
                WHERE
                user_episodes.created_at BETWEEN :start_date AND :end_date
                GROUP BY
                    createddate
                ORDER BY
                    createddate ASC
            ) AS subquery_alias'))
                ->setBindings([
                    'start_date' => $startDate->format('Y-m-d H:i:s'),
                    'end_date' => $endDate->format('Y-m-d H:i:s')
                ])
                ->pluck('poster_count', 'createddate');
        }

        // Populate data and labels arrays
        $startDateCopy = $startDate->copy();
        while ($startDateCopy->lte($endDate)) {
            $date = $interval === 'hour' ? $startDateCopy->format('Y-m-d H:00:00') : $startDateCopy->format('Y-m-d');
            $count = $popularPostersCounts[$date] ?? 0;
            $labels[] = $interval === 'hour' ? $startDateCopy->format('h A') : $date;
            $data[] = $count;
            $startDateCopy->add(1, $interval);
        }

        //avg
        if ($interval == 'hour') {
            $totalDays = 1;
            $total = array_sum($data);
        } else {
            $totalDays = count($labels);
            $total = array_sum($data);
        }
        $average = $totalDays > 0 ? $total / $totalDays : 0.00;
        $average = round($average, 2);

        // Set plugin text, axis text, and label text
        $pluginText = trans("cruds.most_popular_poster.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.most_popular_poster.fields.count");
        $labelText =  trans("cruds.most_popular_poster.fields.graph");

        // Define dataset
        $datasets[] = [
            'label' => trans("cruds.most_popular_poster.fields.count"),
            'data' => $data,
            'backgroundColor' => '#ff6359',
            'borderColor' => '#ff6359',
            'fill' => false,
            'borderWidth' => 0.5,
            'tension' => 0.5,
            'pointBorderColor' => "#fd463b",
            'pointBackgroundColor' => "#fd463b",
            'pointBorderWidth' => 6,
            'pointHoverRadius' => 6,
            'pointHoverBackgroundColor' => "#000000",
            'pointHoverBorderColor' => "#000000",
            'pointHoverBorderWidth' => 3,
            'pointRadius' => 1,
            'borderWidth' => 3,
            'pointHitRadius' => 30
        ];
        // Render the view and return JSON response
        $html = view('statistics.creator-graph', compact('total', 'average', 'labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }
}
