<?php

require_once BASE_PATH . '/template/admin/layouts/header.php';

?>

<section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">Create Message</h1>
</section>
        <section class="row my-3">
                <section class="col-12">
                        <form method="post" action="<?= url('admin/content/message/store') ?>">
                                <div class="form-group">
                                        <label for="name">متن پیام را وارد کنید</label>
                                        <input type="text" class="form-control" id="name" name="text" placeholder="Enter message ...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">ذخیره</button>
                        </form>
                </section>
        </section>

        <?php

        require_once BASE_PATH . '/template/admin/layouts/footer.php';

        ?>