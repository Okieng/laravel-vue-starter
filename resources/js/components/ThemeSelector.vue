<script setup lang="ts">
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';

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
import { Check } from 'lucide-vue-next';

const props = defineProps<{
    user: any;
}>();

const open = ref(false);
const selectedTheme = ref(props.user.theme_settings?.background || 'default');
const customImage = ref('');

const themes = [
    { id: 'default', name: 'Default', type: 'color', value: '' },
    { id: 'theme1', name: 'Nature', type: 'image', value: 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?q=80&w=2070&auto=format&fit=crop' },
    { id: 'theme2', name: 'Abstract', type: 'image', value: 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=2070&auto=format&fit=crop' },
    { id: 'theme3', name: 'Gradient', type: 'image', value: 'https://images.unsplash.com/photo-1557683316-973673baf926?q=80&w=2029&auto=format&fit=crop' },
    { id: 'theme4', name: 'Dark', type: 'image', value: 'https://images.unsplash.com/photo-1483729558449-99ef09a8c325?q=80&w=2070&auto=format&fit=crop' },
];

const selectTheme = (themeId: string) => {
    selectedTheme.value = themeId;
};

const saveTheme = () => {
    let themeValue = themes.find(t => t.id === selectedTheme.value)?.value;

    if (selectedTheme.value === 'custom') {
        themeValue = customImage.value;
    }

    router.post('/user/theme', {
        theme_settings: {
            background: selectedTheme.value,
            value: themeValue
        }
    }, {
        preserveScroll: true,
        onSuccess: () => {
            open.value = false;
            window.location.reload();
        },
    });
};
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger as-child>
            <slot />
        </DialogTrigger>
        <DialogContent class="sm:max-w-[625px]">
            <DialogHeader>
                <DialogTitle>Customize Background</DialogTitle>
                <DialogDescription>
                    Choose a background theme for your application.
                </DialogDescription>
            </DialogHeader>
            <div class="grid grid-cols-2 gap-4 py-4 md:grid-cols-3">
                <div v-for="theme in themes" :key="theme.id"
                    class="relative cursor-pointer overflow-hidden rounded-lg border-2 transition-all hover:opacity-90"
                    :class="selectedTheme === theme.id ? 'border-primary' : 'border-transparent'"
                    @click="selectTheme(theme.id)">
                    <div v-if="theme.type === 'color'"
                        class="flex h-24 w-full items-center justify-center bg-muted text-muted-foreground">
                        <span class="text-xs font-medium">{{ theme.name }}</span>
                    </div>
                    <img v-else :src="theme.value" :alt="theme.name" class="h-24 w-full object-cover" />
                    <div v-if="selectedTheme === theme.id"
                        class="absolute right-2 top-2 rounded-full bg-primary p-1 text-primary-foreground">
                        <Check class="h-3 w-3" />
                    </div>
                </div>
            </div>
            <DialogFooter>
                <Button type="submit" @click="saveTheme">Save changes</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
