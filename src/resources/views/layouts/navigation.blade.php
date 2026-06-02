<nav x-data="{ open: false }" class="bg-surface border-b border-surface-border">
    <div class="container-page">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-white">
                        Clyrion <span class="text-brand-500">Studio</span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-8 space-x-1">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md transition {{ request()->routeIs('admin.projects.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.tags.*') || request()->routeIs('admin.tutorials.*') || request()->routeIs('admin.series.*') || request()->routeIs('admin.users.*') || request()->routeIs('admin.services.*') ? 'text-brand-400 bg-brand-500/10' : 'text-gray-400 hover:text-white hover:bg-surface-hover' }}">
                            Contenido
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute top-full left-0 mt-1 w-48 rounded-lg bg-surface-card border border-surface-border shadow-xl py-1 z-50">
                            <a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Proyectos</a>
                            <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Blog posts</a>
                            <a href="{{ route('admin.tutorials.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Tutoriales</a>
                            <a href="{{ route('admin.series.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Series</a>
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Usuarios</a>
                            {{-- Servicios: CRUD dinámico visible en homepage --}}
                            <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Servicios</a>
                            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Categorías</a>
                            <a href="{{ route('admin.tags.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Tags</a>
                            <a href="{{ route('admin.blocks.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">Bloques</a>
                            <a href="{{ route('admin.seo.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-surface-hover transition">SEO</a>
                        </div>
                    </div>

                    <x-nav-link :href="route('admin.media.index')" :active="request()->routeIs('admin.media.*')">
                        Media
                    </x-nav-link>

                    <x-nav-link :href="route('admin.messages.index')" :active="request()->routeIs('admin.messages.*')">
                        Mensajes
                    </x-nav-link>

                    <x-nav-link :href="route('admin.analytics.index')" :active="request()->routeIs('admin.analytics.*')">
                        Analytics
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-surface-card hover:text-white focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-surface-hover focus:outline-none focus:bg-surface-hover focus:text-white transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.*')">
                Proyectos
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">
                Blog
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tutorials.index')" :active="request()->routeIs('admin.tutorials.*')">
                Tutoriales
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.series.index')" :active="request()->routeIs('admin.series.*')">
                Series
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                Categorías
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tags.index')" :active="request()->routeIs('admin.tags.*')">
                Tags
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                Usuarios
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.media.index')" :active="request()->routeIs('admin.media.*')">
                Media
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.messages.index')" :active="request()->routeIs('admin.messages.*')">
                Mensajes
            </x-responsive-nav-link>
            {{-- Servicios: gestión desde dispositivos móviles --}}
            <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                Servicios
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.analytics.index')" :active="request()->routeIs('admin.analytics.*')">
                Analytics
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.blocks.index')" :active="request()->routeIs('admin.blocks.*')">
                Bloques
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.seo.index')" :active="request()->routeIs('admin.seo.*')">
                SEO
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')">
                Ver sitio
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-surface-border">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
