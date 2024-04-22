<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poster;
use App\Models\LoginLog;
use App\Models\UniqueVisitor;
use App\Models\PosterReadCount;
use Carbon\Carbon;


class StatisticsController extends Controller
{
        public function membersRegistrationGraph(Request $request, $range)
        {
                if ($request->has('start_date') && $request->has('end_date') && $request->has('range')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date);
                        $range = $request->range;
                        if ($range == 'day') {
                                $interval = 'hour';
                        }
                        if ($range == 'week' || $range == 'month') {
                                $interval = 'day';
                        }
                } else {
                        $startDate = Carbon::now();
                        $endDate = Carbon::now();
                        if ($range == 'day') {
                                $startDate->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'hour';
                        } elseif ($range == 'week') {
                                $startDate->subDays(6)->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'day';
                        } elseif ($range == 'month') {
                                $startDate->startOfMonth();
                                $endDate->endOfMonth();
                                $interval = 'day';
                        } else {
                                return response()->json(['error' => 'Invalid range'], 400);
                        }
                }


                $labels = [];
                $data = [];
                $pluginText = 'Members Registration Graph';
                $xAxisText = 'Members Registration Time';
                $yAxisText = 'Members Count';
                $labelText = 'Members Graph';



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

                $html = view('statistics.members-registration', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

                return response()->json(['success' => 'Data retrieved successfully', 'html' => $html], 200);
        }



        public function numberPostsGraph(Request $request, $range)
        {
                if ($request->has('start_date') && $request->has('end_date') && $request->has('range')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date);
                        $range = $request->range;
                        if ($range == 'day') {
                                $interval = 'hour';
                        }
                        if ($range == 'week' || $range == 'month') {
                                $interval = 'day';
                        }
                } else {
                        $startDate = Carbon::now();
                        $endDate = Carbon::now();

                        if ($range == 'day') {
                                $startDate->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'hour';
                        } elseif ($range == 'week') {
                                $startDate->subDays(6)->startOfDay();;
                                $endDate->endOfWeek();
                                $interval = 'day';
                        } elseif ($range == 'month') {
                                $startDate->startOfMonth();
                                $endDate->endOfMonth();
                                $interval = 'day';
                        } else {
                                return response()->json(['error' => 'Invalid range'], 400);
                        }
                }

                $labels = [];
                $data = [];
                $pluginText = 'Number Of Points Graph';
                $xAxisText = 'Number Of Points Time';
                $yAxisText = 'Points Count';
                $labelText = 'Points Graph';

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

                $html = view('statistics.members-registration', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

                return response()->json(['success' => 'Graph Find Your Data', 'html' => $html], 200);
        }



        public function visitingUsersGraph(Request $request, $range)
        {
                if ($request->has('start_date') && $request->has('end_date') && $request->has('range')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date);
                        $range = $request->range;
                        if ($range == 'day') {
                                $interval = 'hour';
                        }
                        if ($range == 'week' || $range == 'month') {
                                $interval = 'day';
                        }
                } else {
                        $startDate = Carbon::now();
                        $endDate = Carbon::now();

                        if ($range == 'day') {
                                $startDate->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'hour';
                        } elseif ($range == 'week') {
                                $startDate->subDays(7)->startOfDay();;
                                $endDate->endOfWeek();
                                $interval = 'day';
                        } elseif ($range == 'month') {
                                $startDate->startOfMonth();
                                $endDate->endOfMonth();
                                $interval = 'day';
                        } else {
                                return response()->json(['error' => 'Invalid range'], 400);
                        }
                }

                $labels = [];
                $data = [];
                $pluginText = 'Visiting Users Graph';
                $xAxisText = 'Visiting Time';
                $yAxisText = 'Visiting Users Count';
                $labelText = 'Visiting  Graph';

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

                $html = view('statistics.members-registration', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

                return response()->json(['success' => 'Graph Find Your Data', 'html' => $html], 200);
        }


        public function popularPostersGraph(Request $request, $range)
        {
                if ($request->has('start_date') && $request->has('end_date') && $request->has('range')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date);
                        $range = $request->range;
                        if ($range == 'day') {
                                $interval = 'hour';
                        }
                        if ($range == 'week' || $range == 'month') {
                                $interval = 'day';
                        }
                } else {
                        $startDate = Carbon::now();
                        $endDate = Carbon::now();

                        if ($range == 'day') {
                                $startDate->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'hour';
                        } elseif ($range == 'week') {
                                $startDate->subDays(7)->startOfDay();;
                                $endDate->endOfWeek();
                                $interval = 'day';
                        } elseif ($range == 'month') {
                                $startDate->startOfMonth();
                                $endDate->endOfMonth();
                                $interval = 'day';
                        } else {
                                return response()->json(['error' => 'Invalid range'], 400);
                        }
                }

                $labels = [];
                $data = [];
                $pluginText = 'Most Of Popular Posters Graph';
                $xAxisText = 'Popular Posters Time';
                $yAxisText = 'Popular Posters Count';
                $labelText = 'Popular Posters  Graph';



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

                $html = view('statistics.members-registration', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

                return response()->json(['success' => 'Graph Find Your Data', 'html' => $html], 200);
        }

        public function mobileAccessGraph(Request $request, $range)
        {
                if ($request->has('start_date') && $request->has('end_date') && $request->has('range')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date);
                        $range = $request->range;
                        if ($range == 'day') {
                                $interval = 'hour';
                        }
                        if ($range == 'week' || $range == 'month') {
                                $interval = 'day';
                        }
                } else {
                        $startDate = Carbon::now();
                        $endDate = Carbon::now();

                        if ($range == 'day') {
                                $startDate->startOfDay();
                                $endDate->endOfDay();
                                $interval = 'hour';
                        } elseif ($range == 'week') {
                                $startDate->subDays(7)->startOfDay();;
                                $endDate->endOfWeek();
                                $interval = 'day';
                        } elseif ($range == 'month') {
                                $startDate->startOfMonth();
                                $endDate->endOfMonth();
                                $interval = 'day';
                        } else {
                                return response()->json(['error' => 'Invalid range'], 400);
                        }
                }

                $labels = [];
                $data = [];
                $pluginText = 'Mobile Access Graph';
                $xAxisText = 'Mobile Access Time';
                $yAxisText = 'Mobile Access Count';
                $labelText = 'Mobile Access Graph';

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

                $html = view('statistics.members-registration', compact('labels', 'data', 'pluginText', 'xAxisText', 'yAxisText', 'labelText'))->render();

                return response()->json(['success' => 'Graph Find Your Data', 'html' => $html], 200);
        }
}
