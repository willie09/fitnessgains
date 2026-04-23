     <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Members List') }}
        </h2>
    </x-slot>

    <div class="relative z-10 rounded-xl py-4 sm:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-2 font-medium text-sm text-red-600 dark:text-red-400">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-end mb-3">
                        <x-primary-button x-data="" x-on:click="$dispatch('open-modal', 'add-member')">
                            {{ __('Add New Member') }}
                        </x-primary-button>
                    </div>

                    <x-modal name="add-member" focusable>
                        <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="p-6">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add New Member') }}
                            </h2>

                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" />
                                <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="weight" :value="__('Weight (kg)')" />
                                <x-text-input id="weight" class="block mt-1 w-full" type="number" step="0.01" name="weight" />
                                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="membership_type" :value="__('Membership Type')" />
                                <select id="membership_type" name="membership_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="basic">Basic</option>
                                    <option value="premium">Premium</option>
                                    <option value="vip">VIP</option>
                                </select>
                                <x-input-error :messages="$errors->get('membership_type')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="trainor_id" :value="__('Assigned Trainor')" />
                                <select
                                    id="trainor_id"
                                    name="trainor_id"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                >
                                    <option value="">No Trainor</option>
                                    @foreach(\App\Models\Trainor::all() as $trainor)
                                        <option value="{{ $trainor->id }}">{{ $trainor->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('trainor_id')" class="mt-2" />
                            </div>



                            <div class="mt-4">
                                <x-input-label for="profile_photo" :value="__('Profile Photo')" />
                                <x-text-input id="profile_photo" class="block mt-1 w-full" type="file" name="profile_photo" accept="image/*" />
                                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="expiry_date" :value="__('Expiry Date')" />
                                <x-text-input id="expiry_date" class="block mt-1 w-full" type="date" name="expiry_date" required />
                                <x-input-error :messages="$errors->get('expiry_date')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-primary-button type="button" x-on:click="$dispatch('close-modal', 'add-member')" >
                                    {{ __('Cancel') }}
                                </x-primary-button>

                                <x-primary-button class="ml-3">
                                    {{ __('Save Member') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-2">
                        {{ __('Expiring Members (Within 7 Days)') }}
                    </h3>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($expiringMembers as $member)
                                <tr>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $member->name }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->email }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->expiry_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <button
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', 'renew-member-{{ $member->id }}')"
                                            class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 mr-3"
                                        >
                                            Renew
                                        </button>
                                        <form method="POST" action="{{ route('members.notifyMember', $member->id) }}" class="inline">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300"
                                            >
                                                Notify
                                            </button>
                                        </form>

                                        <x-modal name="renew-member-{{ $member->id }}" focusable>
                                            <form method="POST" action="{{ route('members.renew', $member->id) }}" class="p-6">
                                                @csrf
                                                @method('PATCH')
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                    {{ __('Renew Member') }}
                                                </h2>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-membership_type-{{ $member->id }}" :value="__('Membership Type')" />
                                                    <select
                                                        id="renew-membership_type-{{ $member->id }}"
                                                        name="membership_type"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                        required
                                                    >
                                                        <option value="basic" {{ $member->membership_type === 'basic' ? 'selected' : '' }}>Basic</option>
                                                        <option value="premium" {{ $member->membership_type === 'premium' ? 'selected' : '' }}>Premium</option>
                                                        <option value="vip" {{ $member->membership_type === 'vip' ? 'selected' : '' }}>VIP</option>
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-trainor_id-{{ $member->id }}" :value="__('Assigned Trainor')" />
                                                    <select
                                                        id="renew-trainor_id-{{ $member->id }}"
                                                        name="trainor_id"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >
                                                        <option value="">No Trainor</option>
                                                        @foreach(\App\Models\Trainor::all() as $trainor)
                                                            <option value="{{ $trainor->id }}" {{ $member->trainor_id == $trainor->id ? 'selected' : '' }}>{{ $trainor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-expiry_date-{{ $member->id }}" :value="__('Expiry Date')" />
                                                    <x-text-input
                                                        id="renew-expiry_date-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="date"
                                                        name="expiry_date"
                                                        value="{{ $member->expiry_date->format('Y-m-d') }}"
                                                        required
                                                    />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-primary-button type="button" x-on:click="$dispatch('close-modal', 'renew-member-{{ $member->id }}')">
                                                        {{ __('Cancel') }}
                                                    </x-primary-button>

                                                    <x-primary-button class="ml-3">
                                                        {{ __('Renew Member') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>

                                        <x-modal name="view-member-{{ $member->id }}" focusable>
                                            <div class="p-6">
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                    {{ __('View Member Details') }}
                                                </h2>

                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Name') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->name }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Email') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->email }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Contact Number') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->contact_number ?? 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Gender') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ ucfirst($member->gender ?? 'N/A') }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Date of Birth') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->date_of_birth ? $member->date_of_birth->format('M d, Y') : 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Weight (kg)') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->weight ?? 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Membership Type') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ ucfirst($member->membership_type) }} - P{{ $membershipPrices[$member->membership_type] }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Assigned Trainor') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->trainor ? $member->trainor->name : 'No Trainor Assigned' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Join Date') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->join_date->format('M d, Y') }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Expiry Date') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->expiry_date->format('M d, Y') }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ __('Address') }}
                                                        </label>
                                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded min-h-[60px]">
                                                            {{ $member->address ?? 'N/A' }}
                                                        </p>
                                                    </div>

                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ __('Random Password') }}
                                                        </label>
                                                        <div class="mt-1 flex items-center">
                                                            <span class="font-mono text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded flex-1">
                                                                {{ $member->random_password ?? 'N/A' }}
                                                            </span>
                                                            @if($member->random_password)
                                                                <button
                                                                    onclick="navigator.clipboard.writeText('{{ $member->random_password }}')"
                                                                    class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                                                    title="Copy password"
                                                                >
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                                    </svg>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-primary-button x-on:click="$dispatch('close-modal', 'view-member-{{ $member->id }}')">
                                                        {{ __('Close') }}
                                                    </x-primary-button>
                                                </div>
                                            </div>
                                        </x-modal>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-8">
                        {{ __('Expired Members') }}
                    </h3>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Membership
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th scope="col" class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($expiredMembers as $member)
                                <tr>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $member->name }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->email }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap">
                                        @php
                                            $badgeClasses = [
                                                'basic' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'premium' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                                'vip' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClasses[$member->membership_type] }}">
                                            {{ ucfirst($member->membership_type) }} - P{{ $membershipPrices[$member->membership_type] }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->expiry_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-2 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <button
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', 'renew-expired-member-{{ $member->id }}')"
                                            class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 mr-3"
                                        >
                                            Renew
                                        </button>
                                       

                                        <x-modal name="renew-expired-member-{{ $member->id }}" focusable>
                                            <form method="POST" action="{{ route('members.renew', $member->id) }}" class="p-6">
                                                @csrf
                                                @method('PATCH')
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                    {{ __('Renew Member') }}
                                                </h2>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-expired-membership_type-{{ $member->id }}" :value="__('Membership Type')" />
                                                    <select
                                                        id="renew-expired-membership_type-{{ $member->id }}"
                                                        name="membership_type"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                        required
                                                    >
                                                        <option value="basic" {{ $member->membership_type === 'basic' ? 'selected' : '' }}>Basic</option>
                                                        <option value="premium" {{ $member->membership_type === 'premium' ? 'selected' : '' }}>Premium</option>
                                                        <option value="vip" {{ $member->membership_type === 'vip' ? 'selected' : '' }}>VIP</option>
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-expired-trainor_id-{{ $member->id }}" :value="__('Assigned Trainor')" />
                                                    <select
                                                        id="renew-expired-trainor_id-{{ $member->id }}"
                                                        name="trainor_id"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >
                                                        <option value="">No Trainor</option>
                                                        @foreach(\App\Models\Trainor::all() as $trainor)
                                                            <option value="{{ $trainor->id }}" {{ $member->trainor_id == $trainor->id ? 'selected' : '' }}>{{ $trainor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="renew-expired-expiry_date-{{ $member->id }}" :value="__('Expiry Date')" />
                                                    <x-text-input
                                                        id="renew-expired-expiry_date-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="date"
                                                        name="expiry_date"
                                                        value="{{ now()->addDays(30)->format('Y-m-d') }}"
                                                        required
                                                    />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-primary-button type="button" x-on:click="$dispatch('close-modal', 'renew-expired-member-{{ $member->id }}')">
                                                        {{ __('Cancel') }}
                                                    </x-primary-button>

                                                    <x-primary-button class="ml-3">
                                                        {{ __('Renew Member') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mt-8">
                        {{ __('All Members') }}
                    </h3>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Membership
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Join Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Password
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Option
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($members as $member)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $member->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $badgeClasses = [
                                                'basic' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'premium' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                                'vip' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClasses[$member->membership_type] }}">
                                            {{ ucfirst($member->membership_type) }} - P{{ $membershipPrices[$member->membership_type] }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->join_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $member->expiry_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                            {{ $member->random_password ?? 'N/A' }}
                                        </span>
                                        <button 
                                            onclick="navigator.clipboard.writeText('{{ $member->random_password ?? 'N/A' }}')"
                                            class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                            title="Copy password"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <button
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', 'view-member-{{ $member->id }}')"
                                            class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 mr-3"
                                        >
                                            View
                                        </button>
                                        <button
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', 'edit-member-{{ $member->id }}')"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3"
                                        >
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('members.destroy', $member->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="button"
                                                onclick="confirm('Are you sure you want to delete this member?') && this.form.submit()"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                        

                                        <x-modal name="edit-member-{{ $member->id }}" focusable>
                                            <form method="POST" action="{{ route('members.update', $member->id) }}" class="p-6">
                                                @csrf
                                                @method('PATCH')
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                    {{ __('Edit Member') }}
                                                </h2>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-name-{{ $member->id }}" :value="__('Name')" />
                                                    <x-text-input
                                                        id="edit-name-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="text"
                                                        name="name"
                                                        value="{{ $member->name }}"
                                                        required
                                                    />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-email-{{ $member->id }}" :value="__('Email')" />
                                                    <x-text-input
                                                        id="edit-email-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="email"
                                                        name="email"
                                                        value="{{ $member->email }}"
                                                        required
                                                    />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-contact_number-{{ $member->id }}" :value="__('Contact Number')" />
                                                    <x-text-input
                                                        id="edit-contact_number-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="text"
                                                        name="contact_number"
                                                        value="{{ $member->contact_number }}"
                                                    />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-address-{{ $member->id }}" :value="__('Address')" />
                                                    <textarea
                                                        id="edit-address-{{ $member->id }}"
                                                        name="address"
                                                        rows="3"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >{{ $member->address }}</textarea>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-gender-{{ $member->id }}" :value="__('Gender')" />
                                                    <select
                                                        id="edit-gender-{{ $member->id }}"
                                                        name="gender"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >
                                                        <option value="">Select Gender</option>
                                                        <option value="male" {{ $member->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ $member->gender === 'female' ? 'selected' : '' }}>Female</option>
                                                        <option value="other" {{ $member->gender === 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-date_of_birth-{{ $member->id }}" :value="__('Date of Birth')" />
                                                    <x-text-input
                                                        id="edit-date_of_birth-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="date"
                                                        name="date_of_birth"
                                                        value="{{ $member->date_of_birth ? $member->date_of_birth->format('Y-m-d') : '' }}"
                                                    />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-weight-{{ $member->id }}" :value="__('Weight (kg)')" />
                                                    <x-text-input
                                                        id="edit-weight-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="number"
                                                        step="0.01"
                                                        name="weight"
                                                        value="{{ $member->weight }}"
                                                    />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-membership_type-{{ $member->id }}" :value="__('Membership Type')" />
                                                    <select
                                                        id="edit-membership_type-{{ $member->id }}"
                                                        name="membership_type"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >
                                                        <option value="basic" {{ $member->membership_type === 'basic' ? 'selected' : '' }}>Basic</option>
                                                        <option value="premium" {{ $member->membership_type === 'premium' ? 'selected' : '' }}>Premium</option>
                                                        <option value="vip" {{ $member->membership_type === 'vip' ? 'selected' : '' }}>VIP</option>
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-trainor_id-{{ $member->id }}" :value="__('Assigned Trainor')" />
                                                    <select
                                                        id="edit-trainor_id-{{ $member->id }}"
                                                        name="trainor_id"
                                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                                    >
                                                        <option value="">No Trainor</option>
                                                        @foreach(\App\Models\Trainor::all() as $trainor)
                                                            <option value="{{ $trainor->id }}" {{ $member->trainor_id == $trainor->id ? 'selected' : '' }}>{{ $trainor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="edit-expiry_date-{{ $member->id }}" :value="__('Expiry Date')" />
                                                    <x-text-input
                                                        id="edit-expiry_date-{{ $member->id }}"
                                                        class="block mt-1 w-full"
                                                        type="date"
                                                        name="expiry_date"
                                                        value="{{ $member->expiry_date->format('Y-m-d') }}"
                                                        required
                                                    />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-primary-button type="button" x-on:click="$dispatch('close-modal', 'edit-member-{{ $member->id }}')">
                                                        {{ __('Cancel') }}
                                                    </x-primary-button>

                                                    <x-primary-button class="ml-3">
                                                        {{ __('Update Member') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>

                                        <x-modal name="view-member-{{ $member->id }}" focusable>
                                            <div class="p-6">
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                                    {{ __('View Member Details') }}
                                                </h2>

                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Name') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->name }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Email') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->email }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Contact Number') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->contact_number ?? 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Gender') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ ucfirst($member->gender ?? 'N/A') }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Date of Birth') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->date_of_birth ? $member->date_of_birth->format('M d, Y') : 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Weight (kg)') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->weight ?? 'N/A' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Membership Type') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ ucfirst($member->membership_type) }} - P{{ $membershipPrices[$member->membership_type] }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Assigned Trainor') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->trainor ? $member->trainor->name : 'No Trainor Assigned' }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Join Date') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->join_date->format('M d, Y') }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ __('Expiry Date') }}
                                                            </label>
                                                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                                                {{ $member->expiry_date->format('M d, Y') }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ __('Address') }}
                                                        </label>
                                                        <p class="mt-1 text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded min-h-[60px]">
                                                            {{ $member->address ?? 'N/A' }}
                                                        </p>
                                                    </div>

                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ __('Random Password') }}
                                                        </label>
                                                        <div class="mt-1 flex items-center">
                                                            <span class="font-mono text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded flex-1">
                                                                {{ $member->random_password ?? 'N/A' }}
                                                            </span>
                                                            @if($member->random_password)
                                                                <button
                                                                    onclick="navigator.clipboard.writeText('{{ $member->random_password }}')"
                                                                    class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                                                    title="Copy password"
                                                                >
                                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                                    </svg>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-primary-button x-on:click="$dispatch('close-modal', 'view-member-{{ $member->id }}')">
                                                        {{ __('Close') }}
                                                    </x-primary-button>
                                                </div>
                                            </div>
                                        </x-modal>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
