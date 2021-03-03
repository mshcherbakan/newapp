<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Laravel');

// Project repository
set('repository', 'git@github.com:shcherbakan/newapp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('devkvm.top')
    ->user('laravel')
    ->stage('production')
    ->set('deploy_path', '/var/www/laravel');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('argon:link', function() {
    run('cd {{release_path}}/public && ln -s ../resources/argon');
});

task('supervisorctl:restart', function() {
   run('supervisorctl restart all');
});

task('notification:success', function() {
   run('curl \'https://api.telegram.org/bot1553893574:AAEkzh7J8oQ7SeXvBbJBXwgNqAbCtVIq3Yc/sendMessage?chat_id=1622978169&text=Success\'');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy:symlink', 'argon:link');
after('success', 'notification:success');
// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
before('deploy:unlock', 'supervisorctl:restart');
