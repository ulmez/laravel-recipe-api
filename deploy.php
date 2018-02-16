<?php
namespace Deployer;

//require 'recipe/laravel.php';
require 'recipe/common.php';

// Project name
set('application', 'laravel_recipe_api');

// Project repository
set('repository', 'git@github.com:ulmez/laravel-recipe-api.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

/*host('ssh.binero.se')
->set('deploy_path', '~/ghouls.chas.academy')
->user('226748_ulme')
->port(22);*/

host('master') 
    ->hostname('ssh.binero.se')
    ->set('deploy_path', '~/recipe-api.chas.academy') 
    ->user('226748_ulme') 
    ->port(22);

/*host('develop') 
    ->set('deploy_path', '~/dev.ghouls.chas.academy') 
    ->user('226748_ulme') 
    ->port(22);*/
    
// dep deploy production / develop

// Tasks

desc('Deploy your project');

task('deploy:custom_webroot', function() {
    run("cd {{deploy_path}} && ln -sfn {{release_path}} public_html/web");
});

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

after('deploy', 'deploy:custom_webroot');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

