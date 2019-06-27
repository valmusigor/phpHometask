<?
return [
    '/{0,1}' => 'home/index',
    '/cabinet/{0,1}'=>'home/index',
    '/login/{0,1}' => 'auth/login',
    '/logout/{0,1}' => 'auth/logout',
    '/register/{0,1}' => 'auth/register',
    '/auth/{0,1}' => 'auth/index',
    '/auth/add/{0,1}' => 'auth/add',
    '/cabinet/admin/{0,1}'=>'home/admin',
    '/cabinet/task/{0,1}'=>'task/index',
    '/cabinet/task/sort/(up|down)/{0,1}'=>'task/index/',
    '/cabinet/task/save/{0,1}'=>'task/save/',
    '/cabinet/task/update/{0,1}'=>'task/update',
    '/cabinet/task/delete/([0-9]+)/{0,1}'=>'task/delete/',
    '/cabinet/file/{0,1}'=>'file/index',
    '/cabinet/file/upload/{0,1}'=>'file/upload',
    '/cabinet/file/download/([0-9]+)/{0,1}'=>'file/download/',
    '/cabinet/file/delete/([0-9]+)/{0,1}'=>'file/delete/'

];
