<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteOldRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'requests:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete project requests that are older than a week and not selected by any creators';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        // Fetch projects that have not received any action from creators
        $projectsToDelete = DB::table('projects')
            ->leftJoin('project_creator', 'projects.id', '=', 'project_creator.project_id')
            ->whereDate('projects.created_at', '<=', $oneWeekAgo->format('Y-m-d'))
            ->where('project_creator.user_status','1')
            ->whereNull('project_creator.creator_status')
            ->select('projects.id')
            ->distinct()
            ->get();

        // \Log::info($projectsToDelete);
        // Convert the result to a collection of project IDs
        $projectIds = $projectsToDelete->pluck('id');
    
        // Delete the projects
        Project::whereIn('id', $projectIds)->delete();

        $this->info('Old unselected projects deleted successfully.');

        return Command::SUCCESS;
    }
}
