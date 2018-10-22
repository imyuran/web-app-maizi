<div class="box-header with-border <?php echo e($expand?'':'hide'); ?>" id="<?php echo e($filterID); ?>">
    <form action="<?php echo $action; ?>" class="form-horizontal" pjax-container method="get">
        <div class="box-body">
            <div class="fields-group">
                <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $filter->render(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="btn-group pull-left">
                    <button class="btn btn-info submit"><i class="fa fa-search"></i>&nbsp;&nbsp;<?php echo e(trans('admin.search')); ?></button>
                </div>
                <div class="btn-group pull-left " style="margin-left: 10px;">
                    <a href="<?php echo $action; ?>" class="btn btn-default"><i class="fa fa-undo"></i>&nbsp;&nbsp;<?php echo e(trans('admin.reset')); ?></a>
                </div>
            </div>
        </div>
    </form>
</div>