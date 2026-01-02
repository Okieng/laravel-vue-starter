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
import axios from 'axios';

interface Props {
    user: User;
}

defineProps<Props>();

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
        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
            <UserInfo :user="user" :show-email="true" />
        </div>
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
                class="flex items-center justify-center gap-2 rounded-md bg-green-600 px-2 py-1.5 text-xs font-semibold text-white transition-colors hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-green-700 dark:hover:bg-green-600">
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
                <DialogContent class="sm:max-w-[425px]">
                    <DialogHeader>
                        <DialogTitle>Daily Report</DialogTitle>
                        <DialogDescription>
                            Please submit your daily report before checking out.
                        </DialogDescription>
                    </DialogHeader>
                    <div class="grid gap-4 py-4">
                        <div class="grid gap-2">
                            <Label htmlFor="report">Report</Label>
                            <Textarea id="report" v-model="reportText" placeholder="What did you work on today?" />
                        </div>
                    </div>
                    <DialogFooter>
                        <Button type="button" variant="secondary" @click="isReportDialogOpen = false">
                            Cancel
                        </Button>
                        <Button type="submit" @click="checkOut" :disabled="isLoading">
                            {{ isLoading ? 'Checking out...' : 'Confirm Check Out' }}
                        </Button>
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
</template>
