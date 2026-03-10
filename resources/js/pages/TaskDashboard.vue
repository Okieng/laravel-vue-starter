<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { ChevronLeft, ChevronRight, X, User, CalendarDays, Flag, Clock } from 'lucide-vue-next';

interface Task {
    id: number;
    title: string;
    description: string | null;
    pic_name: string;
    start_date: string;
    end_date: string;
    status: 'ongoing' | 'completed' | 'past_due';
    priority: string;
}

const props = defineProps<{
    tasks: Task[];
}>();

const breadcrumbs = [
    { title: 'Task Dashboard', href: '/task-dashboard' },
];

// Calendar state
const today = new Date();
const currentYear = ref(today.getFullYear());
const currentMonth = ref(today.getMonth()); // 0-indexed

const selectedDate = ref<string | null>(null);
const selectedTask = ref<Task | null>(null);
const isSlideOpen = ref(false);

const monthNames = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December',
];
const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

// Navigate months
const prevMonth = () => {
    if (currentMonth.value === 0) { currentMonth.value = 11; currentYear.value--; }
    else currentMonth.value--;
};
const nextMonth = () => {
    if (currentMonth.value === 11) { currentMonth.value = 0; currentYear.value++; }
    else currentMonth.value++;
};

// Build calendar grid (6 rows × 7 cols)
const calendarDays = computed(() => {
    const year = currentYear.value;
    const month = currentMonth.value;
    const firstDay = new Date(year, month, 1).getDay(); // 0=Sun
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const cells: (number | null)[] = [];
    for (let i = 0; i < firstDay; i++) cells.push(null);
    for (let d = 1; d <= daysInMonth; d++) cells.push(d);
    while (cells.length % 7 !== 0) cells.push(null);
    return cells;
});

// Format date to YYYY-MM-DD for comparison
const formatDate = (year: number, month: number, day: number) =>
    `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

// Get dot colors for a given day
const getDotsForDay = (day: number | null): string[] => {
    if (!day) return [];
    const dateStr = formatDate(currentYear.value, currentMonth.value, day);
    const colors: string[] = [];
    props.tasks.forEach(t => {
        if (t.start_date <= dateStr && t.end_date >= dateStr) {
            if (t.status === 'completed') {
                if (!colors.includes('green')) colors.push('green');
            } else if (t.status === 'past_due') {
                if (!colors.includes('red')) colors.push('red');
            } else {
                if (!colors.includes('blue')) colors.push('blue');
            }
        }
    });
    return colors;
};

const dotClass = (color: string) => {
    return {
        blue: 'bg-blue-500',
        green: 'bg-emerald-500',
        red: 'bg-red-500',
    }[color] ?? 'bg-gray-400';
};

// Tasks for selected date
const tasksOnSelectedDate = computed(() => {
    if (!selectedDate.value) return [];
    return props.tasks.filter(t =>
        t.start_date <= selectedDate.value! && t.end_date >= selectedDate.value!
    );
});

// Click a calendar day
const selectDay = (day: number | null) => {
    if (!day) return;
    selectedDate.value = formatDate(currentYear.value, currentMonth.value, day);
    selectedTask.value = null;
    isSlideOpen.value = false;
};

// Click a task card in right panel
const openTask = (task: Task) => {
    selectedTask.value = task;
    isSlideOpen.value = true;
};

const closeSlide = () => {
    isSlideOpen.value = false;
    setTimeout(() => { selectedTask.value = null; }, 300);
};

// Status helpers
const statusLabel = (s: string) => ({ ongoing: 'Ongoing', completed: 'Completed', past_due: 'Past Due' }[s] ?? s);
const statusBadgeClass = (s: string) => ({
    ongoing: 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300',
    completed: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
    past_due: 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300',
}[s] ?? '');
const priorityBadgeClass = (p: string) => ({
    high: 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
    medium: 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
    low: 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
}[p] ?? '');

const isToday = (day: number | null) => {
    if (!day) return false;
    return (
        day === today.getDate() &&
        currentMonth.value === today.getMonth() &&
        currentYear.value === today.getFullYear()
    );
};

const isSelected = (day: number | null) => {
    if (!day) return false;
    return selectedDate.value === formatDate(currentYear.value, currentMonth.value, day);
};

const formatDisplayDate = (dateStr: string) => {
    const d = new Date(dateStr + 'T00:00:00');
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
};
</script>

<template>

    <Head title="Task Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 h-full bg-slate-100 dark:bg-[#0F1115] rounded-xl">

            <!-- Page Header -->
            <div
                class="bg-white dark:bg-[#242830] rounded-xl border border-border-light dark:border-border-dark px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Dashboard Task Management</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Itaque asperiores esse adipisci alias cum fugiat illum vero ipsum quos,
                        perspiciatis in, obcaecati minima libero cumque, autem optio placeat! Eius, et?</p>
                </div>
                <div class="flex items-center gap-3 text-xs">
                    <span class="flex items-center gap-1.5"><span
                            class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Ongoing</span>
                    <span class="flex items-center gap-1.5"><span
                            class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span> Completed</span>
                    <span class="flex items-center gap-1.5"><span
                            class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span> Past Due</span>
                </div>
            </div>

            <!-- Main Grid: Calendar + Right Panel -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 flex-1 min-h-0">

                <!-- === CALENDAR === -->
                <div
                    class="lg:col-span-3 bg-white dark:bg-[#1A1D23] rounded-xl border border-border-light dark:border-border-dark p-5 flex flex-col">

                    <!-- Month navigation -->
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-base font-bold text-gray-900 dark:text-white">
                            {{ monthNames[currentMonth] }} {{ currentYear }}
                        </h2>
                        <div class="flex items-center gap-2">
                            <button @click="prevMonth"
                                class="p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 transition-colors">
                                <ChevronLeft class="size-5" />
                            </button>
                            <button @click="nextMonth"
                                class="p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400 transition-colors">
                                <ChevronRight class="size-5" />
                            </button>
                        </div>
                    </div>

                    <!-- Day header row -->
                    <div class="grid grid-cols-7 mb-2">
                        <div v-for="day in dayNames" :key="day"
                            class="text-center text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider py-1">
                            {{ day }}
                        </div>
                    </div>

                    <!-- Calendar grid -->
                    <div class="grid grid-cols-7 gap-1 flex-1">
                        <div v-for="(day, index) in calendarDays" :key="index" @click="selectDay(day)" :class="[
                            'flex flex-col items-center rounded-xl py-2 min-h-[56px] transition-all',
                            day ? 'cursor-pointer' : 'cursor-default',
                            isSelected(day)
                                ? 'bg-primary text-white shadow-md shadow-primary/30'
                                : isToday(day)
                                    ? 'bg-primary/10 text-primary dark:bg-primary/20 font-bold'
                                    : day
                                        ? 'hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300'
                                        : 'opacity-0 pointer-events-none',
                        ]">
                            <span :class="[
                                'text-sm font-semibold leading-none mb-1.5',
                                isSelected(day) ? 'text-white' : '',
                            ]">{{ day }}</span>

                            <!-- Dot indicators -->
                            <div class="flex gap-0.5 flex-wrap justify-center max-w-[36px]">
                                <span v-for="color in getDotsForDay(day)" :key="color"
                                    :class="['w-1.5 h-1.5 rounded-full inline-block', isSelected(day) ? 'bg-white/80' : dotClass(color)]">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- === RIGHT PANEL === -->
                <div
                    class="lg:col-span-2 bg-white dark:bg-[#1A1D23] rounded-xl border border-border-light dark:border-border-dark flex flex-col overflow-hidden">

                    <!-- Panel header -->
                    <div class="px-5 py-4 border-b border-border-light dark:border-border-dark flex-shrink-0">
                        <h4 class="font-bold text-gray-900 dark:text-white text-sm">
                            <template v-if="selectedDate">
                                Tasks — {{ formatDisplayDate(selectedDate) }}
                            </template>
                            <template v-else>
                                Pilih tanggal di kalender
                            </template>
                        </h4>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ selectedDate ? `${tasksOnSelectedDate.length} task ditemukan`
                                : 'Klik tanggal untuk melihat task' }}
                        </p>
                    </div>

                    <!-- Task list -->
                    <div class="flex-1 overflow-y-auto px-4 py-3 space-y-3 custom-scrollbar">

                        <!-- Empty state – no date selected -->
                        <div v-if="!selectedDate"
                            class="flex flex-col items-center justify-center h-full py-12 text-center">
                            <CalendarDays class="size-12 text-slate-200 dark:text-slate-700 mb-3" />
                            <p class="text-sm text-slate-400 dark:text-slate-500">Belum ada tanggal dipilih</p>
                        </div>

                        <!-- Empty state – date selected but no tasks -->
                        <div v-else-if="tasksOnSelectedDate.length === 0"
                            class="flex flex-col items-center justify-center h-full py-12 text-center">
                            <CalendarDays class="size-12 text-slate-200 dark:text-slate-700 mb-3" />
                            <p class="text-sm text-slate-400 dark:text-slate-500">Tidak ada task di tanggal ini</p>
                        </div>

                        <!-- Task cards -->
                        <div v-else v-for="task in tasksOnSelectedDate" :key="task.id" @click="openTask(task)"
                            class="group cursor-pointer border border-border-light dark:border-border-dark rounded-xl p-4 hover:border-primary/50 hover:shadow-sm hover:shadow-primary/10 transition-all bg-white dark:bg-[#242830]">

                            <!-- Status dot + title -->
                            <div class="flex items-start gap-3 mb-3">
                                <span :class="[
                                    'mt-1 w-2 h-2 rounded-full flex-shrink-0',
                                    task.status === 'completed' ? 'bg-emerald-500' :
                                        task.status === 'past_due' ? 'bg-red-500' : 'bg-blue-500'
                                ]"></span>
                                <h5
                                    class="text-sm font-semibold text-gray-900 dark:text-white leading-snug group-hover:text-primary transition-colors">
                                    {{ task.title }}
                                </h5>
                            </div>

                            <div class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 mb-2">
                                <User class="size-3.5" />
                                <span>{{ task.pic_name }}</span>
                            </div>

                            <div class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 mb-3">
                                <Clock class="size-3.5" />
                                <span>{{ formatDisplayDate(task.start_date) }} – {{ formatDisplayDate(task.end_date)
                                }}</span>
                            </div>

                            <div class="flex gap-2 flex-wrap">
                                <span
                                    :class="['text-[10px] font-bold px-2 py-0.5 rounded-full', statusBadgeClass(task.status)]">
                                    {{ statusLabel(task.status) }}
                                </span>
                                <span
                                    :class="['text-[10px] font-bold px-2 py-0.5 rounded-full capitalize', priorityBadgeClass(task.priority)]">
                                    {{ task.priority }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== SLIDE MODAL (half-screen, from right) ===== -->
        <Teleport to="body">
            <!-- Overlay -->
            <Transition name="fade">
                <div v-if="isSlideOpen" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm" @click="closeSlide">
                </div>
            </Transition>

            <!-- Slide panel -->
            <Transition name="slide-right">
                <div v-if="isSlideOpen && selectedTask"
                    class="fixed top-0 right-0 h-full w-full sm:w-1/2 z-50 bg-white dark:bg-[#1A1D23] shadow-2xl flex flex-col">

                    <!-- Modal Header -->
                    <div
                        class="flex items-center justify-between px-6 py-5 border-b border-border-light dark:border-border-dark flex-shrink-0">
                        <div class="flex items-center gap-3">
                            <span :class="[
                                'w-3 h-3 rounded-full',
                                selectedTask.status === 'completed' ? 'bg-emerald-500' :
                                    selectedTask.status === 'past_due' ? 'bg-red-500' : 'bg-blue-500'
                            ]"></span>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Detail Task</h3>
                        </div>
                        <button @click="closeSlide"
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                            <X class="size-5" />
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6 custom-scrollbar">

                        <!-- Title -->
                        <div>
                            <label
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Judul
                                Task</label>
                            <p class="text-xl font-bold text-gray-900 dark:text-white leading-snug">{{
                                selectedTask.title }}</p>
                        </div>

                        <!-- Status + Priority badges -->
                        <div class="flex gap-2 flex-wrap">
                            <span
                                :class="['text-xs font-bold px-3 py-1 rounded-full', statusBadgeClass(selectedTask.status)]">
                                {{ statusLabel(selectedTask.status) }}
                            </span>
                            <span
                                :class="['text-xs font-bold px-3 py-1 rounded-full capitalize flex items-center gap-1', priorityBadgeClass(selectedTask.priority)]">
                                <Flag class="size-3" /> {{ selectedTask.priority }} Priority
                            </span>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-border-light dark:border-border-dark"></div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 gap-5">

                            <!-- PIC -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <User class="size-5 text-primary" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">
                                        Person in
                                        Charge</p>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{
                                        selectedTask.pic_name
                                    }}</p>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                                    <CalendarDays class="size-5 text-blue-500" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">
                                        Start Date
                                    </p>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{
                                        formatDisplayDate(selectedTask.start_date) }}</p>
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-9 h-9 rounded-xl bg-rose-500/10 flex items-center justify-center flex-shrink-0">
                                    <CalendarDays class="size-5 text-rose-500" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">End
                                        Date
                                    </p>
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{
                                        formatDisplayDate(selectedTask.end_date) }}</p>
                                </div>
                            </div>

                            <!-- Description -->
                            <div v-if="selectedTask.description">
                                <div class="border-t border-border-light dark:border-border-dark mb-5"></div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Deskripsi
                                </p>
                                <p
                                    class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-line">
                                    {{ selectedTask.description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 border-t border-border-light dark:border-border-dark flex-shrink-0">
                        <button @click="closeSlide"
                            class="w-full py-2.5 rounded-xl border border-border-light dark:border-border-dark text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </AppLayout>
</template>

<style scoped>
/* Slide-from-right transition */
.slide-right-enter-active,
.slide-right-leave-active {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-right-enter-from,
.slide-right-leave-to {
    transform: translateX(100%);
}

.slide-right-enter-to,
.slide-right-leave-from {
    transform: translateX(0);
}

/* Overlay fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
