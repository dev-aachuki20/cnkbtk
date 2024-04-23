<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poster;
use App\Models\UniqueVisitor;
use App\Models\PosterReadCount;
use Carbon\Carbon;
use DB;


class StatisticsController extends Controller
{
    public function membersRegistrationGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month'])) {
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
                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'week') {
                $weeklyDateRanges = $this->getWeeklyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMembersRegistrationGraph($weeklyDateRanges, $startDate, $endDate, 'week');
            }
            if ($range == 'month') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMembersRegistrationGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
            if ($range == 'day') {
                $interval = 'hour';
            }
        }

        list($labels, $data) = $this->calculateAverage($labels, $data);

        $pluginText = trans("cruds.registered_members.fields.num_graph");
        $xAxisText =  trans("cruds.registered_members.fields.time");
        $yAxisText =  trans("cruds.registered_members.fields.count");
        $labelText =  trans("cruds.registered_members.fields.graph");

        $html = view('statistics.graph', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function numberPostsGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month'])) {
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'week') {
                $weeklyDateRanges = $this->getWeeklyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateNumberPostsGraph($weeklyDateRanges, $startDate, $endDate, 'week');
            }
            if ($range == 'month') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateNumberPostsGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
            if ($range == 'day') {
                $interval = 'hour';
            }
        }

        $pluginText = trans("cruds.number_of_posts.fields.num_graph");
        $xAxisText =  trans("cruds.number_of_posts.fields.time");
        $yAxisText =  trans("cruds.number_of_posts.fields.count");
        $labelText =  trans("cruds.number_of_posts.fields.graph");

        list($labels, $data) = $this->calculateAverage($labels, $data);

        $html = view('statistics.graph', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();
        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function visitingUsersGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month'])) {
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'week') {
                $weeklyDateRanges = $this->getWeeklyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateVisitingUsersGraph($weeklyDateRanges, $startDate, $endDate, 'week');
            }
            if ($range == 'month') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateVisitingUsersGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
            if ($range == 'day') {
                $interval = 'hour';
            }
        }

        $pluginText = trans("cruds.visiting_users.fields.num_graph");
        $xAxisText =  trans("cruds.visiting_users.fields.time");
        $yAxisText =  trans("cruds.visiting_users.fields.count");
        $labelText =  trans("cruds.visiting_users.fields.graph");

        list($labels, $data) = $this->calculateAverage($labels, $data);
        $html = view('statistics.graph', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function popularPostersGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $data = [];
        $labels = [];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month'])) {
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
                $startDateCopy->add(1, $interval);
            }
        } else {
            $range = $request->range;
            if ($range == 'week') {
                $weeklyDateRanges = $this->getWeeklyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generatePopularPostersGraph($weeklyDateRanges, $startDate, $endDate, 'week');
            }
            if ($range == 'month') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generatePopularPostersGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
            if ($range == 'day') {
                $interval = 'hour';
            }
        }

        $pluginText = trans("cruds.most_popular_poster.fields.num_graph");
        $xAxisText =  trans("cruds.most_popular_poster.fields.time");
        $yAxisText =  trans("cruds.most_popular_poster.fields.count");
        $labelText =  trans("cruds.most_popular_poster.fields.graph");

        list($labels, $data) = $this->calculateAverage($labels, $data);
        $html = view('statistics.graph', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

        return response()->json(['success' => true, 'html' => $html], 200);
    }

    public function mobileAccessGraph(Request $request, $range)
    {
        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->has('end_date') ? Carbon::parse($request->end_date) : Carbon::now();
        $labels = [];
        $data = [];
        if (!$request->has(['start_date', 'end_date', 'range'])) {
            if (!in_array($range, ['day', 'week', 'month'])) {
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

                $startDateCopy->add(1, $interval);
            }
        } else {
            $data = [];
            $labels = [];
            $range = $request->range;
            if ($range == 'week') {
                $weeklyDateRanges = $this->getWeeklyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMobileAccessGraph($weeklyDateRanges, $startDate, $endDate, 'week');
            }
            if ($range == 'month') {
                $monthlyDateRanges = $this->getMonthlyDateRanges($startDate, $endDate);
                list($labels, $data) = $this->generateMobileAccessGraph($monthlyDateRanges, $startDate, $endDate, 'month');
            }
            if ($range == 'day') {
                $interval = 'hour';
            }
        }

        $pluginText = trans("cruds.mobile_access.fields.num_graph");
        $xAxisText =  trans("cruds.mobile_access.fields.time");
        $yAxisText =  trans("cruds.mobile_access.fields.count");
        $labelText =  trans("cruds.mobile_access.fields.graph");

        list($labels, $data) = $this->calculateAverage($labels, $data);
        $html = view('statistics.graph', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

        return response()->json(['success' => true, 'html' => $html], 200);
    }

    // weekly date-range filteration
    private function getWeeklyDateRanges($startDate, $endDate)
    {
        $weeklyDateRanges = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lte($endDate)) {
            $endOfWeek = $currentDate->copy()->endOfWeek();
            if ($endOfWeek->gt($endDate)) {
                $endOfWeek = $endDate->copy();
            }
            $weeklyDateRanges[] = [
                'start' => $currentDate->copy()->startOfDay(),
                'end' => $endOfWeek->copy()->endOfDay()
            ];
            $currentDate->addWeek()->startOfWeek();
        }
        return $weeklyDateRanges;
    }

    // monthly date-range filteration
    private function getMonthlyDateRanges($startDate, $endDate)
    {
        $monthlyDateRanges = [];
        $currentDate = $startDate->copy()->startOfMonth();
        while ($currentDate->lte($endDate)) {
            $endOfMonth = $currentDate->copy()->endOfMonth();
            if ($endOfMonth->gt($endDate)) {
                $endOfMonth = $endDate->copy();
            }
            $monthlyDateRanges[] = [
                'start' => $currentDate->copy()->startOfDay(),
                'end' => $endOfMonth->copy()->endOfDay()
            ];
            $currentDate->addMonth()->startOfMonth();
        }
        return $monthlyDateRanges;
    }

    //  Avarage Calculations FILTERATION
    private function calculateAverage($labels, $data)
    {
        $totalDays = count($labels);
        $total = array_sum($data);
        $average = $totalDays > 0 ? $total / $totalDays : 0;

        $labels[] = 'Average';
        $data[] = $average;

        return [$labels, $data];
    }

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
}
