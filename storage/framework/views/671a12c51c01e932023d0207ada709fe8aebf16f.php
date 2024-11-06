

    <?php $__env->startSection('content'); ?>
        <?php if(config('config.enable_job_application_candidates')): ?>
        <a class="btn btn-primary btn-sm pull-right" style='margin:15px;' role="button" href="/apply"><?php echo trans('messages.apply_for_job'); ?></a>
        <?php endif; ?>
        <div class="full-content-center animated fadeInDownBig">
            <?php if(File::exists(config('constants.upload_path.logo').config('config.logo'))): ?>
            <a href="/"><img src="/<?php echo config('constants.upload_path.logo').config('config.logo'); ?>" class="" alt="Logo"></a>
            <?php endif; ?>
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong><?php echo trans('messages.user'); ?></strong> <?php echo trans('messages.login'); ?></h2>
                    
                    <form role="form" action="<?php echo URL::to('/login'); ?>" method="post" class="login-form" id="login-form" data-submit="noAjax">
                        <?php echo csrf_field(); ?>

                        <div class="form-group login-input">
                        <i class="fa fa-user overlay"></i>
                        <input type="text" name="username" id="username" class="form-control text-input" placeholder="<?php echo trans('messages.username'); ?>">
                        </div>
                        <div class="form-group login-input">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" name="password" id="password" class="form-control text-input" placeholder="<?php echo trans('messages.password'); ?>">
                        </div>
                        <div class="checkbox">
                        <label>
                            <input type="checkbox"> <?php echo trans('messages.remember_me'); ?>

                        </label>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> <?php echo trans('messages.login'); ?></button>
                            </div>
                        </div>

                        <?php if(!getMode()): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>Admin</td>
                                            <td>john</td>
                                            <td>123456</td>
                                        </tr>
                                        <tr>
                                            <td>Manager</td>
                                            <td>sean</td>
                                            <td>123456</td>
                                        </tr>
                                        <tr>
                                            <td>User</td>
                                            <td>marry</td>
                                            <td>123456</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </form>
                    <p class="text-center"><a href="<?php echo URL::to('/password/email'); ?>"><i class="fa fa-lock"></i> <?php echo trans('messages.forgot_password'); ?>?</a></p>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>