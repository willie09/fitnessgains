<x-trainor-layout>
    
    <div class="py-12 px-6 sm:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="Soverflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8  rounded-xl bg-violet-50/20 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h1 class="ml-2 text-2xl font-medium text-gray-900 dark:text-white">
                            My Schedule
                        </h1>
                    </div>

                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        View and manage your training sessions and appointments.
                    </p>
                </div>

                <div class=" rounded-xl bg-violet-50/20 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h2 class="ml-3 text-xl font-semibold text-gray-900 dark:text-white">
                                Upcoming Sessions
                            </h2>
                        </div>

                        <div class="mt-6">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern custom styles with glass effect to match the color theme */
        #calendar .fc {
            background: rgba(94, 94, 94, 0.8); /* gray-50 with opacity */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #111827; /* gray-900 */
            font-family: 'Inter', sans-serif;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            overflow: hidden;
        }
        .dark #calendar .fc {
            background: rgba(55, 65, 81, 0.8); /* gray-700 with opacity */
            color: #515151ff; /* gray-50 */
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        #calendar .fc-header-toolbar {
            background: linear-gradient(135deg, #2d2d2dff 0%, #e5e7eb 100%); /* gray-100 to gray-200 */
            border-bottom: 1px solid #d1d5db; /* gray-300 */
            padding: 16px 20px;
            border-radius: 12px 12px 0 0;
        }
        .dark #calendar .fc-header-toolbar {
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%); /* gray-600 to gray-500 */
            border-bottom: 1px solid #9ca3af; /* gray-400 */
        }
        #calendar .fc-button {
            background-color: #707070ff; /* white */
            color: #ffffffff; /* gray-700 */
            border: 1px solid #d1d5db; /* gray-300 */
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            margin-left: 8px;
        }
        .dark #calendar .fc-button {
            background-color: #6b7280; /* gray-500 */
            color: #f9fafb; /* gray-50 */
            border: 1px solid #9ca3af; /* gray-400 */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
        }
        #calendar .fc-button:hover {
            background-color: #f9fafb; /* gray-50 */
            transform: translateY(-1px);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.12);
        }
        .dark #calendar .fc-button:hover {
            background-color: #9ca3af; /* gray-400 */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
        }
        #calendar .fc-button:active {
            transform: translateY(0);
        }
        #calendar .fc-daygrid-day {
            background-color: #5a5a5aff; /* white */
            border: 1px solid #b285faff; /* gray-100 */
            color: #050505ff;
            transition: background-color 0.2s ease;
        }
        .dark #calendar .fc-daygrid-day {
            background-color: #4b5563; /* gray-600 */
            border: 1px solid #6b7280; /* gray-500 */
        }
        #calendar .fc-daygrid-day:hover {
            background-color: #4c4c4cff; /* gray-50 */
        }
        .dark #calendar .fc-daygrid-day:hover {
            background-color: #717171ff; /* gray-500 */
        }
        #calendar .fc-col-header {
            background: linear-gradient(135deg, #737373ff 0%, #f3f4f6 100%); /* gray-50 to gray-100 */
            color: #374151; /* gray-700 */
            border-bottom: 2px solid #d1d5db; /* gray-300 */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .dark #calendar .fc-col-header {
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%); /* gray-600 to gray-500 */
            color: #f9fafb; /* gray-50 */
            border-bottom: 2px solid #9ca3af; /* gray-400 */
        }
        #calendar .fc-event {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); /* blue-500 to blue-700 */
            color: #ffffff; /* white */
            border: none;
            border-radius: 6px;
            font-weight: 500;
            box-shadow: 0 2px 4px 0 rgba(59, 130, 246, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .dark #calendar .fc-event {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%); /* blue-400 to blue-500 */
            box-shadow: 0 2px 4px 0 rgba(96, 165, 250, 0.4);
        }
        #calendar .fc-event:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px 0 rgba(59, 130, 246, 0.4);
        }
        #calendar .fc-today {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); /* yellow-100 to yellow-200 */
            position: relative;
        }
        .dark #calendar .fc-today {
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%); /* gray-600 to gray-500 */
        }
        #calendar .fc-today::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(251, 191, 36, 0.1); /* yellow-400 with opacity */
            pointer-events: none;
        }
        .dark #calendar .fc-today::after {
            background: rgba(113, 113, 113, 0.2); /* gray-400 with opacity */
        }

        /* Responsive enhancements for small screens */
        @media (max-width: 640px) {
            #calendar .fc-header-toolbar {
                padding: 12px 16px;
                flex-direction: column;
                gap: 8px;
            }
            #calendar .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
                width: 100%;
            }
            #calendar .fc-button {
                padding: 6px 12px;
                font-size: 14px;
            }
            #calendar .fc-toolbar-title {
                font-size: 18px;
                margin: 8px 0;
            }
            #calendar .fc-daygrid-day {
                min-height: 60px;
            }
            #calendar .fc-event {
                font-size: 12px;
                padding: 2px 4px;
            }
            #calendar .fc-col-header {
                font-size: 12px;
                padding: 8px 4px;
            }
        }

        /* Additional enhancements */
        #calendar .fc-view-harness {
            background: transparent;
        }
        #calendar .fc-scrollgrid {
            border-radius: 0 0 12px 12px;
        }
        #calendar .fc-event:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new window.FullCalendar.Calendar(calendarEl, {
                plugins: [window.FullCalendar.dayGridPlugin, window.FullCalendar.interactionPlugin],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("trainor.schedule.events") }}',
                eventClick: function(info) {
                    // Handle event click
                    console.log('Event: ' + info.event.title);
                },
                height: 'auto',
                contentHeight: 600,
                aspectRatio: 1.35,
                responsive: true
            });
            calendar.render();
        });
    </script>
</x-trainor-layout>
