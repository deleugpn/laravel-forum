<?php

namespace Bitporch\Forum\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the forum and initial setup';

    /**
     * Policies that need to be converted.
     *
     * @var array
     */
    protected $policies = [
        'discussion-policy.stub' => 'DiscussionPolicy.php',
        'group-policy.stub'      => 'GroupPolicy.php',
        'post-policy.stub'       => 'PostPolicy.php',
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!is_dir(app_path('Policies'))) {
            mkdir(app_path('Policies'), 0755, true);
        }

        foreach ($this->policies as $key => $value) {
            copy(
                __DIR__.'/stubs/'.$key,
                app_path('Policies/'.$value)
            );
        }
    }
}
