

<?php $__env->startSection('title'); ?>
    <title><?php echo e(get_string('property_availability') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('page_title'); ?>
    <h3 class="page-title mbot10"><?php echo e(get_string('property_availability')); ?> - <?php echo e($property->contentDefault->name); ?></h3>
<?php $__env->stopSection(); ?>
<div class="col l6 m6 s12">
    <div id="datepicker"></div>
</div>
<div class="col l6 m6 s12 pull-right">
    <h3 class="page-title mbot10"><?php echo e(get_string('legend')); ?></h3>
    <div class="boxed-legend-1">
        <span><?php echo e(get_string('past_days')); ?></span>
    </div>
    <div class="boxed-legend-2">
        <span><?php echo e(get_string('today')); ?></span>
    </div>
    <div class="boxed-legend-3">
        <span><?php echo e(get_string('selected_days')); ?></span>
    </div>
    <div class="boxed-legend-1">
        <span><?php echo e(get_string('booked_days')); ?></span>
    </div>
    <h3 class="page-title mbot10"><?php echo e(get_string('information')); ?></h3>
    <p><?php echo e(get_string('dates_explanation')); ?> </p>
    <?php echo Form::open(['method' => 'post', 'url' => route('admin_property_update_dates')]); ?>

    <?php echo e(Form::hidden('dates', null, ['id' => 'dates-input'])); ?>

    <?php echo e(Form::hidden('property_id', $property->id)); ?>

    <button class="btn waves-effect" type="submit" name="action"><?php echo e(get_string('update_dates')); ?></button>
    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(URL::asset('assets/js/plugins/multidatespicker.min.js')); ?>"></script>
    <script type="text/javascript">
        var booked_dates = [];
        var dateToday = new Date();

         // Get Booked Dates
            <?php if(count($property->booking)): ?>
                    <?php $__currentLoopData = $property->booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        var start_date = new Date('<?php echo e($booking->start_date); ?>');
        var end_date = new Date('<?php echo e($booking->end_date); ?>');
        while(start_date < end_date){
                booked_dates.push(start_date);
            var newDate = start_date.setDate(start_date.getDate() + 1);
            start_date = new Date(newDate);
        }
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>

        // Get Owner dates
        var dates = [];
        <?php if(count($property->prop_dates) && $property->prop_dates->dates): ?>
                <?php $__currentLoopData = $property->prop_dates->dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        var start_date = new Date('<?php echo e($date); ?>');
        dates.push(start_date);
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>

        // Generate datepicker
        $(document).ready(function(){
            $('#datepicker').multiDatesPicker({
                minDate: dateToday,
                altField: '#dates-input',
                addDisabledDates: booked_dates.length ? booked_dates : '',
                addDates: dates.length ? dates : '',
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>