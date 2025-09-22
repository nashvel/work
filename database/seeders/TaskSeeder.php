<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectManagement\Task;
use App\Models\ProjectManagement\Project;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::find(3);
        
        if (!$project) {
            $this->command->info('Project with ID 3 not found. Skipping task seeding.');
            return;
        }

        Task::where('project_id', 3)->delete();

        $tasks = [
            [
                'project_id' => 3,
                'title' => 'Clean the windows',
                'description' => 'Clean all office windows inside and outside, including window sills',
                'status' => 'todo',
                'priority' => 'medium',
                'due_date' => Carbon::now()->addDays(2),
                'estimated_hours' => 3,
                'created_by' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'title' => 'Mop the floor',
                'description' => 'Sweep and mop all office floors, including under desks and furniture',
                'status' => 'in_progress',
                'priority' => 'high',
                'due_date' => Carbon::now()->addDays(1),
                'estimated_hours' => 2,
                'actual_hours' => 1,
                'created_by' => 1,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'title' => 'Vacuum the carpets',
                'description' => 'Vacuum all carpeted areas including meeting rooms and reception area',
                'status' => 'todo',
                'priority' => 'medium',
                'due_date' => Carbon::now()->addDays(3),
                'estimated_hours' => 2,
                'created_by' => 1,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'title' => 'Clean the bathrooms',
                'description' => 'Deep clean all bathroom facilities, restock supplies, and sanitize surfaces',
                'status' => 'completed',
                'priority' => 'high',
                'due_date' => Carbon::now()->subDays(1),
                'estimated_hours' => 4,
                'actual_hours' => 3,
                'created_by' => 1,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'title' => 'Dust office furniture',
                'description' => 'Dust all desks, chairs, shelves, and office equipment',
                'status' => 'review',
                'priority' => 'low',
                'due_date' => Carbon::now()->addDays(5),
                'estimated_hours' => 2,
                'actual_hours' => 2,
                'created_by' => 1,
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }

        $this->command->info('Created ' . count($tasks) . ' sample tasks for project ID 3.');
    }
}
