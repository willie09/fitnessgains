<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainorDashboardController;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\WalkInLogController;
use App\Http\Controllers\InventoryController;
use App\Models\Member;
use App\Models\WalkInLog;
use App\Models\Expense;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::get('admin/dashboard/report/pdf', [\App\Http\Controllers\DashboardController::class, 'generatePdfReport'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard.report.pdf');

Route::middleware(['auth', 'admin'])->group(function () {
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');
    Route::patch('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Member routes
    Route::get('/members', [MemberController::class, 'index'])->name('members.list');
    Route::patch('/members/{id}/renew', [MemberController::class, 'renew'])->name('members.renew');
    Route::resource('members', MemberController::class)
        ->except(['index', 'show'])
        ->names([
            'create' => 'members.create',
            'store' => 'members.store',
            'edit' => 'members.edit',
            'update' => 'members.update',
            'destroy' => 'members.destroy'
        ]);

    // WalkIn routes
    Route::get('/walkins', [WalkInLogController::class, 'index'])->name('walkins');
    Route::delete('/walkins/{id}', [WalkInLogController::class, 'destroy'])->name('walkins.destroy');
    Route::post('/walkins', [WalkInLogController::class, 'store'])->name('walkins.store');

    // Finance route
    Route::get('/finance', [\App\Http\Controllers\MemberController::class, 'finance'])->name('finance');

    // Sales routes
    Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index'])->name('sales.index');

    // Expense routes
    Route::get('/expenses', [\App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [\App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');

    // Member notify routes
    Route::get('/members/notify-expiry', [MemberController::class, 'notifyExpiryForm'])->name('members.notifyExpiryForm');
    Route::post('/members/notify-expiry', [MemberController::class, 'sendExpiryNotifications'])->name('members.sendExpiryNotifications');
    Route::post('/members/{id}/notify', [MemberController::class, 'notifyMember'])->name('members.notifyMember');

    // Orders routes
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders');
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');

    // Trainors routes
    Route::get('/trainors', [\App\Http\Controllers\TrainorController::class, 'index'])->name('trainors');
    Route::get('/trainors/{trainor}', [\App\Http\Controllers\TrainorController::class, 'show'])->name('trainors.show');
    Route::get('/trainors/{trainor}/members', [\App\Http\Controllers\TrainorController::class, 'getMembers'])->name('trainors.members');
    Route::post('/trainors', [\App\Http\Controllers\TrainorController::class, 'store'])->name('trainors.store');
    Route::delete('/trainors/{trainor}', [\App\Http\Controllers\TrainorController::class, 'destroy'])->name('trainors.destroy');
    Route::patch('/trainors/{trainor}', [\App\Http\Controllers\TrainorController::class, 'update'])->name('trainors.update');

    // Attendance routes
    Route::get('/attendance', [\App\Http\Controllers\MemberController::class, 'adminAttendance'])->name('admin.attendance');
    Route::get('/attendance/manage', [\App\Http\Controllers\MemberController::class, 'manageAttendance'])->name('admin.manage.attendance');
    Route::post('/attendance/manage', [\App\Http\Controllers\MemberController::class, 'storeAttendance'])->name('admin.store.attendance');
    Route::delete('/attendance/{attendance}', [\App\Http\Controllers\MemberController::class, 'destroyAttendance'])->name('admin.attendance.destroy');

    // Workout Plans routes
    Route::get('/workout-plans', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'index'])->name('admin.workout_plans.index');
    Route::get('/workout-plans/{id}', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'show'])->name('admin.workout_plans.show');
    Route::get('/workout-plans/create', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'create'])->name('admin.workout_plans.create');
    Route::post('/workout-plans', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'store'])->name('admin.workout_plans.store');
    Route::get('/workout-plans/{id}/edit', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'edit'])->name('admin.workout_plans.edit');
    Route::patch('/workout-plans/{id}', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'update'])->name('admin.workout_plans.update');
    Route::delete('/workout-plans/{id}', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'destroy'])->name('admin.workout_plans.destroy');
    Route::get('/workout-plans/{id}/exercises', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'exercises'])->name('admin.workout_plans.exercises');
    Route::post('/workout-plans/{workoutPlanId}/exercises', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'addExercise'])->name('admin.workout_plans.add_exercise');
    Route::delete('/workout-plans/{workoutPlanId}/exercises/{exerciseId}', [\App\Http\Controllers\AdminWorkoutPlanController::class, 'deleteExercise'])->name('admin.workout_plans.delete_exercise');


});
// Trainor dashboard route
Route::middleware(['auth', 'verified', 'trainor'])->group(function () {
    Route::get('/trainor/dashboard', [TrainorDashboardController::class, 'index'])
        ->name('trainor.dashboard');
    Route::get('/trainor/profile', [TrainorDashboardController::class, 'profile'])
        ->name('trainor.profile');
    Route::patch('/trainor/profile', [TrainorDashboardController::class, 'updateProfile'])
        ->name('trainor.profile.update');
    Route::get('/trainor/members', [TrainorDashboardController::class, 'members'])
        ->name('trainor.members');

    Route::get('/trainor/attendance', [\App\Http\Controllers\TrainorController::class, 'attendanceIndex'])
        ->name('trainor.attendance');
    Route::post('/trainor/attendance', [\App\Http\Controllers\TrainorController::class, 'markAttendance'])
        ->name('trainor.attendance.mark');
    Route::get('/trainor/schedule', [TrainorDashboardController::class, 'schedule'])
        ->name('trainor.schedule');
    Route::get('/trainor/schedule/events', [TrainorDashboardController::class, 'getScheduleEvents'])
        ->name('trainor.schedule.events');

    // Workout Plans routes
    Route::get('/trainor/workout-plans', [\App\Http\Controllers\WorkoutPlanController::class, 'index'])
        ->name('workout_plans.index');
    Route::get('/trainor/workout-plans/{id}', [\App\Http\Controllers\WorkoutPlanController::class, 'show'])
        ->name('workout_plans.show');
    Route::get('/trainor/workout-plans/create', [\App\Http\Controllers\WorkoutPlanController::class, 'create'])
        ->name('workout_plans.create');
    Route::post('/trainor/workout-plans', [\App\Http\Controllers\WorkoutPlanController::class, 'store'])
        ->name('workout_plans.store');
    Route::get('/trainor/workout-plans/{id}/edit', [\App\Http\Controllers\WorkoutPlanController::class, 'edit'])
        ->name('workout_plans.edit');
    Route::patch('/trainor/workout-plans/{id}', [\App\Http\Controllers\WorkoutPlanController::class, 'update'])
        ->name('workout_plans.update');
    Route::delete('/trainor/workout-plans/{id}', [\App\Http\Controllers\WorkoutPlanController::class, 'destroy'])
        ->name('workout_plans.destroy');
    Route::get('/trainor/workout-plans/{id}/exercises', [\App\Http\Controllers\WorkoutPlanController::class, 'exercises'])
        ->name('workout_plans.exercises');
    Route::post('/trainor/workout-plans/{workoutPlanId}/exercises', [\App\Http\Controllers\WorkoutPlanController::class, 'addExercise'])
        ->name('workout_plans.add_exercise');
    Route::delete('/trainor/workout-plans/{workoutPlanId}/exercises/{exerciseId}', [\App\Http\Controllers\WorkoutPlanController::class, 'deleteExercise'])
        ->name('workout_plans.delete_exercise');
    Route::post('/trainor/workout-plans/{id}/suggest', [\App\Http\Controllers\WorkoutPlanController::class, 'suggestToMember'])
        ->name('workout_plans.suggest');
    Route::get('/trainor/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('trainor.messages');
    Route::post('/trainor/messages', [\App\Http\Controllers\MessageController::class, 'store'])->name('trainor.messages.store');

    // Progress Tracking routes
    Route::get('/trainor/progress', [\App\Http\Controllers\TrainorProgressController::class, 'index'])->name('trainor.progress.index');
    Route::post('/trainor/progress', [\App\Http\Controllers\TrainorProgressController::class, 'store'])->name('trainor.progress.store');
    Route::patch('/trainor/progress/{id}', [\App\Http\Controllers\TrainorProgressController::class, 'update'])->name('trainor.progress.update');
    Route::get('/trainor/progress/member-history/{memberId}', [\App\Http\Controllers\TrainorProgressController::class, 'memberHistory'])->name('trainor.progress.member_history');
});

// Member portal route
Route::get('/member-portal', [\App\Http\Controllers\MemberController::class, 'memberPortal'])
    ->middleware(['member'])
    ->name('member-portal');

// Member profile routes
Route::middleware(['auth', 'verified', 'member'])->group(function () {
    Route::get('/member/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::patch('/member/profile', [MemberController::class, 'updateProfile'])->name('member.profile.update');
    Route::get('/member/workout-plans', [MemberController::class, 'workoutPlans'])->name('member.workout_plans.index');
    Route::get('/member/workout-plans/{id}', [MemberController::class, 'showWorkoutPlan'])->name('member.workout_plans.show');
    Route::get('/member/attendance', [MemberController::class, 'attendance'])->name('member.attendance');
    Route::get('/member/products', [MemberController::class, 'products'])->name('member.products');
    Route::post('/member/orders', [MemberController::class, 'storeOrder'])->name('member.orders.store');
    Route::get('/member/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('member.messages');
    Route::post('/member/messages', [\App\Http\Controllers\MessageController::class, 'store'])->name('member.messages.store');
    Route::get('/member/progress', [\App\Http\Controllers\MemberProgressController::class, 'index'])->name('member.progress.index');
    Route::post('/chatbot/chat', [\App\Http\Controllers\ChatbotController::class, 'chat'])->name('chatbot.chat');
});

require __DIR__.'/auth.php';
