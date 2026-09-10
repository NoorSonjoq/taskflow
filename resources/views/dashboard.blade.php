<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-boldtext-slate-800">لوحة التحكم</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl px-4 space-y-8">

            {{-- Welcome --}}
            <div class="animate-fade-in">
                <h1 class="text-2xl font-bold text-slate-800">أهلاً <span class="gradient-text">{{ auth()->user()->name }}</span> 👋</h1>
                <p class="mt-1 text-dark-400">هاي نظرة سريعة على مهامك ومشاريعك.</p>
            </div>

            {{-- Stats Grid --}}
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                {{-- المشاريع --}}
                <div class="glass-card stat-card stat-indigo p-5 animate-slide-up stagger-1">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(99,102,241,0.05)); border: 1px solid rgba(99,102,241,0.15);">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">المشاريع</p>
                            <p class="text-2xl font-bold text-slate-800">{{ $stats['projects'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- إجمالي المهام --}}
                <div class="glass-card stat-card stat-gray p-5 animate-slide-up stagger-2">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(148,163,184,0.2), rgba(148,163,184,0.05)); border: 1px solid rgba(148,163,184,0.15);">
                            <svg class="w-5 h-5 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">إجمالي المهام</p>
                            <p class="text-2xl font-bold text-slate-800">{{ $stats['tasks'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- مكتملة --}}
                <div class="glass-card stat-card stat-emerald p-5 animate-slide-up stagger-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.05)); border: 1px solid rgba(16,185,129,0.15);">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">مكتملة</p>
                            <p class="text-2xl font-bold text-emerald-400">{{ $stats['done'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- قيد التنفيذ --}}
                <div class="glass-card stat-card stat-blue p-5 animate-slide-up stagger-4">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.05)); border: 1px solid rgba(59,130,246,0.15);">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">قيد التنفيذ</p>
                            <p class="text-2xl font-bold text-blue-400">{{ $stats['in_progress'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- قيد الانتظار --}}
                <div class="glass-card stat-card stat-slate p-5 animate-slide-up stagger-5">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(100,116,139,0.2), rgba(100,116,139,0.05)); border: 1px solid rgba(100,116,139,0.15);">
                            <svg class="w-5 h-5 text-dark-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">قيد الانتظار</p>
                            <p class="text-2xl font-bold text-dark-300">{{ $stats['todo'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- متأخرة --}}
                <div class="glass-card stat-card stat-red p-5 animate-slide-up stagger-6">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl" style="background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(239,68,68,0.05)); border: 1px solid rgba(239,68,68,0.15);">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-dark-400 font-medium">متأخرة</p>
                            <p class="text-2xl font-bold text-red-400">{{ $stats['overdue'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="flex flex-wrap gap-3 animate-fade-in" style="animation-delay: 0.4s;">
                <a href="{{ route('projects.index') }}" class="btn-gradient inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    <span>مشاريعي</span>
                </a>
                <a href="{{ route('tasks.index') }}" class="btn-ghost inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>كل المهام</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>