

    <?php $__env->startSection('content'); ?>
        <div class="full-content-center animated fadeInDownBig">
            <?php if(File::exists(config('constants.upload_path.logo').config('config.logo'))): ?>
            <a href="/"><img src="/<?php echo config('constants.upload_path.logo').config('config.logo'); ?>" class="" alt="Logo"></a>
            <?php endif; ?>
            <div class="login-wrap">
                <div class="box-info">
                <h2 class="text-center"><strong>Verify</strong> Purchase</h2>
                    
                    <form role="form" action="<?php echo URL::to('/verify-purchase'); ?>" method="post" class="verify-purchase-form" id="verify-purchase-form" data-submit="noAjax">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                        <input type="text" name="envato_username" id="envato_username" class="form-control text-input" placeholder="Envato Username">
                        </div>
                        <div class="form-group">
                        <input type="text" name="purchase_code" id="purchase_code" class="form-control text-input" placeholder="Purchase Code">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-unlock"></i> Verify</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center"><a href="<?php echo URL::to('/'); ?>"><i class="fa fa-lock"></i> <?php echo trans('messages.back_to_login'); ?></a></p>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>