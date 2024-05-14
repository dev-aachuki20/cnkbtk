<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poster;
use App\Models\UniqueVisitor;
use App\Models\PosterReadCount;
use App\Models\Tag;
use App\Models\TagType;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{

    public function index()
    {
        $tagTypes = TagType::all();
        $user = Auth::user();
        if ($user->role_id == config("constant.role.admin")) {
            return view('site-statistics', compact('tagTypes'));
        } elseif ($user->role_id == config("constant.role.creator")) {
            return view('site-statistics-creator', compact('tagTypes'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
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

            $users = User::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();
            $userCounts = $users->groupBy(function ($user) use ($interval) {
                if ($interval === 'hour') {
                    return $user->created_at->format('h a');
                } else {
                    return $user->created_at->format('Y-m-d');
                }
            });

            $startDateCopy = $startDate->copy();
            while ($startDateCopy->lte($endDate)) {
                if ($interval === 'hour') {
                    $date = $startDateCopy->format('h a');
                } else {
                    $date = $startDateCopy->format('Y-m-d');
                }
                $count = isset($userCounts[$date]) ? $userCounts[$date]->count() : 0;
                $labels[] = $date;
                $data[] = $count;

                $datasets[0] = [
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMembersRegistrationGraph($monthlyDateRanges, $startDate, $endDate, 'day');
            }
        }

        // list($labels, $data) = $this->calculateAverage($labels, $data);
        $averageData = $this->calculateAverage($labels, $data);
        $labels = $averageData['labels'];
        $data = $averageData['data'];

        // Add average data to datasets
        $datasets[] = [
            'label' => 'Average',
            'data' => [$averageData['data'][count($averageData['data']) - 1]],
            'backgroundColor' => '#000000',
            'borderColor' => '#000000',
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

        $pluginText = trans("cruds.registered_members.fields.num_graph");
        // $xAxisText =  trans("cruds.registered_members.fields.time");
        $xAxisText = '';
        $yAxisText =  trans("cruds.registered_members.fields.count");
        $labelText =  trans("cruds.registered_members.fields.graph");

        $html = view('statistics.graph', compact('labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function numberPostsGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();

        $tagTypes = $request['tag_type'];
        $interval = 'week';
        $labels = [];
        $data = [];
        $datasets = [];
        // $colors = $this->generateColors(count($tagTypes));
        $colors = ['#ff0000', '#00ff00', '#0000ff'];
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
            $posts = Poster::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();

            $postCounts = $posts->groupBy(function ($post) use ($interval) {
                if ($interval === 'hour') {
                    return $post->created_at->format('h a');
                } else {
                    return $post->created_at->format('Y-m-d');
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateNumberPostsGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
        }


        // if ($tagTypes != null) {
        //     $tagIds = Tag::whereIn('tag_type', $tagTypes)->pluck('id')->toArray();
        //     $tagTypeCount = Poster::whereIn('tags', $tagIds)->whereBetween('created_at', [$startDate, $endDate])->count();

        //     $labels[] = trans("messages.tag_type_based_post_count");
        //     $data[] = $tagTypeCount;
        //     // dd($data);
        // }
        if ($tagTypes != null) {
            $colorIndex = 0;
            foreach ($tagTypes as $key => $tagType) {
                $dataCount = [];
                $tagIds = Tag::where('tag_type', $tagType)->pluck('id')->toArray();
                // $postersIds = Poster::whereIn('tags', $tagIds)->pluck('id')->toArray();
                $tagTypeCount = Poster::whereIn('tags', $tagIds)->whereBetween('created_at', [$startDate, $endDate])->get();

                foreach ($tagTypeCount as $tagCount) {
                    $dataCount[] = $tagTypeCount->count();
                }
                // Get the name of the tag type based on locale
                $getName = TagType::where('id', $tagType)->first();

                if (app()->getLocale() == 'en') {
                    $tagTypeName = $getName->name_en;
                } else {
                    $tagTypeName = $getName->name_ch;
                }

                // Create a dataset for the current tag type
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

        $pluginText = trans("cruds.number_of_posts.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.number_of_posts.fields.count");
        $labelText =  trans("cruds.number_of_posts.fields.graph");

        // list($labels, $data) = $this->calculateAverage($labels, $data);
        $averageData = $this->calculateAverage($labels, $data);
        $labels = $averageData['labels'];
        $data = $averageData['data'];

        // Add average data to datasets
        $datasets[] = [
            'label' => 'Average',
            'data' => [$averageData['data'][count($averageData['data']) - 1]],
            'backgroundColor' => '#000000',
            'borderColor' => '#000000',
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

        $html = view('statistics.graph', compact('labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
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
                $datasets[0] = [
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
                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateVisitingUsersGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
        }

        $pluginText = trans("cruds.visiting_users.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.visiting_users.fields.count");
        $labelText =  trans("cruds.visiting_users.fields.graph");

        // list($labels, $data) = $this->calculateAverage($labels, $data);
        $averageData = $this->calculateAverage($labels, $data);
        $labels = $averageData['labels'];
        $data = $averageData['data'];

        // Add average data to datasets
        $datasets[] = [
            'label' => 'Average',
            'data' => [$averageData['data'][count($averageData['data']) - 1]],
            'backgroundColor' => '#000000',
            'borderColor' => '#000000',
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
        $html = view('statistics.graph', compact('labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function popularPostersGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $tagTypes = $request['tag_type'];
        $data = [];
        $labels = [];
        $datasets = [];
        // $colors = $this->generateColors(count($tagTypes));
        $colors = ['#ff0000', '#00ff00', '#0000ff'];

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
            $popularPosters = PosterReadCount::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at')->get();

            $popularPostersCounts = $popularPosters->groupBy(function ($popular) use ($interval) {
                if ($interval === 'hour') {
                    return $popular->created_at->format('h a');
                } else {
                    return $popular->created_at->format('Y-m-d');
                }
            });

            $startDateCopy = $startDate->copy();

            while ($startDateCopy->lte($endDate)) {
                if ($interval === 'hour') {
                    $date = $startDateCopy->format('h a');
                } else {
                    $date = $startDateCopy->format('Y-m-d');
                }


                $count = isset($popularPostersCounts[$date]) ? $popularPostersCounts[$date]->count() : 0;

                $labels[] = $date;
                $data[] = $count;

                $datasets[0] = [
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
                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generatePopularPostersGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
        }

        if ($tagTypes != null) {
            $colorIndex = 0;
            foreach ($tagTypes as $key => $tagType) {
                $dataCount = [];
                $tagIds = Tag::where('tag_type', $tagType)->pluck('id')->toArray();
                $postersIds = Poster::whereIn('tags', $tagIds)->pluck('id')->toArray();
                $tagTypeCount = PosterReadCount::whereIn('poster_id', $postersIds)->whereBetween('created_at', [$startDate, $endDate])->get();

                foreach ($tagTypeCount as $tagCount) {
                    $dataCount[] = $tagTypeCount->count();
                }
                // Get the name of the tag type based on locale
                $getName = TagType::where('id', $tagType)->first();

                if (app()->getLocale() == 'en') {
                    $tagTypeName = $getName->name_en;
                } else {
                    $tagTypeName = $getName->name_ch;
                }

                // Create a dataset for the current tag type
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

        // if ($tagTypes != null) {
        //     $tagIds = Tag::whereIn('tag_type', $tagTypes)->pluck('id')->toArray();
        //     $postersIds = Poster::whereIn('tags', $tagIds)->pluck('id')->toArray();
        //     $tagTypeCount = PosterReadCount::whereIn('poster_id', $postersIds)->whereBetween('created_at', [$startDate, $endDate])->count();
        //     $labels[] = trans("messages.most_popular_poster_count");
        //     $data[] = $tagTypeCount;
        // }

        $pluginText = trans("cruds.most_popular_poster.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.most_popular_poster.fields.count");
        $labelText =  trans("cruds.most_popular_poster.fields.graph");

        // list($labels, $data) = $this->calculateAverage($labels, $data);

        // Calculate average
        $averageData = $this->calculateAverage($labels, $data);
        $labels = $averageData['labels'];
        $data = $averageData['data'];

        // Add average data to datasets
        $datasets[] = [
            'label' => 'Average',
            'data' => [$averageData['data'][count($averageData['data']) - 1]],
            'backgroundColor' => '#000000',
            'borderColor' => '#000000',
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

        $html = view('statistics.graph', compact('labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

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

                $datasets[0] = [
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'custom range') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMobileAccessGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
        }

        $pluginText = trans("cruds.mobile_access.fields.num_graph");
        $xAxisText =  '';
        $yAxisText =  trans("cruds.mobile_access.fields.count");
        $labelText =  trans("cruds.mobile_access.fields.graph");

        // list($labels, $data) = $this->calculateAverage($labels, $data);
        $averageData = $this->calculateAverage($labels, $data);
        $labels = $averageData['labels'];
        $data = $averageData['data'];

        // Add average data to datasets
        $datasets[] = [
            'label' => 'Average',
            'data' => [$averageData['data'][count($averageData['data']) - 1]],
            'backgroundColor' => '#000000',
            'borderColor' => '#000000',
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

        $html = view('statistics.graph', compact('labels', 'datasets', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

        return response()->json(['success' => true, 'html' => $html], 200);
    }

    private function getMonthlyDateRanges($startDate, $endDate)
    {
        $monthlyDateRanges = [];
        $currentDate = $startDate->copy()->startOfMonth();
        while ($currentDate->lte($endDate)) {
            $endOfMonth = $currentDate->copy()->endOfMonth();
            if ($endOfMonth->gt($endDate)) {
                $endOfMonth = $endDate->copy();
            }

            // Instead of adding only the end of the month, add each day of the month
            $currentDay = $currentDate->copy();
            while ($currentDay->lte($endOfMonth)) {
                $monthlyDateRanges[] = [
                    'start' => $currentDay->copy()->startOfDay(),
                    'end' => $currentDay->copy()->endOfDay()
                ];
                $currentDay->addDay(); // Move to the next day
            }

            $currentDate->addMonth()->startOfMonth();
        }
        return $monthlyDateRanges;
    }


    // monthly date-range filteration
    // private function getMonthlyDateRanges($startDate, $endDate)
    // {
    //     $monthlyDateRanges = [];
    //     $currentDate = $startDate->copy()->startOfMonth();
    //     while ($currentDate->lte($endDate)) {
    //         $endOfMonth = $currentDate->copy()->endOfMonth();
    //         if ($endOfMonth->gt($endDate)) {
    //             $endOfMonth = $endDate->copy();
    //         }
    //         $monthlyDateRanges[] = [
    //             'start' => $currentDate->copy()->startOfDay(),
    //             'end' => $endOfMonth->copy()->endOfDay()
    //         ];
    //         $currentDate->addMonth()->startOfMonth();
    //     }
    //     return $monthlyDateRanges;
    // }

    //  Avarage Calculations FILTERATION
    // private function calculateAverage($labels, $data)
    // {
    //     // dd('djkd');
    //     $totalDays = count($labels);
    //     $total = array_sum($data);
    //     $average = $totalDays > 0 ? $total / $totalDays : 0;

    //     $labels[] = 'Average';
    //     $data[] = $average;

    //     return [$labels, $data];
    // }

    private function calculateAverage($labels, $data)
    {
        $totalDays = count($labels);
        $total = array_sum($data);

        $average = $totalDays > 0 ? $total / $totalDays : 0;
        // $labels[] = 'Average';
        $data[] = $average;

        // dd($labels, $data);
        // return [$labels, $data];
        return ['labels' => $labels, 'data' => $data];
    }

    // private function generateMembersRegistrationGraph($dateRanges)
    // {
    //     $labels = [];
    //     $data = [];

    //     foreach ($dateRanges as $range) {
    //         $start = $range['start'];
    //         $end = $range['end'];

    //         // Calculate the total number of days in the range
    //         $totalDays = $start->diffInDays($end);

    //         // Calculate the number of days in the month
    //         $daysInMonth = $start->copy()->endOfMonth()->day;

    //         // Check if the total number of days in the range is less than 5 for this month
    //         if ($totalDays < 5 && $totalDays < $daysInMonth) {
    //             // Generate data for each day within the month
    //             $currentDate = $start->copy();
    //             while ($currentDate->lte($end)) {
    //                 $users = User::whereDate('created_at', $currentDate)->get();
    //                 $count = $users->count();
    //                 $data[] = $count;
    //                 $labels[] = $currentDate->format('Y-m-d');
    //                 $currentDate->addDay();
    //             }
    //         } else {
    //             // Generate data for the end date of the month
    //             $users = User::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
    //             $count = $users->count();
    //             $data[] = $count;
    //             $labels[] = $end->format('Y-m-d');
    //         }
    //     }

    //     return [$labels, $data];
    // }



    //  Members Registrations 
    private function generateMembersRegistrationGraph($dateRanges)
    {
        $labels = [];
        $data = [];
        foreach ($dateRanges as $range) {
            $start = $range['start'];
            $end = $range['end'];
            $users = User::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
            $count = $users->count();
            $data[] = $count;
            $labels[] = $end->toDateString();
        }
        return [$labels, $data];
    }

    // Number Of Posts
    private function generateNumberPostsGraph($dateRanges)
    {
        $labels = [];
        $data = [];
        foreach ($dateRanges as $range) {
            $start = $range['start'];
            $end = $range['end'];
            $numberPosts = Poster::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
            $count = $numberPosts->count();
            $data[] = $count;
            $labels[] = $end->toDateString();
        }
        return [$labels, $data];
    }

    //  Visiting Users
    private function generateVisitingUsersGraph($dateRanges)
    {
        $labels = [];
        $data = [];
        foreach ($dateRanges as $range) {
            $start = $range['start'];
            $end = $range['end'];
            $VisitingUsers = UniqueVisitor::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
            $count = $VisitingUsers->count();
            $data[] = $count;
            $labels[] = $end->toDateString();
        }
        return [$labels, $data];
    }

    // Popular Posters
    private function generatePopularPostersGraph($dateRanges)
    {
        $labels = [];
        $data = [];
        foreach ($dateRanges as $range) {
            $start = $range['start'];
            $end = $range['end'];
            $popularPosters = PosterReadCount::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
            $count = $popularPosters->count();
            $data[] = $count;
            $labels[] = $end->toDateString();
        }
        return [$labels, $data];
    }

    // Mobile Access 
    private function generateMobileAccessGraph($dateRanges,)
    {
        $labels = [];
        $data = [];
        foreach ($dateRanges as $range) {
            $start = $range['start'];
            $end = $range['end'];
            $mobileAccess = UniqueVisitor::whereBetween('created_at', [$start, $end])->orderBy('created_at')->get();
            $count = $mobileAccess->count();
            $data[] = $count;
            $labels[] = $end->toDateString();
        }
        return [$labels, $data];
    }


    // private function generateColors($count)
    // {
    //     $colors = [];
    //     for ($i = 0; $i < $count; $i++) {
    //         // Generate random RGB colors
    //         $colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    //     }
    //     return $colors;
    // }
}
