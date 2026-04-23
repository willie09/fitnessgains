<?php if (isset($component)) { $__componentOriginalc0f41e5d8f1bf9b69def8231202579a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6 = $attributes; } ?>
<?php $component = App\View\Components\MappLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mapp-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\MappLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="relative z-10 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           

            <!-- Calendar View -->
            <div class="glass-effect border border-white/20 rounded-2xl p-4 mb-2 md:p-6 shadow-xl">
                <h3 class="text-lg md:text-xl font-bold text-white mb-4">Attendance Calendar</h3>
                <div id="attendance-calendar" class="text-sm"></div>
            </div>

            <!-- Attendance Records Table -->
            <div class="glass-effect border border-white/20 rounded-2xl p-6 shadow-xl overflow-x-auto">
                <h3 class="text-xl font-bold text-white mb-4">Attendance Records</h3>
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white/80 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white/80 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white/80 uppercase tracking-wider">Notes</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white/80 uppercase tracking-wider">Trainor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-white/5 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                                    <?php echo e($attendance->date->format('M j, Y')); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($attendance->status == 'present'): ?>
                                        <span class="px-3 py-1 text-xs rounded-full font-medium bg-green-500/20 text-green-300 border border-green-500/30">Present</span>
                                    <?php elseif($attendance->status == 'late'): ?>
                                        <span class="px-3 py-1 text-xs rounded-full font-medium bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">Late</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 text-xs rounded-full font-medium bg-red-500/20 text-red-300 border border-red-500/30">Absent</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-white/80">
                                    <?php echo e($attendance->notes ?? '-'); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white/80">
                                    <?php echo e($attendance->trainor ? $attendance->trainor->name : 'N/A'); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-white/70">
                                    No attendance records found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('attendance-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: <?php echo json_encode($calendarEvents, 15, 512) ?>,
                eventClick: function(info) {
                    var event = info.event;
                    var extendedProps = event.extendedProps;

                    alert(
                        'Attendance Details:\\n\\n' +
                        'Date: ' + extendedProps.date + '\\n' +
                        'Status: ' + extendedProps.status.charAt(0).toUpperCase() + extendedProps.status.slice(1) + '\\n' +
                       'Notes: ' + (extendedProps.notes || 'None') + '\\n' +
                        'Trainor: ' + extendedProps.trainor
                    );
                },
                height: 400,
                themeSystem: 'standard',
                dayMaxEvents: true,
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                }
            });
            calendar.render();
        });
    </script>

    <style>
        /* FullCalendar custom styling to match dark theme */
        .fc {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .fc-theme-standard td, .fc-theme-standard th {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .fc-col-header-cell {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }
        .fc-daygrid-day {
            background: rgba(255, 255, 255, 0.02);
            color: rgba(255, 255, 255, 0.8);
        }
        .fc-daygrid-day:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .fc-day-today {
            background: rgba(59, 130, 246, 0.2) !important;
        }
        .fc-event {
            border-radius: 4px;
            font-size: 0.75rem;
        }
        .fc-button {
            background: rgba(59, 130, 246, 0.8);
            border: none;
            color: white;
        }
        .fc-button:hover {
            background: rgba(59, 130, 246, 1);
        }
        .fc-button-active {
            background: rgba(37, 99, 235, 1) !important;
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6)): ?>
<?php $attributes = $__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6; ?>
<?php unset($__attributesOriginalc0f41e5d8f1bf9b69def8231202579a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0f41e5d8f1bf9b69def8231202579a6)): ?>
<?php $component = $__componentOriginalc0f41e5d8f1bf9b69def8231202579a6; ?>
<?php unset($__componentOriginalc0f41e5d8f1bf9b69def8231202579a6); ?>
<?php endif; ?>
<?php /**PATH D:\Downloads\fitnessgains.site (2)\fitnessgains.site (1)\willie\resources\views/member/attendance.blade.php ENDPATH**/ ?>