<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-amber-200 bg-gradient-to-b from-[#F9FBE7] via-[#F0EDD4] to-[#ECCDB4] dark:border-amber-300 dark:bg-gradient-to-b dark:from-[#F9FBE7] dark:via-[#F0EDD4] dark:to-[#ECCDB4]">
            <flux:sidebar.toggle class="lg:hidden text-amber-800 hover:text-amber-900" icon="x-mark" />

            <!-- Logo Section -->
            <div class="mb-6 p-4 bg-white/50 dark:bg-white/20 rounded-lg mx-4 mt-4 shadow-sm border border-amber-200">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center space-x-2 rtl:space-x-reverse" wire:navigate>
                    <x-app-logo />
                </a>
            </div>

            <!-- User Profile Section - Moved below logo -->
            <div class="mx-4 mb-6">
                <div class="bg-white/60 dark:bg-white/30 rounded-xl p-4 shadow-sm border border-amber-200">
                    <div class="flex items-center gap-3">
                        <span class="relative flex h-12 w-12 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-[#FEA1A1] to-[#ECCDB4] p-0.5">
                            <span class="flex h-full w-full items-center justify-center rounded-full bg-white text-[#FFCFCF] font-bold text-lg">
                                {{ Str::limit(auth()->user()->initials(), 2, '') }}
                            </span>
                        </span>
                        <div class="grid flex-1 text-start">
                            <span class="truncate font-semibold text-amber-900 text-sm">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs text-amber-700">{{ auth()->user()->email }}</span>
                            <div class="flex items-center gap-1 mt-1">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <span class="text-xs text-amber-600">Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="mx-4 mb-6">
                <div class="bg-gradient-to-r from-[#FEA1A1]/20 to-[#ECCDB4]/20 rounded-lg p-3 border border-[#FEA1A1]/30">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-[#FEA1A1] rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFCFCF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-amber-900">Selamat Datang!</p>
                            <p class="text-xs text-amber-700">Sistem Manajemen PKL</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Lists with enhanced styling -->
            <div class="space-y-4 px-4">
                <flux:navlist variant="outline" class="bg-white/40 dark:bg-white/20 rounded-lg p-2 shadow-sm">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200">{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist>
                
                <flux:navlist variant="outline" class="bg-white/40 dark:bg-white/20 rounded-lg p-2 shadow-sm">
                    <flux:navlist.group :heading="__('Data Personal')" class="grid">
                        <div class="mb-2">
                            <h3 class="text-xs font-semibold text-amber-800 uppercase tracking-wider px-2 py-1 bg-[#F0EDD4]/50 rounded-md">{{ __('Data Personal') }}</h3>
                        </div>
                        <flux:navlist.item icon="user" :href="route('siswa')" :current="request()->routeIs('siswa')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('Siswa') }}</flux:navlist.item>
                        <flux:navlist.item icon="academic-cap" :href="route('guru')" :current="request()->routeIs('guru')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('Guru') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                <flux:navlist variant="outline" class="bg-white/40 dark:bg-white/20 rounded-lg p-2 shadow-sm">
                    <flux:navlist.group :heading="__('Data PKL')" class="grid">
                        <div class="mb-2">
                            <h3 class="text-xs font-semibold text-amber-800 uppercase tracking-wider px-2 py-1 bg-[#F0EDD4]/50 rounded-md">{{ __('Data PKL') }}</h3>
                        </div>
                        <flux:navlist.item icon="building-office-2" :href="route('industri')" :current="request()->routeIs('industri')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('Industri') }}</flux:navlist.item>
                        <flux:navlist.item icon="briefcase" :href="route('pkl')" :current="request()->routeIs('pkl')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('Status PKL') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>

                @if(auth()->user() && auth()->user()->hasRole('super_admin'))
                <flux:navlist variant="outline" class="bg-white/40 dark:bg-white/20 rounded-lg p-2 shadow-sm">
                    <flux:navlist.group :heading="__('Data Khusus Admin')" class="grid">
                        <div class="mb-2">
                            <h3 class="text-xs font-semibold text-amber-800 uppercase tracking-wider px-2 py-1 bg-[#FEA1A1]/30 rounded-md">{{ __('Data Khusus Admin') }}</h3>
                        </div>
                        <flux:navlist.item icon="user" :href="route('siswa')" :current="request()->routeIs('user')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('User') }}</flux:navlist.item>
                        <flux:navlist.item icon="shield-check" :href="route('siswa')" :current="request()->routeIs('role')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200 ml-2">{{ __('Tipe Akun (Role)') }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
                @endif
            </div>

            <!-- Statistics Card -->
            <div class="mx-4 my-6">
                <div class="bg-gradient-to-br from-[#ECCDB4]/30 to-[#FEA1A1]/20 rounded-lg p-4 border border-[#ECCDB4]/50">
                    <h4 class="font-semibold text-amber-900 text-sm mb-3">Statistik Cepat</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/60 rounded-lg p-2 text-center">
                            <div class="text-lg font-bold text-[#FEA1A1]">24</div>
                            <div class="text-xs text-amber-700">Siswa</div>
                        </div>
                        <div class="bg-white/60 rounded-lg p-2 text-center">
                            <div class="text-lg font-bold text-[#FEA1A1]">8</div>
                            <div class="text-xs text-amber-700">Guru</div>
                        </div>
                    </div>
                </div>
            </div>

            <flux:spacer />

            <!-- Bottom Navigation -->
            <div class="px-4 pb-4">
                <flux:navlist variant="outline" class="bg-white/40 dark:bg-white/20 rounded-lg p-2 shadow-sm">
                    <flux:navlist.item icon="home" :href="route('home')" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20 hover:text-amber-900 rounded-md transition-all duration-200">{{ __('Kembali') }}</flux:navlist.item>
                </flux:navlist>

                <!-- Desktop User Menu -->
                <div class="mt-4">
                    <flux:dropdown position="bottom" align="start">
                        <div class="w-full bg-[#FEA1A1]/20 hover:bg-[#FEA1A1]/30 rounded-lg p-2 transition-all duration-200 cursor-pointer border border-[#FEA1A1]/30">
                            <flux:profile
                                :name="auth()->user()->name"
                                icon-trailing="chevrons-up-down"
                                class="text-amber-900"
                            />
                        </div>

                        <flux:menu class="w-[220px] bg-[#F9FBE7] border-[#ECCDB4]">
                            <flux:menu.radio.group>
                                <div class="p-0 text-sm font-normal">
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                            <span class="flex h-full w-full items-center justify-center rounded-lg bg-[#FEA1A1] text-[#FFCFCF] font-semibold">
                                                {{ Str::limit(auth()->user()->initials(), 2, '') }}
                                            </span>
                                        </span>

                                        <div class="grid flex-1 text-start text-sm leading-tight">
                                            <span class="truncate font-semibold text-amber-900">{{ auth()->user()->name }}</span>
                                            <span class="truncate text-xs text-amber-700">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <flux:menu.radio.group>
                                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20">{{ __('Setting') }}</flux:menu.item>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-amber-800 hover:bg-[#FEA1A1]/20">
                                    {{ __('Log Out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden bg-gradient-to-r from-[#F9FBE7] to-[#F0EDD4] border-b border-[#ECCDB4]">
            <flux:sidebar.toggle class="lg:hidden text-amber-800 hover:text-amber-900" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <div class="bg-[#FEA1A1]/20 hover:bg-[#FEA1A1]/30 rounded-lg p-1 transition-all duration-200">
                    <flux:profile
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevron-down"
                        class="text-amber-900"
                    />
                </div>

                <flux:menu class="bg-[#F9FBE7] border-[#ECCDB4]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-[#FEA1A1] text-[#FFCFCF] font-semibold">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-amber-900">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-amber-700">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-amber-800 hover:bg-[#FEA1A1]/20">{{ __('Setting') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-amber-800 hover:bg-[#FEA1A1]/20">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>