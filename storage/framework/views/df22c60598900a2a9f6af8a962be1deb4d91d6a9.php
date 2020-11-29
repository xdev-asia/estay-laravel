

<?php $__env->startSection('title'); ?>
<title><?php echo e(get_string('dashboard') . ' - ' . get_setting('site_name', 'site')); ?></title>
<?php $__env->stopSection(); ?>

    <?php $__env->startSection('page_title'); ?>
        <h3 class="page-title mbot10"><?php echo e(get_string('dashboard')); ?></h3>
    <?php $__env->stopSection(); ?>
        <?php $__env->startSection('content'); ?>
            <div class="row mbot0">
                <div class="col s12">
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">payment</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter"><?php echo e($data['new_properties']); ?></strong><br>
                                        <span><?php echo e(get_string('new_listings')); ?></span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">thumb_up</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter"><?php echo e($data['new_bookings']); ?></strong><br>
                                        <span><?php echo e(get_string('new_bookings')); ?></span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">supervisor_account</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter"><?php echo e($data['new_members']); ?></strong><br>
                                        <span><?php echo e(get_string('new_members')); ?></span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">info_outline</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter"><?php echo e($data['new_visits']); ?></strong><br>
                                        <span><?php echo e(get_string('visits_today')); ?></span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l6 m12 s12">
                <h3 class="page-title"><?php echo e(get_string('latest_bookings')); ?></h3>
                <?php if(count($bookings)): ?>
                <div class="table-responsive">
                <table id="latest-bookings" class="responsive-table bordered striped">
                    <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th><?php echo e(get_string('property')); ?></th>
                        <th><?php echo e(get_string('start_date')); ?></th>
                        <th><?php echo e(get_string('end_date')); ?></th>
                        <th><?php echo e(get_string('guest_number')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="filled-in primary-color" id="<?php echo e($booking->id); ?>" />
                                    <label for="<?php echo e($booking->id); ?>"></label>
                                </td>
                                <td><?php if($booking->property_id && $booking->property): ?> <?php echo e($booking->property->contentDefault->name); ?> <?php elseif($booking->service): ?> <?php echo e($booking->service->contentDefault->name); ?> <?php endif; ?></td>
                                <td><?php echo e($booking->start_date); ?></td>
                                <td><?php echo e($booking->end_date); ?></td>
                                <td><?php echo e($booking->guest_number); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                </div>
                <?php else: ?>
                <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
                <?php endif; ?>
            </div>
            <div class="col l6 m12 s12">
                <h3 class="page-title"><?php echo e(get_string('latest_purchases')); ?></h3>
                <?php if(count($purchases)): ?>
                    <div class="table-responsive">
                    <table id="latest-purchases" class="responsive-table bordered striped">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th><?php echo e(get_string('user')); ?></th>
                            <th><?php echo e(get_string('points_purchased')); ?></th>
                            <th><?php echo e(get_string('price')); ?></th>
                            <th><?php echo e(get_string('transaction')); ?></th>
                            <th><?php echo e(get_string('date_of_purchase')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="filled-in primary-color" id="<?php echo e($purchase->id); ?>" />
                                    <label for="<?php echo e($purchase->id); ?>"></label>
                                </td>
                                <td><?php if($purchase->user): ?><?php echo e($purchase->user->username); ?> <?php endif; ?></td>
                                <td><?php echo e($purchase->points); ?></td>
                                <td><?php echo e($purchase->price); ?> <?php echo e($currency); ?></td>
                                <td><?php echo e($purchase->transaction); ?></td>
                                <td><?php echo e(date(get_setting('dateformat', 'site'), strtotime($purchase->created_at))); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                    </table>
                    </div>
                <?php else: ?>
                    <strong class="center-align"><?php echo e(get_string('no_results')); ?></strong>
                <?php endif; ?>
            </div>
            <div class="col l4 m12 s12 clearfix">
                <h3 class="page-title"><?php echo e(get_string('latest_visits')); ?></h3>
                <canvas id="visits-chart" width="420" height="297"></canvas>
            </div>
            <div class="col l4 m12 s12">
                <h3 class="page-title"><?php echo e(get_string('latest_bookings')); ?></h3>
                <canvas id="booking-chart" width="420" height="297"></canvas>
            </div>
            <div class="col l4 m12 s12">
                <h3 class="page-title"><?php echo e(get_string('latest_payments')); ?></h3>
                <canvas id="purchases-chart" width="420" height="297"></canvas>
            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(URL::asset('assets/js/plugins/chart.min.js')); ?>"></script>
    <script>
        $(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#visits-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                                <?php $__currentLoopData = $data['data_range']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    "<?php echo e($date); ?>",
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            ],
                        datasets:[ {
                            label: "<?php echo e(get_string('data')); ?>",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: <?php echo e($data['visits_data']); ?>,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#booking-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            <?php $__currentLoopData = $data['data_range']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    "<?php echo e($date); ?>",
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        ],
                        datasets:[ {
                            label: "<?php echo e(get_string('data')); ?>",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: <?php echo e($data['bookings_data']); ?>

                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#purchases-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            <?php $__currentLoopData = $data['data_range']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                "<?php echo e($date); ?>",
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        ],
                        datasets:[ {
                            label: "<?php echo e(get_string('data')); ?>",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: <?php echo e($data['purchases_data']); ?>

                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>