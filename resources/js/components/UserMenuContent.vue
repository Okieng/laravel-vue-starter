<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import {
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { LogOut, Settings, Clock, CheckCircle } from 'lucide-vue-next';
import { onMounted, onUnmounted, ref, computed } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import axios from 'axios';
import UserProfileDetail from '@/components/UserProfileDetail.vue';

interface Props {
    user: User;
}

defineProps<Props>();

const isProfileOpen = ref(false);

const handleLogout = () => {
    router.flushAll();
};

const attendance = ref<{ id: number; check_in_time: string; check_out_time: string | null } | null>(null);
const elapsedTime = ref('00:00:00');
let timerInterval: number | null = null;
const isLoading = ref(false);

const updateTimer = () => {
    if (attendance.value && attendance.value.check_in_time) {
        const start = new Date(attendance.value.check_in_time).getTime();
        const now = new Date().getTime();
        const diff = now - start;

        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        elapsedTime.value = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }
};

const fetchAttendance = async () => {
    try {
        const response = await axios.get('/attendance/current');
        attendance.value = response.data.attendance;
        if (attendance.value) {
            startTimer();
        }
    } catch (error) {
        console.error('Failed to fetch attendance', error);
    }
};

const startTimer = () => {
    if (timerInterval) clearInterval(timerInterval);
    updateTimer();
    timerInterval = setInterval(updateTimer, 1000);
};

const stopTimer = () => {
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = null;
};

const checkIn = async () => {
    isLoading.value = true;
    try {
        const response = await axios.post('/attendance/check-in');
        attendance.value = response.data.attendance;
        startTimer();
    } catch (error) {
        console.error('Check-in failed', error);
    } finally {
        isLoading.value = false;
    }
};

const isReportDialogOpen = ref(false);
const reportText = ref('');

const checkOut = async () => {
    if (!attendance.value) return;
    isLoading.value = true;
    try {
        const response = await axios.put(`/attendance/${attendance.value.id}/check-out`, {
            report: reportText.value
        });
        attendance.value = null;
        reportText.value = '';
        isReportDialogOpen.value = false;
        stopTimer();
    } catch (error) {
        console.error('Check-out failed', error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchAttendance();
});

onUnmounted(() => {
    stopTimer();
});
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal">
        <Dialog v-model:open="isProfileOpen">
            <DialogTrigger as-child>
                <div
                    class="flex cursor-pointer items-center gap-2 px-1 py-1.5 text-left text-sm hover:bg-accent hover:text-accent-foreground transition-colors outline-none">
                    <UserInfo :user="user" :show-email="true" />
                </div>
            </DialogTrigger>
            <DialogContent class="sm:max-w-7xl h-[90vh] p-0 flex flex-col">
                <UserProfileDetail :user="user" />
            </DialogContent>
        </Dialog>
    </DropdownMenuLabel>
    <DropdownMenuSeparator />

    <!-- Attendance Section -->
    <div class="px-2 py-2">
        <div v-if="attendance"
            class="mb-2 flex items-center justify-center gap-2 rounded-md bg-blue-50 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
            <Clock class="h-3 w-3" />
            <span class="tabular-nums">{{ elapsedTime }}</span>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <button @click="checkIn" :disabled="!!attendance || isLoading"
                class="flex items-center justify-center gap-2 rounded-md bg-green-600 px-2 py-1.5 text-xs font-semibold text-white transition-colors hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed darkc:bg-green-700 dark:hover:bg-green-600">
                <CheckCircle class="h-3 w-3" />
                Check In
            </button>
            <Dialog v-model:open="isReportDialogOpen">
                <DialogTrigger as-child>
                    <button :disabled="!attendance || isLoading"
                        class="flex items-center justify-center gap-2 rounded-md bg-red-600 px-2 py-1.5 text-xs font-semibold text-white transition-colors hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-red-700 dark:hover:bg-red-600">
                        <LogOut class="h-3 w-3" />
                        Check Out
                    </button>
                </DialogTrigger>
                <DialogContent class="sm:max-w-[1000px]">
                    <DialogHeader>
                        <DialogTitle>Daily Report</DialogTitle>
                        <DialogDescription>
                            Please submit your daily report before checking out.
                        </DialogDescription>
                    </DialogHeader>
                    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto custom-scrollbar">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div
                                class="bg-slate-50 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-100 dark:border-slate-800/60">
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">From:</span>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                        PS
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-slate-200 leading-none">
                                            Prayogi Sukmana
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                            Staff IT Programmer
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-slate-50 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-100 dark:border-slate-800/60">
                                <span
                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">To:</span>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-500 font-bold">
                                        MS
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 dark:text-slate-200 leading-none">
                                            Marcus Smith
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                            Supervisor IT Software
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 rounded-xl p-3">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-6 flex-wrap">
                                    <span class="font-bold text-blue-700 dark:text-blue-400">Worktime</span>
                                    <div class="flex items-center gap-4">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] text-slate-400 uppercase font-bold">Start</span>
                                            <span class="dark:text-slate-200 font-medium">08:34</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] text-slate-400 uppercase font-bold">End</span>
                                            <span class="dark:text-slate-200 font-medium">10:11</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] text-slate-400 uppercase font-bold">Duration</span>
                                            <span class="dark:text-slate-200 font-bold">1h 37m</span>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    class="p-1.5 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-md transition-colors text-blue-600 dark:text-blue-400">
                                    <span class="material-symbols-outlined text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-pencil-icon lucide-pencil">
                                            <path
                                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                            <path d="m15 5 4 4" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Report</label>
                            <textarea
                                class="w-full h-32 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all p-4 text-sm dark:text-slate-300 placeholder-slate-400"
                                placeholder="Describe your daily activities and achievements..."></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tasks</label>
                                <div class="flex gap-2 mb-3">
                                    <input
                                        class="flex-1 text-sm bg-slate-50 dark:bg-slate-950 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary"
                                        placeholder="Enter task name" type="text" />
                                    <button
                                        class="p-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                        <span class="material-icons-round text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-plus-icon lucide-plus">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <div
                                        class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800/40 rounded-lg border border-slate-100 dark:border-slate-800/60">
                                        <span class="material-icons-round text-emerald-500 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#11ff00" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-check-icon lucide-circle-check">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                        </span>
                                        <span class="text-xs text-slate-600 dark:text-slate-400">API Documentation
                                            update</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 p-2 bg-slate-50 dark:bg-slate-800/40 rounded-lg border border-slate-100 dark:border-slate-800/60">
                                        <span class="material-icons-round text-emerald-500 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#11ff00" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-check-icon lucide-circle-check">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                        </span>
                                        <span class="text-xs text-slate-600 dark:text-slate-400">Bug fix: Login timeout
                                            issue</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Events</label>
                                <div class="flex gap-2">
                                    <div class="flex items-center gap-1">
                                        <input
                                            class="w-14 text-[10px] p-2 bg-slate-50 dark:bg-slate-950 border-slate-200 dark:border-slate-700 rounded-lg"
                                            placeholder="11:00" type="text" />
                                        <span class="text-slate-400">-</span>
                                        <input
                                            class="w-14 text-[10px] p-2 bg-slate-50 dark:bg-slate-950 border-slate-200 dark:border-slate-700 rounded-lg"
                                            placeholder="12:00" type="text" />
                                    </div>
                                    <input
                                        class="flex-1 text-sm bg-slate-50 dark:bg-slate-950 border-slate-200 dark:border-slate-700 rounded-lg focus:ring-primary"
                                        placeholder="New event" type="text" />
                                    <button
                                        class="p-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                        <span class="material-icons-round text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-plus-icon lucide-plus">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="mt-3 flex items-center gap-2">
                                    <input
                                        class="rounded text-primary focus:ring-primary bg-slate-50 dark:bg-slate-950 border-slate-300 dark:border-slate-700"
                                        id="outOfOffice" type="checkbox" />
                                    <label class="text-xs text-slate-500 dark:text-slate-400" for="outOfOffice">Out of
                                        office</label>
                                </div>
                            </div>
                        </div>
                        <button class="text-xs text-primary font-semibold hover:underline flex items-center gap-1">
                            Add comment
                        </button>
                    </div>
                    <DialogFooter>
                        <div class="flex">
                            <Button
                                class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-sm font-bold uppercase tracking-widest transition-colors mr-5"
                                type="button" variant="secondary" @click="isReportDialogOpen = false">
                                Cancel
                            </Button>
                            <Button
                                class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-red-600/20 uppercase tracking-widest"
                                type="submit" @click="checkOut" :disabled="isLoading">
                                {{ isLoading ? 'Checking out...' : 'Confirm Check Out' }}
                            </Button>
                        </div>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
    </div>

    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full" :href="edit()" prefetch as="button">
                <Settings class="mr-2 h-4 w-4" />
                Settings
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <Link class="block w-full" :href="logout()" @click="handleLogout" as="button" data-test="logout-button">
            <LogOut class="mr-2 h-4 w-4" />
            Log out
        </Link>
    </DropdownMenuItem>
    <hr class="text-slate-500">
    <div class="text-center mt-3 ">
        <span class="text-slate-500">Company Pulse</span>
    </div>
</template>
