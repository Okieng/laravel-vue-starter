<script setup lang="ts">
import { computed } from 'vue';
import { useAppearance } from '@/composables/useAppearance';
import { Moon, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const isDark = computed(() => appearance.value === 'dark');

const toggleAppearance = () => {
    updateAppearance(isDark.value ? 'light' : 'dark');
};
</script>

<template>
    <button @click="toggleAppearance" class="inline-flex items-center justify-center rounded-lg p-2
               text-neutral-600 transition
               hover:bg-neutral-200/70 hover:text-neutral-900
               dark:text-neutral-300 dark:hover:bg-neutral-700/70 dark:hover:text-white" aria-label="Toggle theme">
        <Sun v-if="!isDark" class="h-5 w-5" />
        <Moon v-else class="h-5 w-5" />
    </button>
</template>
