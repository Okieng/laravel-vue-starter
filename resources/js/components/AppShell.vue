<script setup lang="ts">
import { SidebarProvider } from '@/components/ui/sidebar';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    variant?: 'header' | 'sidebar';
}

defineProps<Props>();

const page = usePage();
const isOpen = page.props.sidebarOpen;

const backgroundStyle = computed(() => {
    const themeSettings = page.props.auth?.user?.theme_settings;
    if (!themeSettings?.value) return {};

    if (themeSettings.background === 'default' || !themeSettings.background) {
        return {};
    }

    return {
        backgroundImage: `url('${themeSettings.value}')`,
    };
});
</script>

<template>
    <div v-if="variant === 'header'"
        class="flex min-h-screen w-full flex-col bg-cover bg-center bg-no-repeat transition-all duration-500"
        :style="backgroundStyle">
        <div class="min-h-screen w-full backdrop-blur-[2px]">
            <slot />
        </div>
    </div>
    <SidebarProvider v-else :default-open="isOpen" class="bg-cover bg-center bg-no-repeat transition-all duration-500"
        :style="backgroundStyle">
        <div class="flex h-screen w-full backdrop-blur-[2px] overflow-hidden">
            <slot />
        </div>
    </SidebarProvider>
</template>
