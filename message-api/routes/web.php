<?php

// admin message
uri('admin/content/message', 'Activities\Admin\Content\Message', 'index');
uri('admin/content/message/create/{id}', 'Activities\Admin\Content\Message', 'create');
uri('admin/content/message/store', 'Activities\Admin\Content\Message', 'store', 'POST');
uri('admin/content/message/delete/{id}', 'Activities\Admin\Content\Message', 'delete');
uri('admin/content/message/send/{id}', 'Activities\Admin\Content\Message', 'sendApi');
// end admin message
//auth
uri('register', 'Activities\Auth\Register', 'register');
uri('register/store', 'Activities\Auth\Register', 'storeRegister','POST');
uri('logout', 'Activities\Auth\Authentication', 'logout');
uri('login', 'Activities\Auth\Authentication', 'login');
uri('login/store', 'Activities\Auth\Authentication', 'storeLogin','POST');
// end auth
echo '404 - not found!!!';
exit;
